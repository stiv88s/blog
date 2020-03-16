<?php

namespace App\Traits;


use Webpatser\Uuid\Uuid;

trait UuidTrait {

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate()->string;
        });
    }

}

