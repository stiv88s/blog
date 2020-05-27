<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements GenerableInterface
{
    use GenerableTrait;

    protected $fillable = ['name', 'slug'];

    private $generable = true;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags')->withTimestamps();
    }

    public function postActive()
    {

        return $this->posts()->where('is_active', '=', 1);
    }


}
