<?php

namespace App\Observers;

use App\Models\Apiuser;

class Apiuserobserver
{
    /**
     * Handle the Apiuser "created" event.
     *
     * @param  \App\Models\Apiuser  $apiuser
     * @return void
     */
    public function created(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "updated" event.
     *
     * @param  \App\Models\Apiuser  $apiuser
     * @return void
     */
    public function updated(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "deleted" event.
     *
     * @param  \App\Models\Apiuser  $apiuser
     * @return void
     */
    public function deleted(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "restored" event.
     *
     * @param  \App\Models\Apiuser  $apiuser
     * @return void
     */
    public function restored(Apiuser $apiuser)
    {
        //
    }

    /**
     * Handle the Apiuser "force deleted" event.
     *
     * @param  \App\Models\Apiuser  $apiuser
     * @return void
     */
    public function forceDeleted(Apiuser $apiuser)
    {
        //
    }
}
