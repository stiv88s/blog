<?php


namespace App\Traits;


trait GenerableTrait
{
    public static function isGenerable()
    {
        if (isset((new self)->generable)) {
            return (new self)->generable;
        } else {
            return false;
        }
    }
}
