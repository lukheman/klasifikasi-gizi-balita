<?php

namespace App\Filament\Kader\Resources;

use App\Filament\Kader\Resources\RiwayatPemeriksaanResource\Pages;
use App\Filament\Kader\Resources\RiwayatPemeriksaanResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Balita;

use App\Enums\Role;

class RiwayatPemeriksaanResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static ?string $navigationIcon = 'fas-heartbeat';

    protected static ?string $navigationLabel = 'Riwayat Pemeriksaan Balita';

    protected static ?string $pluralModelLabel = 'Riwayat Pemeriksaan';

    protected static ?string $slug = 'riwayat-pemeriksaan';

    protected static ?string $navigationGroup = 'Pemeriksaan Gizi';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* TextInput::make('') */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function() {
                if(Role::from(auth()->user()->role) === Role::Kader) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa);
                } else if(Role::from(auth()->user()->role) === Role::OrangTua) {
                    return Balita::query()->latest()->where('id_desa', auth()->user()->id_desa)->where('id_orang_tua', auth()->user()->id);
                }
                return Balita::query()->latest();
            })
            ->striped()
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK Balita'),
                TextColumn::make('nama')
                    ->label('Nama'),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('cetak_laporan_gizi_balita')
                    ->label('Cetak Riwayat')
                    ->icon('heroicon-o-printer')
                    ->color(Color::Red)
                    ->url(fn($record) => route('laporan.gizi-balita', ['id_balita' => $record->id]))
                    ->openUrlInNewTab()
                    ->button(),
                Tables\Actions\ViewAction::make()->button()->color(Color::Blue)->label('Riwayat'),
            ])
            ->headerActions([
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    /* Tables\Actions\DeleteBulkAction::make(), */
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RiwayatPemeriksaanRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayatPemeriksaans::route('/'),
            /* 'create' => Pages\CreateRiwayatPemeriksaan::route('/create'), */
            'view' => Pages\ViewRiwayatPemeriksaan::route('/{record}'),
            /* 'edit' => Pages\EditRiwayatPemeriksaan::route('/{record}/edit'), */
        ];
    }
}
