<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCommentRequest;
use App\Model\Comment;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreUserCommentRequest$request, Post $post)
    {
        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);
        return $comment->orderBy('created_at','desc')->with('user')->first();
//        return redirect()->route('showing.post',[$post,$post->slug]);
    }
}
