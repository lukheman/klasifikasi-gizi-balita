<?php

namespace App\Filament\Ahligizi\Resources\BalitaResource\Pages;

use App\Filament\Ahligizi\Resources\BalitaResource;
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
