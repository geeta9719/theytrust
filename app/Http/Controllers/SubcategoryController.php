<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategory = Subcategory::paginate(10);
        //dd($contact);
        return view('admin.subcategory.index', ['subcategory' => $subcategory]);
    }
    public function create()
    {
        $category = Category::all();
        return view('admin.subcategory.create', ['category' => $category]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'category_id'       => 'required|exists:categories,id',
            'subcategory'       => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255',
            'title_type'        => 'nullable|string|max:100',
            'page_heading'      => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'description'       => 'nullable|string',
            'top_subcat'        => 'nullable|boolean',
        ]);
    
        Subcategory::create($inputs);
    
        session()->flash('msg', 'Subcategory inserted successfully');
        return back();
    }
    

    public function edit(Request $request, $subcategory)
    {
        $subcategory = Subcategory::find($subcategory);
        $category = Category::all();
        return view('admin.subcategory.edit', ["subcategory" => $subcategory,"category" => $category]);
    }

    public function update(Request $request, $subcategory)
{
    $subcategory = Subcategory::findOrFail($subcategory);

    $inputs = $request->validate([
        'subcategory'       => 'required|string|max:255',
        'slug'              => 'nullable|string|max:255',
        'title_type'        => 'nullable|string|max:100',
        'page_heading'      => 'nullable|string|max:255',
        'meta_title'        => 'nullable|string|max:255',
        'meta_description'  => 'nullable|string',
        'description'       => 'nullable|string',
        'category_id'       => 'required|exists:categories,id',
        'top_subcat'        => 'nullable|boolean',
    ]);

    $subcategory->update($inputs);

    session()->flash('msg', 'Subcategory updated successfully');
    return redirect()->route('admin.subcategory.index');
}


    public function destroy(Subcategory $subcategory, Request $request)
    {
        $subcategory->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message', 'subcategory is Deleted');//use when we use request
        return back();
    }

    public function set_priority(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        $subcategory->top_subcat = $request->top_subcat;
        $subcategory->save();
        echo 1;
    }
}
