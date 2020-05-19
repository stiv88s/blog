<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Dislike;
use App\Model\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    public function dislike(Request $request, $id,$comment=null)
    {
        if($comment){
            $id = $comment;
        }

        $type = $request->type;
        $like = $this->checkLike($type, $id);
        $dislike = $this->checkDislike($type, $id);

        if (!$like && $dislike) {
            $dislike->delete();
            $likesCount = $this->getLikeCount($id, $type);
            $dislikesCount = $this->getDisLikeCount($id, $type);

            return ['like' => false, 'likecount' => $likesCount, 'dislike' => false, 'dislikecount' => $dislikesCount];

        } elseif ($like && !$dislike) {
            $like->delete();

            Dislike::create([
                'user_id' => Auth::id(),
                'dislikeable_type' => $type,
                'dislikeable_id' => $id
            ]);

            $dislikesCount = $this->getDisLikeCount($id, $type);
            $likesCount = $this->getLikeCount($id, $type);

            return ['like' => false, 'likecount' =>  $likesCount, 'dislike' => true, 'dislikecount' => $dislikesCount];

        } else {
            Dislike::create([
                'user_id' => Auth::id(),
                'dislikeable_type' => $type,
                'dislikeable_id' => $id
            ]);
            $dislikesCount = $this->getDisLikeCount($id, $type);
            $likesCount = $this->getLikeCount($id, $type);


            return ['like' => false, 'likecount' =>  $likesCount, 'dislike' => true, 'dislikecount' => $dislikesCount];

        }

    }

    public function checkLike($type, $id)
    {
        $like = Like::whereUserId(Auth::id())
            ->whereLikeableType($type)
            ->whereLikeableId($id)
//            ->withTrashed()
            ->first();

        return $like;
    }

    public function checkDislike($type, $id)
    {
        $dislike = Dislike::whereUserId(Auth::id())
            ->whereDislikeableType($type)
            ->whereDislikeableId($id)
//            ->withTrashed()
            ->first();

        return $dislike;
    }

    public function getDisLikeCount($id, $type)
    {
        $disLikesCount = Dislike::whereDislikeableId($id)
            ->whereDislikeableType($type)->get()->count();
        return $disLikesCount;
    }

    public function getLikeCount($id, $type)
    {
        $likesCount = Like::whereLikeableId($id)
            ->whereLikeableType($type)->get()->count();
        return $likesCount;
    }
}
