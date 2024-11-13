<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\City;
use App\Models\State;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Skill;
use App\Models\Subskill;
use App\Models\Sponce;
use Rennokki\Plans\Models\PlanModel;

class SponceController extends Controller
{
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $skills = Skill::all();
        $plans = PlanModel::where('tag', 'sponcer')->get();


        return view('admin.sponce.create', compact('users', 'categories', 'skills', 'plans'));
    }

    public function getCompaniesByUser(Request $request)
    {
        $companies = Company::where('user_id', $request->user_id)->get();
        return response()->json($companies);
    }

    // Fetch locations based on selected company
    public function getLocationsByCompany(Request $request)
    {
        $locations = City::where('company_id', $request->company_id)->get();
        return response()->json($locations);
    }

    public function getCities()
    {
        $cities = City::select('id', 'name')->take(100)->get(); // Adjust limit as needed
        return response()->json($cities);
    }
    
    // Limit the number of states returned
    public function getStates()
    {
        $states = State::select('id', 'name')->take(100)->get(); // Adjust limit as needed
        return response()->json($states);
    }

public function getDataByType(Request $request)
{
    $type = $request->input('type');
    $data = [];

    if ($type == 'category') {
        $data = Category::all(['id', 'category as name']);  // Rename 'category' to 'name'
    } elseif ($type == 'subcategory') {
        $data = Subcategory::all(['id', 'subcategory as name']);  // Rename 'subcategory' to 'name'
    } elseif ($type == 'skill') {
        $data = Skill::all(['id', 'name']);  // Already has 'name' field
    } elseif ($type == 'subskill') {
        $data = Subskill::all(['id', 'name']);  // Already has 'name' field
    }

    return response()->json($data);
}

public function store(Request $request)
{
    // Validate the form data
    // $request->validate([
    //     'user_id' => 'required|integer|exists:users,id',
    //     'company_id' => 'required|integer|exists:companies,id',
    //     'location_type' => 'required|string|in:city,state',
    //     'location_id' => 'required|integer',
    //     'type' => 'required|string|in:category,subcategory,skill,subskill',
    //     'data_id' => 'required|integer',
    //     'plan_id' => 'required|integer|exists:plans,id',
    // ]);

    // dd($request->all());

    // Map the location and category types for polymorphic relationships
    $locationTypeModel = $request->input('location_type') === 'city' ? 'App\Models\City' : 'App\Models\State';
    $categoryTypeModel = $this->getCategoryTypeModel($request->input('type'));

    // Create a new Sponce record
    Sponce::create([
        'user_id' => $request->input('user_id'),
        'company_id' => $request->input('company_id'),
        'location_type_model' => $locationTypeModel,
        'location_id' => $request->input('location_id'),
        'category_type_model' => $categoryTypeModel,
        'category_id' => $request->input('data_id'),
        'plan_subscription_id' => $request->input('plan_id'),
    ]);

    return redirect()->route('sponce.index')->with('success', 'Sponce created successfully');
}

// Helper method to map category type to model class
protected function getCategoryTypeModel($type)
{
    switch ($type) {
        case 'category':
            return 'App\Models\Category';
        case 'subcategory':
            return 'App\Models\Subcategory';
        case 'skill':
            return 'App\Models\Skill';
        case 'subskill':
            return 'App\Models\Subskill';
        default:
            return null;
    }
}
public function index(Request $request)
{
    $query = Sponce::with(['user', 'company' ,'planSubscription']);

    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->whereHas('user', function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%");
        })->orWhereHas('company', function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%");
        });
    }

    $sponces = $query->paginate(10);

   

    return view('admin.sponce.index', compact('sponces'));
}


}
