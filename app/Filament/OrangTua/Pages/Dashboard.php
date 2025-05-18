<?php

namespace App\Filament\OrangTua\Pages;

use App\Filament\OrangTua\Widgets\OrangTuaDashboard;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'fas-home';

    protected static string $view = 'filament.orang-tua.pages.dashboard';

    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';

    protected function getHeaderWidgets(): array {

        return [ OrangTuaDashboard::class];

    }

}
