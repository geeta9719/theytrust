<?php

namespace App\Http\Controllers;

use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;
use Rennokki\Plans\Models\PlanFeatureModel;
class PlanFeatureController extends Controller
{
    public function index()
    {
        // $planFeatures = PlanFeature::all();
        $planFeatures = PlanFeatureModel::all();
        $plan = PlanModel::all();
        return view('plan_features.index', compact('planFeatures','plan'));
    }

    public function create()
    {
        $plans = PlanFeatureModel::all(); 
        return view('plan_features.create', compact('plans'));
    }


    public function store(Request $request)
    {
        PlanFeatureModel::create($request->all());

        return redirect()->route('planfeatures.index')->with('success', 'Plan feature created successfully.');
    }

    public function show(PlanFeature $planFeature)
    {
       
        return view('plan_features.show', compact('planFeatures'));
    }
   
  
    
    public function edit($id) {
        $planFeature = PlanFeature::findOrFail($id);
        return view('plan_features.edit', compact('planFeature'));
      
    }
    

    
    public function update(Request $request, $id)
    {
            $planFeature = PlanFeature::findOrFail($id); 

            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
                'limit' => 'required|integer',
                'type' => 'required',
                'plan_id' => 'required|exists:plans,id',
            ]);

            $planFeature->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
                'limit' => $request->input('limit'),
                'type' => $request->input('type'),
                'plan_id' => $request->input('plan_id'),
            ]);

            return redirect()->route('planfeatures.index')->with('success', 'Plan feature updated successfully.');
    }

    public function destroy($id)
    {
        $planFeature = PlanFeature::findOrFail($id);
        $planFeature->delete();

        return redirect()->route('planfeatures.index')->with('success', 'Plan feature deleted successfully');
    }
}
