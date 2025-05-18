<?php

namespace App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource\Pages;

use App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatPemeriksaan extends EditRecord
{
    protected static string $resource = RiwayatPemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
