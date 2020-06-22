<?php

namespace App\ModelRepository;

use App\Model\Admin;
use App\Model\Post;
use App\Model\PostAnalytic;
use Carbon\Carbon;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostRepository extends Repository
{

    public function getEntity()
    {
        return Post::class;

    }

    public function active()
    {
        return $this->getEntity()::where('is_active', 1);
    }

    public function paginate($limit = 5)
    {
        $q = $this->getEntity()::where('is_active', 1);

        return $q->paginate($limit);
//        $posts = Cache::remember('posts', 120, function () use ($limit) {
//            $q = $this->getEntity()::where('is_active', 1);
//
//            return $q->paginate($limit);
//        });

//        return $posts;
    }

    public function filter()
    {
//        DB::connection()->enableQueryLog();
//        $q = $this->getEntity()::where('is_active', 1);
//
//        $values = ['user_id' => [1], 'slug' => ['uk', 'ukraine']];
//
//        foreach ($values as $key => $value) {
//
//            $q->whereIn($key, $value);
//
//        }
//
//        $s = $q->get();
//        dd($s);
//        $queries = DB::getQueryLog();
//        dd($queries);

    }

    public function getTopPosts($n, $startDate, $endDate)
    {

        $topPosts = DB::SELECT("SELECT
        COUNT(*) AS post_uniq,
        SUM(post_analytic.showed_count) as not_unique,
        post_analytic.post_id,
        posts.title
        FROM post_analytic
        INNER JOIN posts ON posts.id = post_analytic.post_id
        WHERE post_analytic.updated_at >= :startedAt
        AND post_analytic.updated_at <= :finishAt
        GROUP BY post_analytic.post_id
        ORDER BY COUNT(*) DESC
        LIMIT :n
        ", [
            'startedAt' => $startDate,
            'finishAt' => $endDate,
            'n' => $n

        ]);


        return $topPosts;
    }

    public function postAnalytic($startDate, $endDate)
    {

        $postAnalytic = DB::SELECT("SELECT
        SUM(post_analytic.showed_count) as not_unique,
        post_analytic.post_id,
        post_analytic.date,
        posts.title
        FROM post_analytic
        INNER JOIN posts ON posts.id = post_analytic.post_id
        WHERE post_analytic.updated_at >= :startedAt
        AND post_analytic.updated_at <= :finishAt
        GROUP BY post_analytic.post_id,post_analytic.date,post_analytic.updated_at
        ORDER BY post_analytic.date ASC, post_analytic.updated_at ASC
        ", [
            'startedAt' => $startDate,
            'finishAt' => $endDate,

        ]);

        return $postAnalytic;

    }
}
