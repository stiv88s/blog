<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,

        ],
        'App\Events\PostShowEvent'=>[
            'App\Listeners\PostShowListener',
        ],
        'App\Events\PostCreatedEvent'=>[
            'App\Listeners\PostCreatedListener',
        ],
        'App\Events\WeeklyPostsNotificationEvent'=>[
            'App\Listeners\WeeklyPostsNotificationListener',
        ],
        'App\Events\AdminWeeklyPostsNotificationEvent'=>[
            'App\Listeners\AdminWeeklyPostsNotificationListener',
        ],

        'App\Events\AdminPostUpdatedEvent'=>[
            'App\Listeners\AdminPostUpdatedListener',
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
