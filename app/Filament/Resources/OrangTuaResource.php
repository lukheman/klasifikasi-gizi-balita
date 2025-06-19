<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrangTuaResource\Pages;
use App\Filament\Resources\OrangTuaResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

use App\Enums\Role;

use App\Models\User;
use App\Models\Desa;

class OrangTuaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'fas-users';

    protected static ?string $pluralModelLabel = 'Orang Tua';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('nik')
                    ->required()
                    ->rules(function($record) {
                        return [
                            Rule::unique('users', 'nik')->ignore($record?->id),
                            'unique:balita,nik',
                            'numeric',
                        ];
                    })
                    ->validationMessages([
                        'unique' => 'NIK telah terdaftar',
                        'numeric' => 'NIK tidak valid',
                    ])
                    ->label('NIK'),
                Hidden::make('id_desa')
                    ->default(auth()->user()->id_desa)
                    ->disabled(Role::from(auth()->user()->role) !== Role::Kader)
                ,
                TextInput::make('email')
                    ->label('Email')
                    ->rules(function($record) {
                        return [
                            Rule::unique('users', 'email')->ignore($record?->id),
                            'email'
                        ];
                    })
                    ->validationMessages([
                        'email' => 'Email tidak valid',
                        'unique' => 'Email Telah digunakan'
                    ])
                    ->required(),
                Select::make('id_desa')
                    ->label('Nama Desa')
                    ->required()
                    ->options(Desa::all()->pluck('nama', 'id'))
                    ->hidden(Role::from(auth()->user()->role) === Role::Kader)
                    ->disabled(Role::from(auth()->user()->role) === Role::Kader),
                Textarea::make('alamat'),
                Hidden::make('role')->default(Role::OrangTua)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function() {
                if (Role::from(auth()->user()->role) === Role::Kader) {

                    return User::query()->latest()->where('role', Role::OrangTua)->where('id_desa', auth()->user()->id_desa);
                }

                return User::query()->latest()->where('role', Role::OrangTua);

            })
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('nik')
                    ->searchable()
                    ->label('NIK')
                    ->placeholder('-'),
                TextColumn::make('desa.nama')
                    ->searchable()
                    ->label('Nama Desa')
                    ->getStateUsing(fn($record) => $record->desa ? $record->desa->nama : '-'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->label('Detail'),
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button()->color('danger')->label('Hapus'),
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
            'index' => Pages\ListOrangTuas::route('/'),
            /* 'create' => Pages\CreateOrangTua::route('/create'), */
            /* 'edit' => Pages\EditOrangTua::route('/{record}/edit'), */
        ];
    }
}
