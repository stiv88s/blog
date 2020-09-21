<?php

namespace App\Observers;

use App\Events\AdminPostUpdatedEvent;
use App\Model\Constants\PostConstants;
use App\Model\Post;
use App\Model\Subscribers;
use App\Notifications\Subscribers\SubscribersNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostsObserver
{

    public function updated(Post $post)
    {

        if (Auth::user()->id != $post->getOriginal('user_id')) {
            event(new AdminPostUpdatedEvent($post));
        }
    }


}
