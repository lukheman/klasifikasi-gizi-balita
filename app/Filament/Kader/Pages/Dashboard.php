<?php

namespace App\Filament\Kader\Pages;

use App\Filament\Kader\Widgets\KaderDashboard;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static ?string $navigationIcon = 'fas-home';

    protected static string $view = 'filament.kader.pages.dashboard';

    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';

    protected function getHeaderWidgets(): array {

        return [ KaderDashboard::class];

    }

}
