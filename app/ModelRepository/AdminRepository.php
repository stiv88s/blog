<?php

namespace App\ModelRepository;

use App\Model\Admin;

class AdminRepository extends Repository
{

    public function getEntity()
    {
        return Admin::class;

    }
}
