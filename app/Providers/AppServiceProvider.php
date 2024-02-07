<?php

namespace App\Providers;

use App\Models\Demand;
use App\Observers\DemandUserObserver;
use Illuminate\Database\Eloquent\Model;
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
        //
        //Model::unguard();
        Demand::observe(DemandUserObserver::class);
    }
}
