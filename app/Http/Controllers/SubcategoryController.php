<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    
    public function index(){
        $subcategory = Subcategory::paginate(10);
        //dd($contact);
        return view('admin.subcategory.index' , ['subcategory' => $subcategory]);
    }
    public function create(){
        $category = Category::all();
        return view('admin.subcategory.create' , ['category' => $category]);
    }

    public function store(){
        $inputs = request()->validate([
            'category_id' => 'required',
            'subcategory' => 'required',
        ]);
        $inputs['description'] = request()->description;
        Subcategory::create($inputs);
        session()->flash('msg','Subcategory inserted');
        return back();
    }

    public function edit(Request $request,$subcategory){
        $subcategory = Subcategory::find($subcategory);
        $category = Category::all();
        return view('admin.subcategory.edit',["subcategory"=>$subcategory,"category"=>$category]);
    }

    public function update(Request $request, $subcategory){
        $subcategory = Subcategory::find($subcategory);
        $inputs = request()->validate([
            'subcategory' => 'required',
        ]);
        $subcategory->description = $request->description;
        $subcategory->subcategory = $inputs['subcategory'];
        $subcategory->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.subcategory.index');
        //return back();
    }

    public function destroy(Subcategory $subcategory, Request $request){ 
        $subcategory->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','subcategory is Deleted');//use when we use request
        return back();
    } 

    public function set_priority(Request $request){ 
        $subcategory = Subcategory::find($request->id);
        $subcategory->top_subcat = $request->top_subcat;        
        $subcategory->save();
        echo 1;
    } 
}
