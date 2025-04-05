<?php

namespace App\Filament\OrangTua\Resources\LaporanGiziResource\Pages;

use App\Filament\OrangTua\Resources\LaporanGiziResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanGizis extends ListRecords
{
    protected static string $resource = LaporanGiziResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
