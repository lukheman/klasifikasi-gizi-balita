<?php

namespace App\Filament\OrangTua\Widgets;

use App\Models\Balita;
use App\Models\RiwayatPemeriksaan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrangTuaDashboard extends BaseWidget
{
    protected function getStats(): array
    {

        $balita = Balita::query()->where('id_orang_tua', auth()->user()->id)->pluck('id'); // semua anak dari orang tua

        return [
            Stat::make('Anak', Balita::where('id_orang_tua', auth()->user()->id)->count())
                ->description('Jumlah Anak Anda')
                ->icon('heroicon-o-user-group'),
            Stat::make('Pemeriksaan', RiwayatPemeriksaan::whereIn('id_balita', $balita)->count())
                ->description('Jumlah pemeriksaan yang telah dilakukan')
                ->icon('heroicon-o-user-group'),
        ];
    }
}
