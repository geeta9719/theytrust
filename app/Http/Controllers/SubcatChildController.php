<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubcatChild;
use App\Models\Subcategory;

class SubcatChildController extends Controller
{
    public function index(Request $request)
    {
        $data['subcategorychild'] = SubcatChild::paginate(10);
        return view('admin.subcatchild.index', $data);
    }

    public function create()
    {
        $data['subcategory'] = Subcategory::all();
        return view('admin.subcatchild.create', $data);
    }

    public function store()
    {
        $inputs = request()->validate([
            'subcategory_id' => 'required',
            'name' => 'required',
        ]);

        SubcatChild::create($inputs);
        session()->flash('msg', 'Subcategory child inserted');
        return back();
    }

    public function edit(Request $request, $subcategorychild)
    {
        $subcategorychild = SubcatChild::find($subcategorychild);
        $subcategory = Subcategory::all();
        return view('admin.subcatchild.edit', ["subcategorychild" => $subcategorychild,"subcategory" => $subcategory]);
    }

    public function update(Request $request, $subcategorychild)
    {
        $subcategory = SubcatChild::findOrFail($subcategorychild);
    
        // ✅ Optional: Validation
        $validated = $request->validate([
            'subcategory_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'title_type' => 'nullable|string|max:255',
            'page_heading' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string', // text field
        ]);
    
        // ✅ Actual Update
        $subcategory->update($validated);
    
        // ✅ Flash + Redirect
        session()->flash('msg', 'Data is updated successfully.');
        return redirect()->route('admin.subcategory-child.show');
    }
    

    public function destroy(SubcatChild $Subcategorychild, Request $request)
    {
        $Subcategorychild->delete();
        $request->session()->flash('message', 'subcategory child is Deleted'); //use when we use request
        return back();
    }

}
