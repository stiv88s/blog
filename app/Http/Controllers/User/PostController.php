<?php

namespace App\Http\Controllers\User;

use App\Events\PostShowEvent;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Like;
use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Wheather;

class PostController extends Controller
{
    public function show(Request $request, Post $post)
    {
//        if ($request->city) {
//
//            $wheather = Wheather::load($request->city);
//
//        } else {
//            $wheather = Wheather::getWheather();
//        }
        $wheather = [];
        $comments = $post->comments()->with('user')->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        event(new PostShowEvent($post));

        if ($request->wantsJson()) {
            return $comments;
        }
        return view('user.posts.show', compact('post', 'comments', 'categories', 'wheather'));
    }


}
