<?php

namespace App\Providers;

use App\Models\Modul;
use App\Observers\ModulObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Modul::observe(ModulObserver::class);
    }
}
