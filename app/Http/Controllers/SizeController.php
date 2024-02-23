<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    //
    public function index(Request $request){
        $data['size'] = Size::all();
        return view('admin.size.index' , $data);
    }
    public function create(){
        return view('admin.size.create');
    }

    //public function store(Request $request){
    public function store(){
        $inputs = request()->validate([
            'size' => 'required',
        ]);

        Size::create($inputs);
        session()->flash('msg','Size inserted');
        //return redirect()->route('admin.size.index');
        return back();
    }

    public function edit(Request $request,$size){
        $data['size'] = Size::find($size);
        return view('admin.size.edit',$data);
    }

    public function update(Request $request, $size){
        $size = Size::find($size);
        $inputs = request()->validate([
            'size' => 'required',
        ]);

        $size->size = $inputs['size'];
        $size->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.size.show');
        //return back();
    }

    public function destroy(Size $size, Request $request){ 
        $size->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','Size is Deleted');//use when we use request
        return back();
    }  
    
}

public function store(){
    input:: $request->validate([
        'size'-> 'required',

    ])
}