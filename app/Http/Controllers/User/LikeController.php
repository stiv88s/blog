<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Dislike;
use App\Model\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, $id)
    {

        $type = $request->type;


        $like = $this->checkLike($type, $id);
        $dislike = $this->checkDislike($type, $id);

        if ($like && !$dislike) {
            $like->delete();

            $likesCount = $this->getLikeCount($id,$type);
            $dislikesCount = $this->getDisLikeCount($id, $type);

            return ['like' => false, 'likecount'=> $likesCount,'dislike'=>false,'dislikecount'=>$dislikesCount];

        } elseif (!$like && $dislike) {
            $dislike->delete();

            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => $type,
                'likeable_id' => $id
            ]);
            $likesCount = $this->getLikeCount($id,$type);
            $dislikesCount = $this->getDisLikeCount($id, $type);


            return ['like' => true, 'likecount'=> $likesCount, 'dislike' => false,'dislikecount'=>$dislikesCount];
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => $type,
                'likeable_id' => $id
            ]);
            $likesCount = $this->getLikeCount($id,$type);
            $dislikesCount = $this->getDisLikeCount($id, $type);


            return ['like' => true,'likecount'=> $likesCount,'dislike'=>false,'dislikecount'=>$dislikesCount];

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
    public function getLikeCount($id,$type){
        $likesCount = Like::whereLikeableId($id)
            ->whereLikeableType($type)->get()->count();
        return $likesCount;
    }

    public function getDisLikeCount($id, $type)
    {
        $disLikesCount = Dislike::whereDislikeableId($id)
            ->whereDislikeableType($type)->get()->count();
        return $disLikesCount;
    }
}
