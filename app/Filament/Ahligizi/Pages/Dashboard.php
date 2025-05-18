<?php

namespace App\Filament\Ahligizi\Pages;

use App\Filament\Ahligizi\Widgets\AhliGiziDashboard;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static ?string $navigationIcon = 'fas-home';

    protected static string $view = 'filament.ahligizi.pages.dashboard';

    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';

    protected function getHeaderWidgets(): array {

        return [ AhliGiziDashboard::class];

    }

}
