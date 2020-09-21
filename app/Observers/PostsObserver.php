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

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\Post  $user
     * @return void
     */
    public function created(Post $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Post  $user
     * @return void
     */
    public function updated(Post $user)
    {
//        if(Auth::guard('admin')->check()){
//
//        }
//        dd('yes');

    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Post  $user
     * @return void
     */
    public function deleted(Post $user)
    {
        //
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\Models\Post  $user
     * @return void
     */
    public function forceDeleted(Post $user)
    {
        //
    }



}
