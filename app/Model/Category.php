<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model implements GenerableInterface
{
    use GenerableTrait;
    protected $fillable = ['name', 'slug'];

    private $generable = true;
//    public $order;
//
//    public function __construct(){
//        $s = session('order2');
//
//        if (is_null($s)) {
//
//            $data['name'] = Auth::id();
//            $this->order = new Tag($data);
//            session(['order2' => $this->order]);
//
//        } else {
//            $this->order = $s;
//
//        }
//
//    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function post()
    {
        return $this->belongsToMany(Post::class, 'category_posts', 'category_id', 'posts_id')->withTimestamps();
    }

    public function postActive()
    {

        return $this->post()->where('is_active', '=', 1);
    }

//    public function addProduct(Post $post)
//    {
//
////
//        $exist = $this->order->posts->contains($post);
//
//        if($exist){
//            $ps=$this->order->posts->where('id',$post->id)->first();
//
//            $ps->counts++;
//        }else{
//            $post->counts =1;
//            $this->order->posts->push($post);
//        }
//
//
//        dd($this->order->posts->where('id',23));
//
//
//    }


}
