<?php

namespace App\Observers;

use App\Model\Post;
use Illuminate\Support\Facades\Cache;

class PostsObserver
{
    protected $pRepo;

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
