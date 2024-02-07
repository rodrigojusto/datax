<?php

namespace App\Observers;

use App\Models\Demand;

class DemandUserObserver
{
    /**
     * Handle the Demand "created" event.
     */
    public function creating(Demand $demand): void
    {
        $demand->created_by = auth()->id();
    }

    /**
     * Handle the Demand "updated" event.
     */
    /*public function updating(Demand $demand): void
    {
        $demand->updated_by = auth()->id();
    }*/

}
