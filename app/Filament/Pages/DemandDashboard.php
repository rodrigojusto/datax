<?php

namespace App\Filament\Pages;

use Filament\Panel;

class DemandDashboard extends \Filament\Pages\Dashboard
{

    protected static string $routePath = 'demands/dashboard'; //usar Rota para outros Dashboards
     protected static ?string $title = 'Dashboard de Demandas';
     //protected static ?int $navigationSort = 15; //ordem do dashboard (funciona somente entre os dashboards
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->pages([]);
    }
}
