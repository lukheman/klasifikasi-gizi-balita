<?php

namespace App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource\Pages;

use App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiwayatPemeriksaans extends ListRecords
{
    protected static string $resource = RiwayatPemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
