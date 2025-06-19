<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Enums\Role;

class AdminDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Administrator', User::where('role', Role::Admin)->count())
                ->color('success')
                ->icon('heroicon-o-user')
                ->description('Jumlah Akun Administrator'),
            Stat::make('Orang Tua', User::where('role', Role::OrangTua)->count())
                ->color('success')
                ->icon('heroicon-o-user')
                ->description('Jumlah Akun Orang Tua'),
            Stat::make('Ahli Gizi', User::where('role', Role::Kader)->count())
                ->color('success')
                ->icon('heroicon-o-user')
                ->description('Jumlah Akun Ahli Gizi')
        ];
    }
}
