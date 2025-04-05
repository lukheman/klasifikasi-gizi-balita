<?php

namespace App\Filament\Ahligizi\Resources\LaporanGiziResource\Pages;

use App\Filament\Ahligizi\Resources\LaporanGiziResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanGizi extends EditRecord
{
    protected static string $resource = LaporanGiziResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
