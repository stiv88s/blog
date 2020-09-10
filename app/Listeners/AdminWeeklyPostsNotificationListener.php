<?php

namespace App\Listeners;

use App\Events\AdminWeeklyPostsNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminWeeklyPostsNotificationListener
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
     * @param  AdminWeeklyPostsNotificationEvent  $event
     * @return void
     */
    public function handle(AdminWeeklyPostsNotificationEvent $event)
    {
        //
    }
}
