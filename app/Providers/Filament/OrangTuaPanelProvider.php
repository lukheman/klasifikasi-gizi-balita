<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Register;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\OrangTua\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Pages;


class OrangTuaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('orangtua')
            ->path('orangtua')
            ->profile()
            ->login()
            ->authGuard('orang_tua')
            ->spa()
            /* ->registration(Register::class) */
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/OrangTua/Resources'), for: 'App\\Filament\\OrangTua\\Resources')
            ->discoverPages(in: app_path('Filament/OrangTua/Pages'), for: 'App\\Filament\\OrangTua\\Pages')
            ->pages([
                Pages\LaporanRiwayatPemeriksaan::class
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->resources([
                \App\Filament\Kader\Resources\RiwayatPemeriksaanResource::class
            ])
            ->discoverWidgets(in: app_path('Filament/OrangTua/Widgets'), for: 'App\\Filament\\OrangTua\\Widgets')
            ->widgets([
                /* Widgets\OrangTuaDashboard::class */
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
