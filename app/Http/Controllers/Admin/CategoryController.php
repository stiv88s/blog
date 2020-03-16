<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\ModelRepository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $cRepo;

    public function __construct(CategoryRepository $cRepo)
    {
        $this->cRepo = $cRepo;
    }

    public function index()
    {
        $categories = Category::all();

        return view('admin.categorys.index', compact('categories'));
    }

    public function destroy($id)
    {
        $this->cRepo->destroy($id);

        return ['deleted' => true];
    }

    public function edit(Category $category)
    {

        return view('admin.categorys.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->cRepo->update($category->id, $request->all());

        return redirect()->route('category.index');

    }

    public function create()
    {
        return view('admin.categorys.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('category.index');
    }
}
