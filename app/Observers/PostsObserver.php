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
    protected $pRepo;


    public function updated(Post $post)
    {
        $postAdminId = ((object)($post->getOriginal()))->id;


        if (Auth::user()->id == $postAdminId) {
            event(new AdminPostUpdatedEvent($post));
        }

    }

}
