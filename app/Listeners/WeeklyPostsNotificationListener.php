<?php

namespace App\Listeners;

use App\Events\WeeklyPostsNotificationEvent;
use App\Notifications\Subscribers\WeeklyPostsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WeeklyPostsNotificationListener
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
     * @param WeeklyPostsNotificationEvent $event
     * @return void
     */
    public function handle(WeeklyPostsNotificationEvent $event)
    {
        foreach ($event->subscribers as $subscriber) {

            $subscriber->notify(new WeeklyPostsNotification($event->weeklyMostViewsPosts));
        }
    }
}
