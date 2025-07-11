<?php

namespace App\Filament\Kader\Resources\DataLatihResource\Pages;

use App\Filament\Kader\Resources\DataLatihResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataLatihs extends ListRecords
{
    protected static string $resource = DataLatihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
