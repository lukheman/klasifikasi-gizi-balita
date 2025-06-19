<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalitaResource\Pages;
use App\Filament\Resources\BalitaResource\RelationManagers;
use App\Models\Balita;
use App\Models\User;
use App\Enums\Role;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static ?string $navigationIcon = 'fas-baby';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK Balita')
                    ->required()
                    ->rules(function($record) {
                        return [
                            Rule::unique('balita', 'nik')->ignore($record?->id),
                            'numeric',
                            'unique:users,nik'
                        ];
                    })
                    ->validationMessages([
                        'unique' => 'NIK telah terdaftar',
                        'numeric' => 'NIK tidak valid',
                    ]) ,
                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),
                Hidden::make('id_orang_tua'),
                Hidden::make('id_desa'),
                TextInput::make('nik_orang_tua')
                    ->label('NIK Orang Tua')
                    ->reactive()
                    ->required()
                    ->rules('exists:users,nik')
                    ->validationMessages([
                        'exists' => 'NIK tidak terdaftar'
                    ])
                    ->afterStateUpdated(function(Set $set, ?string $state) {
                        $orang_tua = User::query()
                            ->where('nik', $state)
                            ->where('role', Role::OrangTua)
                            ->first();

                        if($orang_tua) {
                            $set('nama_orang_tua', $orang_tua ? $orang_tua->name : null);
                            $set('id_orang_tua', $orang_tua->id);
                            $set('id_desa', $orang_tua->desa->id);

                        } else {
                            $set('nama_orang_tua', null);
                            $set('id_orang_tua', null);
                            $set('id_desa', null);
                        }
                    })
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        $component->state($record->orangTua->nik ?? null);
                    })
                    ->dehydrated(false),
                TextInput::make('nama_orang_tua')
                    ->label('Nama Orang Tua')
                    ->readonly()
                    ->dehydrated(false)
                    ->afterStateHydrated(function(TextInput $component, $state, $record) {
                        if($record) {
                            $orang_tua = User::where('nik', $record->orangTua ? $record->orangTua->nik : '')->first();
                            $component->state($orang_tua ? $orang_tua->name : null);
                        }
                    }) ,
                DatePicker::make('tanggal_lahir')
                    ->maxDate(now())
                    ->after(now()->subMonths(60))
                    ->validationMessages([
                        'after' => 'Umur tidak boleh lebih dari 60 bulan (5 tahun)'
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function() {
                if(Role::from(auth()->user()->role) === Role::Kader) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa);
                }

                return Balita::query()->latest();
            })
            ->striped()
            ->columns([
                TextColumn::make('nik')
                    ->copyable()

                    ->label('NIK Balita'),
                TextColumn::make('nama')
                    ->label('Nama'),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->label('Detail'),
                Tables\Actions\EditAction::make()->button('warning'),
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
            'index' => Pages\ListBalitas::route('/'),
            /* 'create' => Pages\CreateBalita::route('/create'), */
            /* 'edit' => Pages\EditBalita::route('/{record}/edit'), */
            /* 'view' => Pages\ViewBalita::route('/{record}') */
        ];
    }
}
