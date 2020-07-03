<?php

namespace App\Listeners;

use App\Events\PostCreatedEvent;
use App\Model\Constants\PostConstants;
use App\Model\Subscribers;
use App\Notifications\Subscribers\SubscribersNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostCreatedListener
{
    public $post;

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
     * @param PostCreatedEvent $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        $this->post = $event->post;

        if ($event->post->is_active == PostConstants::ACTIVE) {
            $subscribers = Subscribers::all();
            foreach ($subscribers as $subscriber) {
                $this->sendNotification($subscriber);
            }

        }
    }

    protected function sendNotification(Subscribers $subscriber)
    {
        $subscriber->notify(new SubscribersNotification($this->post));

    }
}
