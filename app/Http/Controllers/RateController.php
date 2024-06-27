<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;


class RateController extends Controller
{
    public function index(Request $request){
        $data['rate'] = Rate::all();
        return view('admin.rate.index' , $data);
    }
    public function create(){
        return view('admin.rate.create');
    }

    public function store(){
        $inputs = request()->validate([
            'rate' => 'required',
        ]);

        Rate::create($inputs);
        session()->flash('msg','Rate inserted');
        return back();
    }

    public function edit(Request $request,$rate){
        $data['rate'] = Rate::find($rate);
        return view('admin.rate.edit',$data);
    }

    public function update(Request $request, $rate){
        $rate = Rate::find($rate);
        $inputs = request()->validate([
            'rate' => 'required',
        ]);

        $rate->rate = $inputs['rate'];
        $rate->save();
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.rate.show');
    }

    public function destroy(Rate $rate, Request $request){ 
        $rate->delete();
        $request->session()->flash('message','Rate is Deleted');
        return back();
    }  
}