<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\SubcatChild;

class SkillCategoryController extends Controller
{
    public function index(Request $request)
    {
        $skills = Skill::paginate(10);
        return view('admin.skillcat.index', compact('skills'));
    }
    
    public function create()
    {
        $subcategories = SubcatChild::all();
        return view('admin.skillcat.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subcat_child_id' => 'required|exists:subcat_children,id',
            'name' => 'required|string|max:255',
        ]);
        
        Skill::create($validatedData);
        session()->flash('msg', 'Skill inserted');
        return back();
    }     
  
    public function show($id)
    {
        $skillCategory = SubcatChild::findOrFail($id);
        return view('admin.skillcat.show', compact('skillCategory'));
    }
    
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $subcategories = SubcatChild::all();
        return view('admin.skillcat.edit', compact('skill', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subcat_child_id' => 'required|exists:subcat_children,id',
            'name' => 'required|string|max:255',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($validatedData);

        return redirect()->route('admin.skills.index');
    }
  
    public function destroy(Skill $skill, Request $request)
    { 
        $skill->delete();
        $request->session()->flash('message', 'Skill is Deleted');
        return back();
    }
}



























// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Skill;

// use App\Models\SubcatChild;

// class SkillCategoryController extends Controller
// {
//     public function index(Request $request)
//     {
//         $data['skills'] = Skill::paginate(10);
//         return view('admin.skillcat.index', $data);
//     }
    
//     public function create()
//     {
//         $data['subcategories'] = SubcatChild::all();
//         return view('admin.skillcat.create', $data);
//     }

//     public function store()
//     {
//         $inputs = request()->validate([
//             'subcat_child_id' => 'required',
//             'name' => 'required',
//         ]);
        
//         Skill::create($inputs);
//         session()->flash('msg', 'Skill inserted');
//         return back();
//     }     
  
//     public function show($id)
//     {
    
//         $skillCategory = SubcatChild::findOrFail($id);

//         return view('admin.skillcat.show', ['skillCategory' => $skillCategory]);
//     }
    
//     public function edit($id)
//     {
//         $skill = Skill::findOrFail($id);
//         $subcategories = SubcatChild::all();
//         return view('admin.skillcat.edit', compact('skill', 'subcategories'));
//     }


//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'subcat_child_id' => 'required|exists:subcategories,id',
//             'skill' => 'required|string|max:255', 
//             'name' =>'required',
//         ]);

    
//         $skill = Skill::findOrFail($id);
//         $skill->subcat_child_id = $request->subcat_child_id;
//         $skill->name = $request->skill;
//         $skill->save();


//         return redirect()->route('admin.skills.index');
//     }
  
//     public function destroy(Skill $skill, Request $request)
//     { 
//         $skill->delete();
//         $request->session()->flash('message', 'Skill is Deleted');
//         return back();
//     }
// }
