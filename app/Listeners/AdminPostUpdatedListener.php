<?php

namespace App\Listeners;

use App\Events\AdminPostUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminPostUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminPostUpdatedEvent  $event
     * @return void
     */
    public function handle(AdminPostUpdatedEvent $event)
    {
        //
    }
}
