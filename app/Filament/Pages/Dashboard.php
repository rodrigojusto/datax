<?php

namespace App\Filament\Pages;

use Filament\Panel;

class Dashboard extends \Filament\Pages\Dashboard
{

    // protected static string $routePath = 'finance'; //usar Rota para outros Dashboards
     protected static ?string $title = 'Finance dashboard';
     //protected static ?int $navigationSort = 15; //ordem do dashboard (funciona somente entre os dashboards
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->pages([]);
    }
}
