<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements GenerableInterface
{
    protected $fillable = ['name', 'slug'];

    const IS_GENERABLE = true;


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags')->withTimestamps();
    }

    public function postActive()
    {

        return $this->posts()->where('is_active', '=', 1);
    }

    public static function isGenerable()
    {
        if ((new static)::IS_GENERABLE) {
            return (new static)::IS_GENERABLE;
        } else {
            return false;
        }

    }
}
