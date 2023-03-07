<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\PingCheck;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            CacheCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            PingCheck::new()->url('https://google.com')->timeout(2),
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Layanan TI',
                'Buku Tamu',
                'Arsip',
                'Pengaturan',
                'Pengaturan Arsip',
            ]);
        });

        Filament::registerStyles([
            'https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css',
            asset('css/app.css'),
        ]);
    }
}
