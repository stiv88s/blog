<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dislike extends Model
{
//    use SoftDeletes;

    protected $table = 'dislikeables';

    protected $fillable = [
        'user_id',
        'dislikeable_id',
        'dislikeable_type',
    ];

    /**
     * Get all of the posts that are assigned this like.
     */
    public function posts()
    {
        return $this->morphedByMany('App\Model\Post', 'dislikeable');
    }

    public function comments()
    {
        return $this->morphedByMany('App\Model\Comment', 'dislikeable');
    }
}
