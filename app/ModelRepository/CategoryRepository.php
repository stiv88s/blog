<?php

namespace App\ModelRepository;

use App\Model\Category;

class CategoryRepository extends Repository
{

    public function getEntity()
    {
        return Category::class;

    }
}
