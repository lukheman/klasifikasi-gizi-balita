<?php

namespace App\Filament\Resources\BalitaResource\Pages;

use App\Filament\Resources\BalitaResource;
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $balita = $this->record;

        $data['id_orang_tua'] = $balita->orangTua->id;
        $data['nik_orang_tua'] = $balita->orangTua->nik;
        $data['nama_orang_tua'] = $balita->orangTua->name;

        return $data;
    }

}
