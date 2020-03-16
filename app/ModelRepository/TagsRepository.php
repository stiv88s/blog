<?php

namespace App\ModelRepository;


use App\Model\Tag;

class TagsRepository extends Repository
{

    public function getEntity()
    {
        return Tag::class;
    }

}
