<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostsIndexResource;
use App\Http\Resources\Api\PostShowResource;
use App\Model\Post;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $posts;

    public function __construct(PostRepository $prepo)
    {
        $this->posts = $prepo;
    }

    /**
     *
     * @api {get} https://api.admin-blog.test/api/v1/post/ List of posts
     * @apiGroup Post
     * @apiUse api1
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "data": [
     *           {
     *          "id": 8,
     *          "title": "this is new",
     *          "subtitle": "title",
     *          "admin_name": "stiv",
     *          "created_at": "2020-05-14 09:20:31"
     *          }
     *       ],
     *      "total": 2,
     *      "count": 1,
     *      "current_page": 2,
     *      "last_page": 2,
     *      "link_to_next_page": null,
     *      "prev_link_page": "http://api.admin-blog.test/api/v1/post?page=1"
     *
     *
     *     }
     *
     */
    public function index()
    {
        $posts = $this->posts->paginate(5);

        return new PostsIndexResource($posts);
    }


    /**
     *
     * @api {get} https://api.admin-blog.test/api/v1/post/{post_id} Post Show
     * @apiGroup Post
     * @apiUse api1
     *
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *      "data": [
     *           {
     *          "id": 8,
     *          "title": "this is new",
     *          "subtitle": "title",
     *          "admin_name": "stiv",
     *          "created_at": "2020-05-14 09:20:31",
     *          'is_liked' : true,
     *          'is_disliked' :false,
     *          'like_count':25,
     *          'dislike_count':3,
     *          'comments':[
     *               {
     *                "id": 1,
     *               "user_name": "ssss",
     *               "body": "nnn",
     *               "created_at": "6 days ago"
     *               },
     *               {
     *               "id": 2,
     *               "user_name": "ssss",
     *               "body": "ddd",
     *               "created_at": "5 days ago"
     *               },
     *
     *              ],
     *          "comments_next_page": "http://api.admin-blog.test/api/v1/post/7?page=2",
     *          "comments_prev_page": null
     *          }
     *       ],
     *
     *     }
     * @apiError          UNAUTHORIZED 404 Not found
     *
     */
    public function show(Post $post)
    {
        return new PostShowResource($post);

    }
}
