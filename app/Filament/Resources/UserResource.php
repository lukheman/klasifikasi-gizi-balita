<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Desa;

use App\Enums\Role;

class UserResource extends Resource
{

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'fas-user';

    protected static ?string $pluralModelLabel = 'Pengguna';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
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
                TextInput::make('nik')
                    ->rules(function($record) {
                        return [
                            Rule::unique('users', 'nik')->ignore($record?->id),
                            'numeric',
                        ];
                    })
                    ->validationMessages([
                        'unique' => 'NIK telah terdaftar',
                        'numeric' => 'NIK tidak valid',
                    ])
                    ->label('NIK'),
                Select::make('id_desa')
                    ->label('Nama Desa')
                    ->options(Desa::all()->pluck('nama', 'id')),
                Select::make('role')
                    ->label('Role')
                    ->options(array_combine(Role::values(), Role::values()))
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->label('Email'),
                TextColumn::make('nik')
                    ->copyable()
                    ->searchable()
                    ->label('NIK')
                    ->placeholder('-'),
                TextColumn::make('desa.nama')
                    ->searchable()
                    ->label('Nama Desa')
                    ->getStateUsing(fn($record) => $record->desa ? $record->desa->nama : '-'),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn ($state) => Role::from($state)->getColor())
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button()->label('Hapus'),
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
            'index' => Pages\ListUsers::route('/'),
            /* 'create' => Pages\CreateUser::route('/create'), */
            /* 'edit' => Pages\EditUser::route('/{record}/edit'), */
        ];
    }
}
