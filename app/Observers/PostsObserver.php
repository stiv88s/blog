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

        if ($post->is_active == PostConstants::ACTIVE) {

            $subscribers = Subscribers::all();
            foreach ($subscribers as $subscriber) {
                $subscriber->notify(new SubscribersNotification());
            }

        }

    }

//    public function retrieved(Post $post)
//    {
//        if (Cache::has('post_' . $post->id)) {
//
//            $post->setVirtualCountPeople();
//
////            dd($post,$post1);
////            $post = $post1;
//
//        } else {
//            Cache::put('post_' . $post->id, $post, 300);
//        }
//
//    }
}
