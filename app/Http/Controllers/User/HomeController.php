<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
//        if(Session::has('locale')){
//            $locale = Session('locale');
//
//        }
        $posts = $this->postR->paginate(5);
//        dd($this->postR->filter());
        $categories = Category::all();

        return view('welcome', compact('posts', 'categories'));
    }

    public function setLocale(Request $request)
    {

        if (in_array($request->lang, array_keys(config('app.supported_locales')))) {

            app()->setLocale($request->lang);

        } else {

            Session(['locale' => config('app.fallback_locale')]);
        }
        return redirect()->to('/' . app()->getLocale());
    }
}
