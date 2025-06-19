<?php

namespace App\Filament\Kader\Resources\RiwayatPemeriksaanResource\Pages;

use App\Filament\Kader\Resources\RiwayatPemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRiwayatPemeriksaan extends ViewRecord
{
    protected static string $resource = RiwayatPemeriksaanResource::class;


    public function getTitle(): string
    {
        return 'Riwayat Pemeriksaan Balita: ' . $this->record->nama;
    }

}
