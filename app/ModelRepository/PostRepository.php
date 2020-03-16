<?php

namespace App\ModelRepository;

use App\Model\Admin;
use App\Model\Post;

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
}
