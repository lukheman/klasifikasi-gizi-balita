<?php

namespace App\Filament\Ahligizi\Resources\BalitaResource\Pages;

use App\Filament\Ahligizi\Resources\BalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBalita extends EditRecord
{
    protected static string $resource = BalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
