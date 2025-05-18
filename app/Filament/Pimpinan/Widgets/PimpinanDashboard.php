<?php

namespace App\Filament\Pimpinan\Widgets;

use App\Models\RiwayatPemeriksaan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Balita;

class PimpinanDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Balita', Balita::query()->count())
                ->description('Jumlah seluruh balita')
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Stat::make('Total Pemeriksaan', RiwayatPemeriksaan::query()->count())
                ->description('Jumlah kesulurahan pemeriksaan yang telah dilakukan')
                ->color('success')
                ->icon('heroicon-o-check')
        ];
    }

    protected function getColumns(): int {
        return 2;
    }
}
