<?php

namespace App\Filament\Kader\Resources\DataLatihResource\Pages;

use App\Filament\Kader\Resources\DataLatihResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataLatih extends EditRecord
{
    protected static string $resource = DataLatihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
