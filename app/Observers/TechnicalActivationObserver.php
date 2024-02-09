<?php

namespace App\Observers;

use App\Models\TechnicalActivation;

class TechnicalActivationObserver
{
    /**
     * Handle the TeamActivation "created" event.
     */
    public function created(TechnicalActivation $teamActivation): void
    {
        $teamActivation->demand->touch();
    }

    /**
     * Handle the TeamActivation "updated" event.
     */
    public function updated(TechnicalActivation $teamActivation): void
    {
        $teamActivation->demand->touch();
    }

}
