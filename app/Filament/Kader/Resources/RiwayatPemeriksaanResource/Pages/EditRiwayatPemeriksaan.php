<?php

namespace App\Filament\Kader\Resources\RiwayatPemeriksaanResource\Pages;

use App\Filament\Kader\Resources\RiwayatPemeriksaanResource;
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
