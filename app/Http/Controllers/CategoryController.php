<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    //
    public function index(){
        $category = Category::paginate(10);
        //dd($category);
        return view('admin.category.index' , ['category' => $category]);
    }
    public function create(){
        return view('admin.category.create');
    }

    //public function store(Request $request){
    public function store(){
        $inputs = request()->validate([
            'category' => 'required',
        ]);
        $inputs['description'] = request()->description;
        Category::create($inputs);
        session()->flash('msg','Category inserted');
        //return redirect()->route('admin.Category.index');
        return back();
    }

    public function edit(Request $request,$category){
        $category = Category::find($category);
        return view('admin.category.edit',["category"=>$category]);
    }

    public function update(Request $request, $category){
        $category = Category::find($category);
        $inputs = request()->validate([
            'category' => 'required',
        ]);
        $category->description = $request->description;
        $category->category = $inputs['category'];
        $category->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.category.index');
        //return back();
    }

    public function destroy(Category $category, Request $request){ 
        $category->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','Category is Deleted');//use when we use request
        return back();
    } 

    public function set_priority(Request $request){ 
        $category = Category::find($request->id);
        $category->top_cat = $request->top_cat;        
        $category->save();
        echo 1;
    } 

}
