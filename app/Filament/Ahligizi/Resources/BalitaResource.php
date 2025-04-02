<?php

namespace App\Filament\Ahligizi\Resources;

use App\Filament\Ahligizi\Resources\BalitaResource\Pages;
use App\Filament\Ahligizi\Resources\BalitaResource\RelationManagers;
use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $slug = 'balita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_balita')->required(),
                TextInput::make('nama_balita')->required(),
                DatePicker::make('tanggal_lahir')
                    ->maxDate(now())
                    ->after(now()->subMonths(60))
                    ->validationMessages([
                        'after' => 'Umur tidak boleh lebih dari 60 bulan (5 tahun)'
                    ])
                    ->required(),
                Select::make('id_orang_tua')
                    ->label('Orang Tua')
                    ->options(OrangTua::with('user')->get()->mapWithKeys(fn($o) => [$o->id => "{$o->nik} - {$o->user->name}"]))
                    ->searchable()
                    ->preload()

                    /* ->createOptionForm([ */
                    /*     TextInput::make('nik') */
                    /*         ->label('NIK') */
                    /*         ->numeric() */
                    /*         ->required(), */
                    /*     TextInput::make('nama_orang_tua') */
                    /*         ->label('Nama Orang Tua') */
                    /*         ->required(), */
                    /*     DatePicker::make('tanggal_lahir') */
                    /*         ->label('Tanggal Lahir') */
                    /*         ->maxDate(now()) */
                    /*         ->required(), */
                    /*     TextInput::make('telepon') */
                    /*         ->label('Telepon') */
                    /*         ->tel() */
                    /*         ->required() */
                    /**/
                    /* ]) */
                    /* ->createOptionUsing(function (array $data) { */
                    /*     return OrangTua::create($data)->id; */
                    /* }) */

                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_balita')
                    ->searchable()
                    ->label('Kode Balita'),
                TextColumn::make('nama_balita')
                    ->searchable()
                    ->label('Nama Balita'),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\LaporanGiziRelationManager::class,
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
}
