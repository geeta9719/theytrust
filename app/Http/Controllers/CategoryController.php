<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(10);
        return view('admin.category.index', ['category' => $category]);
    }
    public function create()
    {
        return view('admin.category.create');
    }

    //public function store(Request $request){
        public function store()
        {
            $inputs = request()->validate([
                'category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'page_heading' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255|unique:categories,slug',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'title_type' => 'nullable|string|max:255',
            ]);
        
            Category::create($inputs);
        
            session()->flash('msg', 'Category inserted');
            return back();
        }        

    public function edit(Request $request, $category)
    {
        $category = Category::find($category);
        return view('admin.category.edit', ["category" => $category]);
    }

    public function update(Request $request, $category)
{
    $category = Category::findOrFail($category);

    $validated = $request->validate([
        'category' => 'required|string|max:255',
        'description' => 'nullable|string',
        'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        'page_heading' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'title_type' => 'nullable|string|max:255',
    ]);

    $category->update($validated);

    session()->flash('msg', 'Category updated successfully');
    return redirect()->route('admin.category.index');
}


    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        $request->session()->flash('message', 'Category is Deleted');//use when we use request
        return back();
    }

    public function set_priority(Request $request)
    {
        $category = Category::find($request->id);
        $category->top_cat = $request->top_cat;
        $category->save();
        echo 1;
    }

}
