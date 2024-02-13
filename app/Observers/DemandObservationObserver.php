<?php

namespace App\Observers;

use App\Models\DemandObservation;

class DemandObservationObserver
{
    public function created(DemandObservation $demandObservation): void
    {
        $demandObservation->demand->touch();
    }

    /**
     * Handle the TeamActivation "updated" event.
     */
    public function updated(DemandObservation $demandObservation): void
    {
        $demandObservation->demand->touch();
    }

}
