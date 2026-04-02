<?php

namespace App\Observers;

use App\Events\Charge\ChargeCreated;
use App\Events\Charge\ChargeUpdated;
use App\Models\Charge;

class ChargeObserver
{
    /**
     * Handle the Charge "created" event.
     */
    public function created(Charge $charge): void
    {
        broadcast(new ChargeCreated($charge->id));
    }

    /**
     * Handle the Charge "updated" event.
     */
    public function updated(Charge $charge): void
    {
        broadcast(new ChargeUpdated($charge->id));
    }

    /**
     * Handle the Charge "deleted" event.
     */
    public function deleted(Charge $charge): void
    {
        //
    }

    /**
     * Handle the Charge "restored" event.
     */
    public function restored(Charge $charge): void
    {
        //
    }

    /**
     * Handle the Charge "force deleted" event.
     */
    public function forceDeleted(Charge $charge): void
    {
        //
    }
}
