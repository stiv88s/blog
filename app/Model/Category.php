<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'tag'];

    public function posts()
    {
//        return $this->hasManyThrough
//        return $this->belongsToMany(Posts::class);
    }
}
