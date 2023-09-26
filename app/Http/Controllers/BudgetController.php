<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Budget;

class BudgetController extends Controller
{
    //
    public function index(Request $request){
        $data['budget'] = Budget::all();
        return view('admin.budget.index' , $data);
    }
    public function create(){
        return view('admin.budget.create');
    }

    //public function store(Request $request){
    public function store(){
        $inputs = request()->validate([
            'budget' => 'required',
        ]);

        Budget::create($inputs);
        session()->flash('msg','Budget inserted');
        //return redirect()->route('admin.budget.index');
        return back();
    }

    public function edit(Request $request,$budget){
        $data['budget'] = Budget::find($budget);
        return view('admin.budget.edit',$data);
    }

    public function update(Request $request, $budget){
        $budget = Budget::find($budget);
        $inputs = request()->validate([
            'budget' => 'required',
        ]);

        $budget->budget = $inputs['budget'];
        $budget->save();//save post with owner of the user
        
        session()->flash('msg','data is updated');
        return redirect()->route('admin.budget.show');
        //return back();
    }

    public function destroy(Budget $budget, Request $request){ 
        $budget->delete();
        //Session::flash('message','Post was deleted');//use when we do not use request
        $request->session()->flash('message','Budget is Deleted');//use when we use request
        return back();
    }  
    
}
