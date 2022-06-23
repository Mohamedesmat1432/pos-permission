<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index(Request $request)
    {
        $categories = Category::when($request->search,function ($query) use ($request) {
            return $query->where('name','like','%'. $request->search .'%');
        })->latest()->paginate(3);
        return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        $category = Category::create($request->all());
        session()->flash('success',__('added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' .$category->id ,
        ]);

        $category->update($request->all());
        session()->flash('success',__('updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success',__('deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
