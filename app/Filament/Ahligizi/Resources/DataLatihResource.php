<?php

namespace App\Filament\Ahligizi\Resources;

use App\Filament\Ahligizi\Resources\DataLatihResource\Pages;
use App\Filament\Ahligizi\Resources\DataLatihResource\RelationManagers;
use App\Models\DataLatih;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\DataLatihImporter;

class DataLatihResource extends Resource
{
    protected static ?string $model = DataLatih::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $slug = 'data-latih';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Balita')
                    ->required() ,
                TextInput::make('umur')
                    ->label('Umur Balita')
                    ->integer()
                    ->required() ,
                TextInput::make('berat')
                    ->label('Berat Balita')
                    ->numeric()
                    ->required() ,
                TextInput::make('tinggi')
                    ->label('Tinggi Balita')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('umur')
                    ->label('Umur (Bulan)'),
                TextColumn::make('berat')
                    ->label('Berat (Kg)'),
                TextColumn::make('tinggi')
                    ->label('Tinggi (Cm)'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(DataLatihImporter::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button()
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
            'index' => Pages\ListDataLatihs::route('/'),
            'create' => Pages\CreateDataLatih::route('/create'),
            'edit' => Pages\EditDataLatih::route('/{record}/edit'),
        ];
    }
}
