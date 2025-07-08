<?php

namespace App\Filament\Pages;

use App\Filament\Helpers\CetakLaporanHelper;
use App\Models\Balita;
use App\Models\RiwayatPemeriksaan;
use Filament\Tables\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use App\Enums\StatusGizi;
use App\Enums\Role;

class LaporanRiwayatPemeriksaan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'fas-file-medical';

    protected static string $view = 'filament.pages.laporan-gizi';

    protected static ?string $navigationLabel = 'Riwayat Pemeriksaan';
    protected static ?string $title = 'Riwayat Pemeriksaan';

    protected static ?string $navigationGroup = 'Laporan';

    public static function shouldRegisterNavigation(): bool
    {
        // Cek guard yang aktif
        if (auth()->guard('web')->check()) {
            $user = auth()->guard('web')->user();
            return match (Role::from($user->role)) {
                Role::Pimpinan => true,
                Role::Kader => true,
                Role::Admin => true,
                default => false, // Default false untuk user tanpa role valid
            };
        }

        // Untuk guard orang_tua
        if (auth()->guard('orang_tua')->check()) {
            return true; // Atau sesuaikan dengan logika spesifik untuk orang_tua
        }

        return false;
    }

    protected function table(Table $table): Table
    {
        return $table
            ->query(function () {
                if (auth()->guard('web')->check()) {
                    $user = auth()->guard('web')->user();
                    if (Role::from($user->role) === Role::Kader) {
                        return RiwayatPemeriksaan::query()
                            ->with(['balita.desa'])
                            ->whereHas('balita.desa', function ($query) use ($user) {
                                $query->where('id', $user->id_desa);
                            })->latest();
                    }
                } elseif (auth()->guard('orang_tua')->check()) {
                    $orangTua = auth()->guard('orang_tua')->user();
                    return RiwayatPemeriksaan::query()
                        ->whereHas('balita', function ($query) use ($orangTua) {
                            $query->where('id_desa', $orangTua->id_desa)
                                ->where('id_orang_tua', $orangTua->id);
                        })->latest();
                }

                return RiwayatPemeriksaan::query()->latest(); // Fallback jika tidak ada guard aktif
            })
            ->striped()
            ->columns([
                TextColumn::make('balita.nik')
                    ->searchable()
                    ->label('NIK Balita'),
                TextColumn::make('balita.tanggal_lahir')
                    ->searchable()
                    ->label('Tanggal Lahir'),
                TextColumn::make('balita.nama')
                    ->searchable()
                    ->label('Nama Balita'),
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->label('Tanggal Pemeriksaan'),
                TextColumn::make('umur')
                    ->label('Umur (Bulan)')
                    ->searchable(),
                TextColumn::make('berat')
                    ->label('Berat (Kg)')
                    ->searchable(),
                TextColumn::make('tinggi')
                    ->label('Tinggi (Cm)')
                    ->searchable(),
                TextColumn::make('status_gizi')
                    ->label('Status Gizi')
                    ->badge()
                    ->color(fn ($state) => StatusGizi::from($state)->getColor()),
            ])
            ->filters([
                SelectFilter::make('status_gizi')
                    ->options(StatusGizi::labels())
                    ->multiple()
                    ->label('Status Gizi')
                    ->placeholder('Semua Status Gizi')
                    ->query(function ($query, $state) {
                        if (!empty($state['values'])) {
                            $query->whereIn('status_gizi', $state['values']);
                        }
                    }),
                Filter::make('tanggal_pemeriksaan')
                    ->form([
                        DatePicker::make('dari')
                            ->label('Dari Tanggal')
                            ->placeholder('Pilih tanggal mulai'),
                        DatePicker::make('sampai')
                            ->label('Sampai Tanggal')
                            ->placeholder('Pilih tanggal akhir'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['dari']) {
                            $query->where('created_at', '>=', $data['dari']);
                        }
                        if ($data['sampai']) {
                            $query->where('created_at', '<=', $data['sampai']);
                        }
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if ($data['dari'] || $data['sampai']) {
                            $dari = $data['dari'] ? \Carbon\Carbon::parse($data['dari'])->format('d/m/Y') : '...';
                            $sampai = $data['sampai'] ? \Carbon\Carbon::parse($data['sampai'])->format('d/m/Y') : '...';
                            return "Tanggal: {$dari} - {$sampai}";
                        }
                        return null;
                    }),
            ])
            ->headerActions([
                Action::make('cetak_laporan')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-o-printer')
                    ->color(Color::Rose)
                    ->url(function (Table $table) {

                        return route('laporan.riwayat-pemeriksaan', [
                            'status_gizi' => $table->getFilters()['status_gizi']->getState()['values'] ?? [],
                            'dari' => $table->getFilters()['tanggal_pemeriksaan']->getState()['dari'] ?? null,
                            'sampai' => $table->getFilters()['tanggal_pemeriksaan']->getState()['sampai'] ?? null,
                        ]);
                    })
                    ->openUrlInNewTab()
                    ->button()
            ])
            ->actions([]);
    }
}
