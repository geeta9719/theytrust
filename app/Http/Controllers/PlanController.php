<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Rennokki\Plans\Models\PlanModel;

class PlanController extends Controller
{
    public function index()
    {
        $plans = PlanModel::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);
    
        // Extract metadata from the request and format it as an associative array
        $metadataKeys = $request->input('metadata.key');
        $metadataValues = $request->input('metadata.value');
        $metadata = array_combine($metadataKeys, $metadataValues);
    
        // Add metadata to the request data
        $requestData = $request->except(['metadata']);
        $requestData['metadata'] = $metadata;
    
        // Create the plan
        PlanModel::create($requestData);
    
        return redirect()->route('plans.index')->with('success', 'Plan created successfully');
    }
    

    public function edit(PlanModel $plan)
    {

        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, PlanModel $plan)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
    }

    public function destroy(PlanModel $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully');
    }
}

