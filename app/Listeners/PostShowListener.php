<?php

namespace App\Listeners;

use App\Events\PostShowEvent;
use App\Model\Post;
use App\Model\PostAnalytic;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class PostShowListener
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
     * @param PostShowEvent $event
     * @return void
     */
    public function handle(PostShowEvent $event)
    {
        $post = $event->post;
        $this->checkShowCount($post);
    }

    protected function checkshowCount(Post $post)
    {
        if (Auth::check()) {
            $date = Carbon::now()->format('Y-m-d');

            $postAnalytic = PostAnalytic::where([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
                'date' => $date

            ])->first();

            if (!$postAnalytic) {
                $postAnalytic = PostAnalytic::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::id(),
                    'showed_count' => 1,
                    'date' => $date
                ]);
            } else {
                $postAnalytic->showed_count++;
                $postAnalytic->save();
            }
        }


        $post->all_showed_count++;
        $post->save();


    }
}
