<?php

namespace App\Http\Controllers;

use App\Models\CompanyHasProject;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Category;
use Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Projects = CompanyHasProject::latest()->paginate(5);
        return view('Project.index',compact('Projects'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
         $company = Company::with('projects')->findOrFail($company->id);
         $projects = $company->projects;
            $categories = Category::pluck('category', 'id');
            return view('Project.create', compact('projects','categories'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'thumbnail_image' => 'required',
                'services_id' => 'required',
                'project_size' => 'required',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('thumbnail_image')) {
                $imagePath = $request->file('thumbnail_image')->store('/thumbnails');
            } else {
                $imagePath = null;
            }

            if ($request->hasFile('uploaded_image')) {
                $imagePath2= $request->file('uploaded_image')->store('/uploaded_image');
            } else {
                $imagePath2 = null;
            }
            $project = new CompanyHasProject();
            $project->title = $request->input('title');
            $project->thumbnail_image = $imagePath;
            $project->uploaded_image = $imagePath2;
            $project->services_id = $request->input('services_id');
            $project->project_size = $request->input('project_size');
            $project->description = $request->input('description');
            $project->youtube_video = $request->input('youtube_video');
            $project->company_id = $company->id;
            $project->save();
            // return redirect()->back()->with('success', 'Project created successfully.');
   
        return redirect()->route('Projects.index')->with('success','Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyHasProject $Project)
    {
        $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
         $company = Company::with('projects')->findOrFail($company->id);
         $projects = $company->projects;
            $categories = Category::pluck('category', 'id');
        return view('Project.show',compact('Project','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyHasProject $Project)
    {
        $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
         $company = Company::with('projects')->findOrFail($company->id);
         $projects = $company->projects;
            $categories = Category::pluck('category', 'id');
        return view('Project.edit',compact('Project','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyHasProject $Project)
    {

        $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
    
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'services_id' => 'required',
        'project_size' => 'required',
        'description' => 'required',
        // 'youtube_video'=>'required'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }


    if (!$Project) {
        return redirect()->back()->with('error', 'Project not found.');
    }

    $Project->title = $request->input('title');
    $Project->services_id = $request->input('services_id');
    $Project->project_size = $request->input('project_size');
    $Project->description = $request->input('description');
    $Project->youtube_video = $request->input('youtube_video');

    if ($request->hasFile('thumbnail_image')) {
        $imagePath = $request->file('thumbnail_image')->store('/thumbnails');
        $project->thumbnail_image = $imagePath;
    }

    if ($request->hasFile('uploaded_image')) {
        $imagePath2 = $request->file('uploaded_image')->store('/uploaded_image');
        $Project->uploaded_image = $imagePath2;
    }

        $Project->save();
  
        return redirect()->route('Projects.index')->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyHasProject $Project)
    {
        $Project->delete();
  
        return redirect()->route('Projects.index')->with('success','Project deleted successfully');
    }

    
}
