<?php

namespace App\Providers\Filament;

use App\Filament\Pages;
use App\Filament\Pages\ViewGrafikKms;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use App\Filament\Ahligizi\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class AhligiziPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('ahligizi')
            ->path('ahligizi')
            ->resources([
                \App\Filament\Resources\BalitaResource::class,
                \App\Filament\Resources\OrangTuaResource::class,
                \App\Filament\Ahligizi\Resources\RiwayatPemeriksaanResource::class,
            ])
            ->login()
            ->profile()
            ->colors([
                'primary' => Color::Green,
            ])
            // ->databaseNotifications()
            ->spa()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Ahligizi/Resources'), for: 'App\\Filament\\Ahligizi\\Resources')
            ->discoverPages(in: app_path('Filament/Ahligizi/Pages'), for: 'App\\Filament\\Ahligizi\\Pages')
            ->pages([
                /* Pages\Dashboard::class, */
                ViewGrafikKms::class,
                Pages\LaporanBalita::class,
                Pages\LaporanRiwayatPemeriksaan::class
            ])
            ->navigationGroups([
                'Data',
                'Pemeriksaan Gizi',
                'Laporan',
            ])
            ->discoverWidgets(in: app_path('Filament/Ahligizi/Widgets'), for: 'App\\Filament\\Ahligizi\\Widgets')
            ->widgets([
                Widgets\AhliGiziDashboard::class
            ])
            ->spa()
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
