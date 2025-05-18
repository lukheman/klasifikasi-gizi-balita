<?php

namespace App\Filament\Pages;

use App\Filament\Helpers\CetakLaporanHelper;
use App\Models\Balita;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;

use App\Enums\Role;

class LaporanRiwayatPemeriksaan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'fas-file-medical';

    protected static string $view = 'filament.pages.laporan-gizi';

    protected static ?string $navigationLabel = 'Riwayat Pemeriksaan';
    protected static ?string $title = 'Riwayat Pemeriksaan';

    protected static ?string $navigationGroup = 'Laporan';

    public static function shouldRegisterNavigation(): bool {
        return match (Role::from(auth()->user()->role)) {
            Role::Pimpinan => true,
            Role::AhliGizi => true,
            Role::OrangTua => true,
            default => false
        };
    }

    protected function table(Table $table): Table {
        return $table
            ->query(function() {

                if(Role::from(auth()->user()->role) === Role::AhliGizi) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa);
                } else if(Role::from(auth()->user()->role) === Role::OrangTua) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa)->where('id_orang_tua', auth()->user()->id);
                }
                return Balita::query()->latest();
            })
            ->striped()
            ->columns([
                TextColumn::make('nik')
                    ->searchable()
                    ->label('NIK Balita'),
                TextColumn::make('nama')
                    ->searchable()
                    ->label('Nama Balita'),
                TextColumn::make('tanggal_lahir')
                    ->searchable()
                    ->label('Tanggal Lahir')
            ])
            ->actions([
                Tables\Actions\Action::make('cetak_laporan_gizi_balita')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->color(Color::Red)
                    ->url(fn($record) => route('laporan.gizi-balita', ['id_balita' => $record->id]))
                    ->openUrlInNewTab()
                    ->button()
            ]);
    }

}
