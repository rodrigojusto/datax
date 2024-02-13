<?php

namespace App\Providers;

use App\Models\Demand;
use App\Models\DemandImages;
use App\Models\DemandObservation;
use App\Models\TechnicalActivation;
use App\Observers\DemandImageObserver;
use App\Observers\DemandObservationObserver;
use App\Observers\DemandUserObserver;
use App\Observers\TechnicalActivationObserver;
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
        DemandObservation::observe(DemandObservationObserver::class);
        DemandImages::observe(DemandImageObserver::class);
        TechnicalActivation::observe(TechnicalActivationObserver::class);
    }
}
