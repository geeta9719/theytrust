<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use App\Models\CompanyReview;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Models\Size;
use App\Models\Subcategory;
use App\Mail\SendMail;
use App\Mail\ContactMail;
use App\Models\Budget;
use App\Models\Rate;
use App\Models\CompanyHasProject;
use App\Models\Attribution;
use App\Models\Industry;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Newsletters;
use App\Models\ReviewerEmailLog;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{

    public function company_list()
    {
        $data['companies'] = Company::orderBy( 'id', 'DESC' )->paginate( 50 );
        return view('admin.company.index' , $data );
    }

    public function publish_company( Request $request )
    {
        $company = Company::find( $request->id );
        $company->is_publish = $request->is_publish;        
        $company->save();
        echo 1;
    }



    public function flag_company( Request $request )
    {
        $company             = Company::find( $request->id );
        $company->is_flagged = $request->is_flag; 

        if( $company->save() )
        {
           die( json_encode('success') );
        }
        else
        {
            die( json_encode('error') );
        }
    }

    public function get_states_by_country( Request $request )
    {
        $states = DB::table('states')->where( 'country_code','=', $request->iso2 )->orderBy( 'name', 'ASC')->pluck( 'name', 'iso2' )->all();
        return response()->json( $states );
    }


    public function get_cities_by_state( Request $request )
    {
        $cities = City::where( "state_code", $request->state_code )->where( 'country_code',$request->country_code )->pluck('name');
        return response()->json( $cities );
    }



    public function publish_all_company(Request $request)
    {
        foreach( $request->id as $key => $id )
        {
            $data[$key]          = $id;
            $company             = Company::find( $id );
            $company->is_publish = $request->is_publish[$key];        
            $company->save();
        }

        return response()->json( $data );
    }

    public function company_review()
    {
        $data['reviews'] = CompanyReview::paginate( 10 );
        return view('admin.company.review',$data );
    }

	public function view_reviews( Request $request )
    {
		$data['reviews'] = CompanyReview::find( $request->viewreview );
		return view('admin.company.viewreviews', $data);
	}

    public function edit_review($viewreview)
   {

        $data['category'] = Category::All();


        $s = Size::all();

        foreach ( $s as $value )
        {
            $b = explode('-',$value->size);
            $size[$b[0]] = $value;
        }

        ksort($size);

        $data['size'] = $size;

        $bud = Budget::all();
        foreach ($bud as $value) {
            $b = explode('-',$value->budget);
            $budget[$b[0]] = $value;
        }
        ksort($budget);
       
        $data['budget'] = $budget;

        $data['attribution'] = Attribution::All();
        $data['countries']     = Country::All();

      $data['review'] = CompanyReview::find($viewreview);

    
    if (!$data['review']) {
        return abort(404); 
    }
    return view('admin.company.edit_review', ['data' => $data]);
}

public function update_review(Request $request, $id)
{
    // Validation rules for all fields
    $validatedData = $request->validate([
        'company_name' => 'required|string',
        'project_type' => 'required|string',
        'project_title' => 'required|string',
        'company_type' => 'required|string',
        'cost_range' => 'required|string',
        'project_start' => 'required|date',
        'project_end' => 'required|date',
        'company_position' => 'required|string'
    ]);

    // Find the review by its ID
    $review = CompanyReview::find($id);

    // Update the review with the validated data
    $review->update($validatedData);
    return redirect()->route('admin.company.review')->with('success', 'Review updated successfully');
}


    public function publish_review( Request $request )
    {
        $review             = CompanyReview::find($request->id);
        $review->published  = $request->published;        
        $review->save();
        echo 1;
    }

    public function publish_all_review( Request $request )
    {
        foreach( $request->id as $key => $id )
        {
            $data[$key]         = $id;
            $review             = CompanyReview::find( $id );
            $review->published  = $request->published[$key];        
            $review->save();
        }
        
        return response()->json($data);
    }

    public function review_edit( Request $request, $review )
    {
        $data['review'] = CompanyReview::find( $review );
        return view( 'admin.company.review_edit', $data );
    }

    public function review_update( Request $request )
    {
        $review                     = CompanyReview::find($request->id);
        $review->project_summary    = $request->project_summary;  
        $review->feedback_summary   = $request->feedback_summary;       
        $review->save();
        session()->flash('msg','Saved Successfully');
        return back();
    }

    public function users_list(Request $request)
    {
        $query = User::with('currentSubscription','currentSubscription.plan')->orderBy('id', 'DESC');
        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%"); 
                
        }
        $users = $query->paginate(20);
        if ($request->ajax()) {
            
            return view('admin.users.partial-table', compact('users'))->render();
        }

        return view('admin.users.index', compact('users'));
    }
 
    public function users_edit($id)
    {
        $user = User::find($id);
        return view( 'admin.users.edit', ['user'=>$user] );
    }

    public function users_update(Request $request, $user_id){
        $user = User::find($user_id);
        
            $inputs = request()->validate([
                'email' => 'required|email',
                'first_name' => 'required',
                'last_name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // image validation
]);
        
            $user->email = $inputs['email'];
            $user->first_name = $inputs['first_name'];
            $user->last_name = $inputs['last_name'];
            $user->company = $request['company'];
            $user->bio = $request['bio'];
            $user->mobile = $request['mobile'];
            
        
        if ($request->hasFile('image')) {
                      
            if ($user->image) {
                Storage::delete($user->image);
            }
    
       
            $path = $request->file('image')->store('users');
            $user->avatar = $path;
        }
    
        $user->save();
    
        session()->flash('msg','User data is updated');
        return redirect()->route('admin.users.list'); 
       
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.list')->with('msg', 'User successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->back()->with('ZSmessage', 'Failed to delete the user. Error: ' . $e->getMessage());
        }
    }

    public function CompnayProjectIndex($company){
        $company = Company::with('projects')->findOrFail($company);
        $projects = $company->projects;
    $categories = Category::pluck('category', 'id');
    return view('admin.company.project_index', compact('projects','categories'));
    }

    public function CompnayProjectStore(Request $request){
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
            $project = new CompanyHasProject();
            $project->title = $request->input('title');
            $project->thumbnail_image = $imagePath;
            $project->services_id = $request->input('services_id');
            $project->project_size = $request->input('project_size');
            $project->description = $request->input('description');
            $project->company_id = $company->id;
            $project->save();
            return redirect()->back()->with('success', 'Project created successfully.');
        }

            public function CompnayProjectEdit(Request $request){
            
            }

}




