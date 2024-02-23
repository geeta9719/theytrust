<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Rennokki\Plans\Models\PlanSubscriptionModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PlanSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::all();
      
        $planSubscriptions = PlanSubscriptionModel::with('model')->get();
        // dd($planSubscriptions);
        return view ('admin.Plansubscription.index',compact('users','planSubscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Resp
     * onse
     */
    public function create()
    {
        return view('admin.Plansubscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
         $data = $request->validate([
            
            'plan_id' => 'required|numeric|min:0', 
            'Expire On' => 'required|string|max:255',
            'Start Date' => 'required|string|max:255', 
        ]);

        PlanSubscriptionModel::create($data);

        return redirect()->route('plansubscription.index')->with('success', 'Plan Subscription created successfully.');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.plansubscription.show', compact('plansubscription'));
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planSubscriptions = PlanSubscriptionModel::all();
        return view('admin.plansubscription.edit', compact('plansubscription'));
    }

    public function update(Request $request, PlanSubscription $plansubscription)
    {
        $data = $request->validate([
            
            'plan_id' => 'required|numeric|min:0',
            'Expire On' => 'required|string|max:255',
            'Start Date' => 'required|string|max:255', 
        ]);

        $plansubscription->update($data);

        return redirect()->route('plansubscription.index')->with('success', 'Plan Subscription updated successfully.');
    }

    public function destroy(PlanSubscription $plansubscription)
    {
        $plansubscription->delete();

        return redirect()->route('plansubscription.index')->with('success', 'Plan Subscription deleted successfully.');
    }
}



    // public function inddex()
    // {
    //     $users = user::all();
    //     $plansubscription = PlansubscritionModel::With('model')->get();
    //     // dd($planSubscriptions);
    //     return view ('admin.Plansubscrition.index',compact('users','Plansubscriptions'));

    // }
