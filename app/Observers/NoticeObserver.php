<?php

namespace App\Observers;

use App\Models\Notice;

class NoticeObserver
{
    /**
     * Handle the Notice "created" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function created(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "updated" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function updated(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "deleted" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function deleted(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "restored" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function restored(Notice $notice)
    {
        //
    }

    /**
     * Handle the Notice "force deleted" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function forceDeleted(Notice $notice)
    {
        //
    }
}
