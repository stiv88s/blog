<?php

namespace App\ModelRepository;

use App\Model\Admin;
use App\Model\Post;
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
}
