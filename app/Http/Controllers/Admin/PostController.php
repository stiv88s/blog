<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use App\ModelRepository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct(PostRepository $prepo)
    {
        $this->prepo = $prepo;
    }

    public function create()
    {
        $post = new Post();
        $tags = Tag::all()->pluck('name', 'id');
        $categorys = Category::all()->pluck('name', 'id');

        return view('admin.posts.create', compact('tags', 'categorys', 'post'));
    }

    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
//        $post = Posts::find(1);
//
//        dd($post->category);
//        $post1 = Category::find(13);
//
//        dd($post1->posts);
//        $posts = $this->prepo->active()->get();
//        dd($posts);
    }

    public function edit(Post $post)
    {
        $tags = Tag::all()->pluck('name', 'id');
        $categorys = Category::all()->pluck('name', 'id');
        return view('admin.posts.edit', compact('post', 'tags', 'categorys'));
    }

    public function store(CreatePostRequest $request)
    {
        $active = $request->input('is_active', 0);
        $user = Auth::user();
        $post = Post::create([
            'title' => $request->input('title'),
            'is_active' => $active,
            'slug' => $request->input('slug'),
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'body' => $request->input('body'),
            'user_id' => $user->id

        ]);

        if ($request->hasFile('header_image')) {
            $post->attach($request->file('header_image'), ['key' => 'post_header_image']);
        }

        $post->tags()->sync($request->tags);
        $post->categorys()->sync($request->categorys);

        Session::flash('status', 'Post is created');

        return redirect()->route('post.index',app()->getLocale());

    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $active = $request->input('is_active', 0);
        $post->fill([
            'title' => $request->input('title'),
            'is_active' => $active,
            'slug' => $request->input('slug'),
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'body' => $request->input('body'),
        ]);

        if ($request->hasFile('header_image')) {
            $post->attach($request->file('header_image'), ['key' => 'post_header_image']);
        }

        $post->save();

        $post->tags()->sync($request->tags);
        $post->categorys()->sync($request->categorys);

        Session::flash('status', 'Post is Updated');

        return redirect()->route('post.index',app()->getLocale());

    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
//    public function show($uuid){
//        dd(Posts::where('uuid',$uuid)->first());
//    }

    public function test(Post $post, $d)
    {
        dd($post, $d);

    }

    public function destroy(Post $post)
    {
        if ($post->attachment('post_header_image')) {

            $post->attachment('post_header_image')->delete();
        }
        $post->delete();

//        return redirect()->route('post.index');
    }
}
