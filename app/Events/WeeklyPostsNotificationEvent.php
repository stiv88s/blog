<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WeeklyPostsNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $subscribers;
    public $weeklyMostViewsPosts;

    public function __construct($subscribers, $weeklyMostViewsPosts)
    {
        $this->subscribers = $subscribers;
        $this->weeklyMostViewsPosts = $weeklyMostViewsPosts;
    }

}
