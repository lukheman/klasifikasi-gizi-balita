<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Pimpinan\Widgets;
use Filament\Widgets\Widget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Pages;

class PimpinanPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pimpinan')
            ->path('pimpinan')
            ->login()
            ->profile()
            ->colors([
                'primary' => Color::Green,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Pimpinan/Resources'), for: 'App\\Filament\\Pimpinan\\Resources')
            ->discoverPages(in: app_path('Filament/Pimpinan/Pages'), for: 'App\\Filament\\Pimpinan\\Pages')
            ->pages([
                /* \Filament\Pages\Dashboard::class, */
                Pages\LaporanBalita::class,
                Pages\LaporanRiwayatPemeriksaan::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Pimpinan/Widgets'), for: 'App\\Filament\\Pimpinan\\Widgets')
            ->widgets([
                Widgets\PimpinanDashboard::class
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
