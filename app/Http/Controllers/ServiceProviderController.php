<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::paginate(10);
        return view('admin.service-provider.index', compact('serviceProviders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service-provider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

      $serviceProvider=  ServiceProvider::create([
            'name' => $request->name,
            'top_service' => $request->has('top_service') ? true : false,
        ]);
        return response()->json([
            'id' => $serviceProvider->id,  // Return the ID of the newly created record
            'name' => $serviceProvider->name,  // Return the name of the newly created record
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        return view('admin.service-provider.edit', compact('serviceProvider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $serviceProvider->update([
            'name' => $request->name,
            'top_service' => $request->has('top_service') ? true : false,
        ]);

        return redirect()->route('admin.service-provider.index')->with('msg', 'Service Provider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        $serviceProvider->delete();

        return redirect()->route('admin.service-provider.index')->with('msg', 'Service Provider deleted successfully.');
    }



    public function search(Request $request)
    {
        $term = $request->input('q');
        $serviceProviders = ServiceProvider::where('name', 'LIKE', '%' . $term . '%')->get();
    
        return response()->json($serviceProviders);
    }

    public function store1(Request $request)
{
    $serviceProvider = ServiceProvider::create([
        'name' => $request->input('name')
    ]);

    return response()->json($serviceProvider);
}
}


