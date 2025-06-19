<?php

namespace App\Filament\Kader\Resources;

use App\Filament\Kader\Resources\LaporanGiziResource\Pages;
use App\Models\RiwayatPemeriksaan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class LaporanGiziResource extends Resource
{
    protected static ?string $model = RiwayatPemeriksaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'balita/laporan-gizi';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tanggal_pemeriksaan')
                    ->label('Tanggal Pemeriksaan'),
                TextInput::make('umur')
                    ->label('Umur (Bulan)'),
                TextInput::make('berat')
                    ->label('Berat (Kg)'),
                TextInput::make('tinggi')
                    ->label('Tinggi (Cm)'),
                TextInput::make('status_gizi')
                    ->label('Status Gizi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanGizis::route('/'),
            // 'create' => Pages\CreateLaporanGizi::route('/create'),
            // 'edit' => Pages\EditLaporanGizi::route('/{record}/edit'),
            'view' => Pages\ViewLaporanGizi::route('/{record}/view'),
        ];
    }
}
