<?php

namespace App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;


use App\Enums\StatusGizi;
use App\Filament\Pages\ViewGrafikKms;

class RiwayatPemeriksaanRelationManager extends RelationManager
{
    protected static string $relationship = 'riwayatPemeriksaan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Forms\Components\TextInput::make('status_gizi') */
                /*     ->required() */
                /*     ->maxLength(255), */
                /* Forms\Components\TextInput::make('nama_balita') */
                /*     ->required() */
                /*     ->maxLength(255), */
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status_gizi')
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Pemeriksaan')
                ,
                Tables\Columns\TextColumn::make('umur')
                    ->label('Umur'),
                Tables\Columns\TextColumn::make('berat')
                    ->label('Berat'),
                Tables\Columns\TextColumn::make('tinggi')
                    ->label('Tinggi'),
                Tables\Columns\TextColumn::make('status_gizi')
                    ->badge()
                    ->color(fn($state) => StatusGizi::from($state)->getColor()),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),

            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button()
                    ->url(fn($record): string => ViewGrafikKms::getUrl(['record' => $record]))
                    ->color( Color::Blue )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
