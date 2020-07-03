<?php

namespace App\Observers;

use App\Model\Constants\PostConstants;
use App\Model\Post;
use App\Model\Subscribers;
use App\Notifications\Subscribers\SubscribersNotification;
use Illuminate\Support\Facades\Cache;

class PostsObserver
{
    protected $pRepo;

    public function created(Post $post)
    {

//        $p = Post::findOrFail($post->id);
//        dd($p);
//
//        if ($post->is_active == PostConstants::ACTIVE) {
//
//            $subscribers = Subscribers::all();
//            foreach ($subscribers as $subscriber) {
//                $subscriber->notify(new SubscribersNotification($post));
//            }
//
//        }

    }

}
