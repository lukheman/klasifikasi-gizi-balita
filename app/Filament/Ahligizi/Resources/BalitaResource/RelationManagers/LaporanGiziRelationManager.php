<?php

namespace App\Filament\Ahligizi\Resources\BalitaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporanGiziRelationManager extends RelationManager
{
    protected static string $relationship = 'laporanGizi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status_gizi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status_gizi')
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_pemeriksaan')
                    ->label('Tanggal Pemeriksaan'),
                Tables\Columns\TextColumn::make('umur')
                    ->label('Umur (Bulan)'),
                Tables\Columns\TextColumn::make('berat')
                    ->label('Berat (Kg)'),
                Tables\Columns\TextColumn::make('tinggi')
                    ->label('Tinggi (Cm)'),
                Tables\Columns\TextColumn::make('status_gizi'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->label('Grafik KMS')
                    ->url(fn ($record) => route('filament.ahligizi.resources.balita.laporan-gizi.view', ['record' => $record])),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


}
