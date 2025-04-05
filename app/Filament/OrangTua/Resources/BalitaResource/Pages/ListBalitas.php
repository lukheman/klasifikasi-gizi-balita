<?php

namespace App\Filament\OrangTua\Resources\BalitaResource\Pages;

use App\Filament\OrangTua\Resources\BalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBalitas extends ListRecords
{
    protected static string $resource = BalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
