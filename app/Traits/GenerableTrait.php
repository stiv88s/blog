<?php


namespace App\Traits;


trait GenerableTrait
{
    public static function isGenerable()
    {
        if (isset((new self)->generable)) {
            return (new static)->generable;
        } else {
            return false;
        }
    }
}
