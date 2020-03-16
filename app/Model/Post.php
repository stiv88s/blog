<?php

namespace App\Model;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Bnb\Laravel\Attachments\HasAttachment;

class Post extends Model
{
    use UuidTrait, HasAttachment;

    protected $fillable = ['title','subtitle','is_active','slug','body','user_id'];


    public function getHeaderImageAttribute()
    {
        return $this->attachment('post_header_image')->url ?? null;
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

//    public function category()
//    {
//        return $this->belongsToMany(Category::class,'category_posts','posts_id','category_id');
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
