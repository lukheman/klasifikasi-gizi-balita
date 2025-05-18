<?php

namespace App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource\Pages;

use App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRiwayatPemeriksaan extends ViewRecord
{
    protected static string $resource = RiwayatPemeriksaanResource::class;

    public static ?string $title = 'Lihat Riwayat Pemeriksaan';

}
