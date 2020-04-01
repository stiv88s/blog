<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $postR;

    public function __construct(PostRepository $post)
    {
        $this->postR = $post;
    }

    public function index()
    {

        $posts = $this->postR->paginate(5);
        $categories = Category::all();

        return view('welcome', compact('posts', 'categories'));
    }
}
