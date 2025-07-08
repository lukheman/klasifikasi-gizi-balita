<?php

namespace App\Filament\Kader\Widgets;


use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\DataLatih;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Enums\Role;

class KaderDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Orang Tua', OrangTua::count())
                ->color('success')
                ->icon('heroicon-o-user')
                ->description('Jumlah Akun Orang Tua'),
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

}
