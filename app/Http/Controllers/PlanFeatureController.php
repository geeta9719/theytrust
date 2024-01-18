<?php

namespace App\Http\Controllers;

use App\Models\PlanFeature;
use Rennokki\Plans\Models\PlanModel;
//use App\Models\PlanModel;
use Illuminate\Http\Request;

class PlanFeatureController extends Controller
{
    
    public function index()
    {
        $planFeatures = PlanFeature::all();
       // dd($planFeatures);
        return view('admin.plan_features.index', compact('planFeatures'));
    }
    public function create()
    {
        $plans = PlanModel::all();
        
        return view('admin.plan_features.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'limit' => 'required|integer',
            'type' => 'required',
            'plan_id' => 'required|exists:plans,id',
        ]);

        PlanFeature::create($request->all());

        return redirect()->route('planfeatures.index')
            ->with('success', 'Plan feature created successfully');
    }
    
    public function edit(PlanFeature $planfeature)
    {
        $plans = PlanModel::all(); // or fetch plans from your database

        return view('admin.plan_features.edit', compact('planfeature', 'plans'));
    }


    public function update(Request $request, PlanFeature $planfeature)
    {
            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'description' => 'required',
                'limit' => 'required|integer',
                'type' => 'required',
                'plan_id' => 'required|exists:plans,id',
            ]);

            $planfeature->update($request->all());

            return redirect()->route('planfeatures.index')
                ->with('success', 'Plan feature updated successfully');
        }


    public function destroy(PlanFeature $planFeature)
    {
        $planFeature->delete();

        return redirect()->route('planfeatures.index')
            ->with('success', 'Plan feature deleted successfully');
    }

}
