<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\OrangTua\Resources\BalitaResource\Pages;
use App\Filament\OrangTua\Resources\BalitaResource\RelationManagers;
use App\Models\Balita;
use App\Models\OrangTua;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function auth;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $slug = 'balita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_balita'),
                TextInput::make('tanggal_lahir')
            ]);
    }

    public static function table(Table $table): Table
    {

        $orang_tua = OrangTua::where('id_user', auth()->user()->id)->first();

        return $table
            ->query(Balita::query()->where('id_orang_tua', $orang_tua->id))
            ->columns([
                TextColumn::make('nama_balita'),
                TextColumn::make('tanggal_lahir'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\LaporanGiziRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBalitas::route('/'),
            'create' => Pages\CreateBalita::route('/create'),
            'edit' => Pages\EditBalita::route('/{record}/edit'),
            'view' => Pages\ViewBalita::route('/{record}/view'),
        ];
    }

    public static function canCreate(): bool {
        return false;
    }
}
