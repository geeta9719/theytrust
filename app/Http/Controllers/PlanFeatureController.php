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
        // $plans = PlanFeatureModel::all(); 
        $plans = PlanModel::all();
        return view('plan_features.create', compact('plans'));
    }


    public function store(Request $request)
    {
        PlanFeatureModel::create($request->all());

        return redirect()->route('planfeatures.index')->with('success', 'Plan feature created successfully.');
    }

   
    public function show($id)
    {
        $planFeature = PlanFeatureModel::findOrFail($id);
        return view('plan_features.show', compact('planFeature', 'id'));
    }
    

   
  
    
    public function edit($id) {
        $planFeature = PlanFeatureModel::findOrFail($id);
        $plans = PlanModel::all(); 
        return view('plan_features.edit', compact('planFeature', 'plans'));
      
    }
    

    
    public function update(Request $request, $id)
    {
            $planFeature = PlanFeatureModel::findOrFail($id); 
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'plan_id' => 'required|exists:plans,id',
                // 'code' => 'required',
                // 'limit' => 'required|integer',
                // 'type' => 'required',
                
            ]);

            $planFeature->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'plan_id' => $request->input('plan_id'),
                  // 'code' => $request->input('code'),
                // 'limit' => $request->input('limit'),
                // 'type' => $request->input('type'),
                
            ]);
            $planFeature->update($request->all());

            return redirect()->route('planfeatures.index')->with('success', 'Plan feature updated successfully.');
    }

   


    public function destroy($id)
    {
        $planFeature = PlanFeatureModel::findOrFail($id);
        $planFeature->delete();
        return redirect()->route('planfeatures.index')->with('success', 'Plan feature deleted successfully');
    }
}
