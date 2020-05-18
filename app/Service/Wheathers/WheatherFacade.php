<?php

namespace App\Service\Wheathers;


use Illuminate\Support\Facades\Facade;

class WheatherFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wheather';
    }
}
