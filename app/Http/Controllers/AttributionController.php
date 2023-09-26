<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribution;


class AttributionController extends Controller
{
    //

    public function index(Request $request){
        $data['attribution'] = Attribution::all();
        return view('admin.attribution.index' , $data);
    }

    public function create(){
        return view('admin.attribution.create');
    }

    //public function store(Request $request){
    public function store(){
        $inputs = request()->validate([
            'name' => 'required',
        ]);

        Attribution::create($inputs);
        session()->flash('msg','Attribution inserted');
        return back();
    }

    public function edit(Request $request,$attribution){
        $data['attribution'] = Attribution::find($attribution);
        return view('admin.attribution.edit',$data);
    }

    public function update(Request $request, $attribution){
        $data['attribution'] = Attribution::find($attribution);
        $inputs = request()->validate([
            'name' => 'required',
        ]);

        $data['attribution']->name = $inputs['name'];
        $data['attribution']->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.attribution.show');
        //return back();
    }

    public function destroy(Attribution $attribution, Request $request){ 
        $attribution->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','Attribution is Deleted');//use when we use request
        return back();
    }  
    
}
