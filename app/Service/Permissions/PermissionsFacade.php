<?php

namespace App\Service\Permissions;


use Illuminate\Support\Facades\Facade;

class PermissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'permission';
    }
}
