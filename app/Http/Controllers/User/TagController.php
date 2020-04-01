<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Tag;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $pRepo;

    public function __construct(PostRepository $pRepo)
    {
        $this->pRepo = $pRepo;
    }

    public function showTagPosts(Tag $tag)
    {
        $posts = $tag->postActive()->paginate(5);

        $categories = Category::all();

        return view('welcome',compact('posts','categories'));
    }


}
