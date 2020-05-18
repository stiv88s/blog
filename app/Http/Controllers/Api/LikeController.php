<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Constants\LikeConstants;
use App\Model\Constants\PostConstants;
use App\Model\Dislike;
use App\Model\Like;
use App\Model\Post;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     *
     * @api {get} https://api.admin-blog.test/api/v1/like/{model_id} Like Entity
     * @apiGroup Like
     * @apiUse api1
     * @apiParam {string} model_type post or comment
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      'like' => true,
     *      'likecount' => 1,
     *      'dislike' => false,
     *      'dislikecount' => 12
     *
     *     }
     * @apiError          404 Not found
     * @apiError          400 Bad Request
     * @apiError          400 Bad Request Wrong Model Type
     * @apiError          400 Bad Request Model Not Exist
     *
     */
    public function like(Request $request, $modelId)
    {
        if (!in_array($request->type, LikeConstants::LIKE_MODEL)) {
            return response()->json(['Wrong Model Type'], 400);
        }

        $classModel = "App\Model\\" . ucfirst(strtolower($request->type));

        if (!class_exists($classModel)) {
            return response()->json(['Model Not Exist'], 400);
        }

        $entity = $classModel::findOrFail($modelId);
        $type =  $classModel;
        $like = $this->checkLike($type, $entity->id);
        $dislike = $this->checkDislike($type, $entity->id);

        if ($like && !$dislike) {
            $like->delete();

            $likesCount = $this->getLikeCount($entity->id, $type);
            $dislikesCount = $this->getDisLikeCount($entity->id, $type);

            return ['like' => false, 'likecount' => $likesCount, 'dislike' => false, 'dislikecount' => $dislikesCount];

        } elseif (!$like && $dislike) {
            $dislike->delete();

            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => $type,
                'likeable_id' => $entity->id
            ]);
            $likesCount = $this->getLikeCount($entity->id, $type);
            $dislikesCount = $this->getDisLikeCount($entity->id, $type);

            return ['like' => true, 'likecount' => $likesCount, 'dislike' => false, 'dislikecount' => $dislikesCount];
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => $type,
                'likeable_id' => $entity->id
            ]);
            $likesCount = $this->getLikeCount($entity->id, $type);
            $dislikesCount = $this->getDisLikeCount($entity->id, $type);

            return ['like' => true, 'likecount' => $likesCount, 'dislike' => false, 'dislikecount' => $dislikesCount];

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

    public function getLikeCount($id, $type)
    {
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
