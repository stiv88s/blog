<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Support\Facades\Auth;

class Post extends Model implements GenerableInterface
{
    use UuidTrait, HasAttachment,GenerableTrait;

    protected $fillable = ['title', 'subtitle', 'is_active', 'slug', 'body', 'user_id'];

    private $generable= true;

//    protected $virtualCount = [
//        'people' => 0
//    ];


    public function getHeaderImageAttribute()
    {
        return $this->attachment('post_header_image')->url ?? null;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags')->withTimestamps();
//        return $this->hasMany(Tag::class);
    }

    public function categorys()
    {
        return $this->belongsToMany(Category::class, 'category_posts', 'posts_id', 'category_id')->withTimestamps();
    }

    public function likes()
    {
        return $this->morphToMany('App\Model\User', 'likeable');
    }

    public function dislikes()
    {
        return $this->morphToMany('App\Model\User', 'dislikeable');
    }

    public function isliked()
    {
        return (bool)$this->likes()->where('user_id', Auth::id())->exists();

    }

    public function isDisliked()
    {

        return (bool)$this->dislikes()->where('user_id', Auth::id())->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->dislikes()->count();
    }

//    public function getPeopleCountAttribute()
//    {
//
//        return $this->virtualCount['people'];
//    }
//
//    public function setVirtualCountPeople()
//    {
//        $this->virtualCount['people'] +=1;
//    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

//    /**
//     * Get the route key for the model.
//     *
//     * @return string
//     */
//    public function getRouteKeyName()
//    {
//        return 'uuid';
//    }


}
