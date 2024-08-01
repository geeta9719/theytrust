<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Skill;
use App\Models\Company;
use App\Models\ModelReference;
use Illuminate\Http\Request;
use App\Models\SubcatChild;

class ModelReferenceController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $skills = Skill::all();
        $companies = Company::all();
        $modelReferences = ModelReference::with('company')->get();


        return view('admin.model_references.create', compact('categories', 'subcategories', 'skills', 'companies', 'modelReferences',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_id' => 'required|string',
            'company_id' => 'required|integer',
        ]);

        list($modelName, $foreignKeyId) = explode('-', $request->model_id);

        $foreignKeyName = '';
        if ($modelName === 'category') {
            $foreignKeyName = Category::find($foreignKeyId)->category;
        } elseif ($modelName === 'subcategory') {
            $foreignKeyName = Subcategory::find($foreignKeyId)->subcategory;
        } elseif ($modelName === 'skill') {
            $foreignKeyName = Skill::find($foreignKeyId)->name;
        }

        ModelReference::create([
            'model_name' => $modelName,
            'foreign_key_id' => $foreignKeyId,
            'foreign_key_name' => $foreignKeyName,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('model-references.create')->with('success', 'Model reference created successfully.');
    }

    public function getCompaniesByForeignKey(Request $request)
{
    $foreignKeyName = $request->input('foreign_key_name');
    $modelReferences = ModelReference::with(['company', 'company.companyReview'])
        ->where('foreign_key_name', $foreignKeyName)
        ->get();

    $companies = $modelReferences->map(function($reference) {
        $company = $reference->company;

        // Calculate the average rating
        $reviews = $company->companyReview;
        $averageRating = $reviews->avg('overall_rating');
                $reviewsCount = $reviews->count();

        
        return [
            'name' => $company->name,
            'image' => $company->image,
            'reviews' => $averageRating ?? 0,
            'reviewsCount' => $reviewsCount ?? 0

        ];
    });

    return response()->json($companies);
}

}