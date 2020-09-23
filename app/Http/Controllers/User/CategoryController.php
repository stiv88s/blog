<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\ModelRepository\CategoryRepository;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $pRepo;

    public function __construct(PostRepository $pRepo)
    {
        $this->pRepo = $pRepo;
    }

    public function showCategoryPosts(Category $category)
    {
        $posts = $category->postActive()->paginate(5);

        $categories = Category::all();

        return view('user.categories.index',compact('posts','categories','category'));
    }
}
