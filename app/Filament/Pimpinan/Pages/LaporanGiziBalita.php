<?php

namespace App\Filament\Pimpinan\Pages;

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

class LaporanGiziBalita extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pimpinan.pages.laporan-gizi-balita';

    protected function table(Table $table): Table {
        return $table
            ->query(Balita::query())
            ->columns([
                TextColumn::make('kode_balita')
                    ->searchable()
                    ->label('Kode Balita'),
                TextColumn::make('nama_balita')
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
            ]);
    }

}
