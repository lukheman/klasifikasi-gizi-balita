<?php

namespace App\Filament\Ahligizi\Widgets;


use App\Models\Balita;
use App\Models\DataLatih;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AhliGiziDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Balita', Balita::query()->count())
                ->description('Total jumlah balita')
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Stat::make('Data Latih', DataLatih::query()->count())
                ->description('Data untuk training')
                ->color('success')
                ->icon('heroicon-o-circle-stack'),
        ];
    }

    protected function getColumns(): int { 
        return 2;
    }

}
