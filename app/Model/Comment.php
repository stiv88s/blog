<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'body', 'created_at'];
//    protected $dates = ['created_at'];
    protected $dates = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable');
    }

    public function dislike()
    {
        return $this->morphToMany(User::class, 'dislikeables');
    }

    public function isLiked()
    {
        return (bool)$this->likes()->where('user_id', Auth::id())->exist();
    }

    public function isDisliked()
    {
        return (bool)$this->dislikes()->where('user_id', Auth::id())->exist();
    }

    public function getLikeCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getCreatedAtAttribute($value)
    {

        return Carbon::parse($value)->diffForHumans();
    }
}
