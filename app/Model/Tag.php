<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];


    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tags')->withTimestamps();
    }

    public function postActive()
    {

        return $this->posts()->where('is_active', '=', 1);
    }
}
