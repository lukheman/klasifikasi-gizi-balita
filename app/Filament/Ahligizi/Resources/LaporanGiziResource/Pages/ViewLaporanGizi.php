<?php

namespace App\Filament\Ahligizi\Resources\LaporanGiziResource\Pages;

use App\Filament\Ahligizi\Resources\LaporanGiziResource;
use App\Livewire\GrafikKMS\GrafikBeratBadan;
use App\Livewire\GrafikKMS\GrafikTinggiBadan;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLaporanGizi extends ViewRecord
{
    protected static string $resource = LaporanGiziResource::class;

    protected function getFooterWidgets(): array {

        return [
            GrafikBeratBadan::make([
                'status' => $this->record->status,
                'umur' => $this->record->umur,
                'berat' => $this->record->berat,
            ]),
            GrafikTinggiBadan::make([
                'umur' => $this->record->umur,
                'tinggi' => $this->record->tinggi,
            ])
        ];
    }

}
