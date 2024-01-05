<?php

namespace App\Http\Controllers;

use App\Models\PlanFeature;
use Illuminate\Http\Request;

class PlanFeatureController extends Controller
{
    public function index()
    {
        $planFeatures = PlanFeature::all();
        return view('planfeatures.index', compact('planFeatures'));
    }

    public function create()
    {
        return view('planfeatures.create');
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
    public function edit(PlanFeature $planFeature)
    {
        return view('planfeatures.edit', compact('planFeature'));
    }

   

    public function update(Request $request, PlanFeature $planFeature)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'limit' => 'required|integer',
            'type' => 'required',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $planFeature->update($request->all());

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
