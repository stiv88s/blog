<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\ModelRepository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public $cRepo;

    public function __construct(CategoryRepository $cRepo)
    {

        $this->cRepo = $cRepo;
    }

    public function index($locale = null)
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::all();
        return view('admin.categorys.index', compact('categories'));
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $this->cRepo->destroy($category->id);

        return ['deleted' => true];
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('admin.categorys.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $this->cRepo->update($category->id, $request->all());

        Session::flash('status', 'Category is Updated');

        return redirect()->route('category.index', app()->getLocale());

    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('admin.categorys.create');
    }

    public function store(Request $request, $locale = null)
    {
        $this->authorize('create', Category::class);
        Category::create($request->all());
        Session::flash('status', 'Category is Created');

        return redirect()->route('category.index', app()->getLocale());
    }


}
