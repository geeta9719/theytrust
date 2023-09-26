<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubcatChild;
use App\Models\Subcategory;

class SubcatChildController extends Controller
{
    //
    public function index(Request $request){
        $data['subcategorychild'] = SubcatChild::paginate(10);
        return view('admin.subcatchild.index', $data);
    }
	
	public function create(){
		$data['subcategory'] = Subcategory::all();
        return view('admin.subcatchild.create', $data);
    }
	
	public function store(){
        $inputs = request()->validate([
            'subcategory_id' => 'required',
            'name' => 'required',
        ]);
		
        SubcatChild::create($inputs);
        session()->flash('msg','Subcategory child inserted');
        //return redirect()->route('admin.Category.index');
        return back();
    }
	
	public function edit(Request $request,$subcategorychild){
        $subcategorychild = SubcatChild::find($subcategorychild);
        $subcategory = Subcategory::all();
        return view('admin.subcatchild.edit',["subcategorychild"=>$subcategorychild,"subcategory"=>$subcategory]);
    }
	
	public function update(Request $request, $subcategorychild){
        $subcategory = SubcatChild::find($subcategorychild);
        $inputs = request()->validate([
            'subcategory_id' => 'required',
            'name' => 'required',
        ]);

        $subcategory->subcategory_id = $inputs['subcategory_id'];
        $subcategory->name = $inputs['name'];
        $subcategory->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.subcategory-child.show');
        //return back();
    }
	
	public function destroy(SubcatChild $Subcategorychild, Request $request){ 
        $Subcategorychild->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','subcategory child is Deleted');//use when we use request
        return back();
    }
	
}
