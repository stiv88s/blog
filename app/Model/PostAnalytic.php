<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostAnalytic extends Model
{
    protected $fillable = ['post_id', 'user_id', 'showed_count','date'];

    protected $table = 'post_analytic';
}
