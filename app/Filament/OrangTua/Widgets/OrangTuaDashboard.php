<?php

namespace App\Filament\OrangTua\Widgets;

use App\Models\Balita;
use App\Models\LaporanGizi;
use App\Models\OrangTua;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrangTuaDashboard extends BaseWidget
{
    protected function getStats(): array
    {

        $orang_tua = OrangTua::where('id_user', auth()->user()->id)->first();

        /* $balita = Balita::query()->where('id_orang_tua', $orang_tua->id)->pluck('id'); // semua anak dari orang tua */

        return [
            /* Stat::make('Anak', Balita::where('id_orang_tua', $orang_tua->id)->count()) */
            /*     ->description('Jumlah Anak Anda') */
            /*     ->icon('heroicon-o-user-group'), */
            /* Stat::make('Pemeriksaan', LaporanGizi::whereIn('id_balita', $balita)->count()) */
            /*     ->description('Jumlah pemeriksaan yang telah dilakukan') */
            /*     ->icon('heroicon-o-user-group'), */
        ];
    }
}
