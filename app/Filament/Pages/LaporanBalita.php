<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Balita;

use App\Enums\Role;

class LaporanBalita extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'fas-clipboard-list';

    protected static string $view = 'filament.pages.laporan-balita';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $navigationLabel = 'Laporan Data Balita';

    public static function shouldRegisterNavigation(): bool {
        return match (Role::from(auth()->user()->role)) {
            Role::Pimpinan => true,
            Role::Kader => true,
            Role::Admin => true,
            default => false
        };
    }

    protected function table(Table $table): Table {
        return $table
            ->query(function() {

                if (Role::from(auth()->user()->role) === Role::Kader) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa);

                }
                return Balita::query();
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
                    ->label('Tanggal Lahir'),
                TextColumn::make('desa.nama')
                    ->searchable()
                    ->label('Asal Desa')
                    ->badge()
            ])
            ->headerActions([
                Action::make('cetak_laporan_data_balita')
                    ->label('Laporan Data Balita')
                    ->color('danger')
                    ->url(fn($record) => route('laporan.data-balita'))
                    ->icon('heroicon-o-printer')
                    ->openUrlInNewTab()
            ])
            ;
    }

}
