<?php

namespace App\Observers;

use App\Models\DemandImages;

class DemandImageObserver
{
    public function created(DemandImages $demandImages): void
    {
        $demandImages->demand->touch();
    }

    /**
     * Handle the TeamActivation "updated" event.
     */
    public function updated(DemandImages $demandImages): void
    {
        $demandImages->demand->touch();
    }

}
