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
        AND posts.is_active = 1
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
        post_analytic.user_id,
        posts.title
        FROM post_analytic
        INNER JOIN posts ON posts.id = post_analytic.post_id
        WHERE post_analytic.updated_at >= :startedAt
        AND post_analytic.updated_at <= :finishAt
        AND posts.is_active = 1
        GROUP BY post_analytic.post_id,post_analytic.date,post_analytic.updated_at,post_analytic.user_id
        ORDER BY post_analytic.date ASC, post_analytic.updated_at ASC
        ", [
            'startedAt' => $startDate,
            'finishAt' => $endDate,

        ]);


        return $postAnalytic;

    }

    public function getWeeklyMostViewPosts()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        $postsId = DB::SELECT("SELECT
         posts.id,
         SUM(post_analytic.showed_count) as MOSTVIEWED
         FROM posts
         INNER JOIN post_analytic ON posts.id = post_analytic.post_id
         WHERE posts.is_active = 1
         AND posts.created_at >=:weekStartDate
         AND posts.created_at <=:weekEndDate
         AND post_analytic.date >= :weekStartDate1
         AND post_analytic.date <= :weekEndDate2
         GROUP BY posts.id
         ORDER BY MOSTVIEWED DESC
         LIMIT 5
         ", [
            'weekStartDate' => $weekStartDate,
            'weekStartDate1' => $weekStartDate,
            'weekEndDate' => $weekEndDate,
            'weekEndDate2' => $weekEndDate,
        ]);

        $posts = Post::whereIn('id', array_column($postsId, 'id'))->get();

        return $posts;
    }
}
