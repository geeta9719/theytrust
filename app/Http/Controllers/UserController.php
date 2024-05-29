<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Budget;
use App\Models\Rate;
use App\Models\Size;
use App\Models\Company;
use App\Models\Address;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ServiceLine;
use App\Models\SubcatChild;
use App\Models\AddFocus;
use App\Models\Industry;
use App\Models\AddIndustry;
use App\Models\ClientSize;
use App\Models\AddClientSize;
use App\Models\Specialization;
use App\Models\AddSpecialization;
use App\Models\AdminInfo;
use App\Models\Skill;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function dashboard(Request $request, $company)
    {   
        $user     = auth()->user();
        $uid      = auth()->user()->id;
		$urole    = auth()->user()->role;
        $cid      = Company::where('user_id',$uid)->first();
        $data['currentSubscription'] =  $user->currentSubscription;
        // dd($data);
        
		
        if( ( isset( $cid->id ) && $cid->id == $company ) || $urole == 1 )
        {
            $data['company'] = DB::select("SELECT companies.*,COUNT(company_reviews.id) AS review, avg(overall_rating) as rating, position_title, most_impressive, COUNT(service_lines.id) AS service_lines,addresses.autocomplete,addresses.city,addresses.country_iso2,addresses.address FROM companies LEFT JOIN company_reviews ON company_reviews.company_id = companies.id LEFT JOIN service_lines ON service_lines.company_id = companies.id LEFT JOIN addresses ON addresses.company_id = companies.id WHERE companies.id =".$company." ");

            $data['company'] = $data['company'][0];
            
            return view('home.user.dashboard',$data);
        }
        else
        {
            abort( 403 ); 
        }
    }

    public function personal()
    {
        return view('home.user.personal');
    }

    public function choice()
    {
        $cd = '';

        if( Auth::check() )
        {
            $uid = auth()->user()->id;
            $cd = Company::select('*')->where('user_id', '=', $uid)->first();
        }
        
        if( $cd )
        {
            return redirect()->route('company.dashboard',$cd->id);
        }

        return view('home.user.choice');
    }

    public function savePersonal( Request $request, $user )
    {
        $user = User::find( $user );

        if( $request->hasFile('avatar') )
        {
            $request->validate( [ 'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg' ] );
            $path         = $request->file('avatar')->store('images/profile_pic');
            $user->avatar = $path;
        }

        $user->name       = $request->first_name." ".$request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->company    = $request->company;
        $user->email      = $request->email;
        $user->twitter    = $request->twitter;
        $user->linkedin   = $request->linkedin;
        $user->bio        = $request->bio;
        
        $user->save();
        
        session()->flash( 'msg', 'Saved Successfully' );

        return back();
    }

    public function allInfo( Request $request )
    {
        $uid     = auth()->user()->id;
        $company = Company::where('user_id', $uid )->first();

        return view( 'home.user.allinfo', [ 
                                            'uid'        => $uid,
                                            'company_id' => isset( $company->id ) ? $company->id : null 
                                          ]);
    }

    public function basicInfo( Request $request, $user )
    {
        $uid    = auth()->user()->id;
        $urole  = auth()->user()->role;
        
        $cid    = Company::where('user_id',$uid)->first();
       
        if( $uid == $user || $urole == 1 )
        {
            $company = Company::where( 'user_id', $request->user )->first();
            $address = '';
            
            if( $company )
            {
                $address = Address::where( 'company_id', $company->id )->where( 'user_id', $request->user )->first();
            }
            
            $country    = Country::all();
            $state      = State::all();
            $city       = City::all();
            
            $bud        = Budget::all();

            foreach( $bud as $value ) 
            {
                $b = explode( '-', $value->budget );
                $budget[$b[0]] = $value; 
            }

            ksort( $budget );
        
            $s = Size::all();

            foreach ($s as $value) 
            {
                $b = explode( '-', $value->size );
                $size[$b[0]] = $value; 
            }

            ksort( $size );
        
            $r = Rate::all();
            
            foreach( $r as $value ) 
            {
                $b = explode('-',$value->rate);
                $rate[$b[0]] = $value; 
            }

            ksort($rate);
            
            
            return view( 'home.user.basicInfo', [ 
                                                    'budget'    => $budget,
                                                    'size'      => $size,
                                                    'rate'      => $rate,
                                                    'country'   => $country,
                                                    'company'   => $company,
                                                    'address'   => $address,
                                                    'city'      => $city,
                                                    'state'     => $state 
                                                ]);
        }
        else
        {
            abort( 403 ); 
        }
    }

    public function saveBasicInfo( Request $request )
    {
        $company = Company::where('user_id', $request->user_id)->first();
        
        if( $company )
        {
            $company->profile_type      = $request->profile_type;
            $company->name              = $request->name;
            $company->website           = $request->website;
            $company->size              = $request->size;
            $company->budget            = $request->budget;
            $company->rate              = $request->rate;
            $company->founded_at        = $request->founded_at;
            $company->tagline           = $request->tagline;
            $company->short_description = $request->short_description;

            if( $request->hasFile( 'logo' ) )
            {
                $path = $request->file('logo')->store('images/logo');
                $company->logo = $path;
            }

            $company->save();
        }
        else{

            $inputs['profile_type']     = $request->profile_type;
            $inputs['name']             = $request->name;
            $inputs['website']          = $request->website;
            $inputs['size']             = $request->size;
            $inputs['budget']           = $request->budget;
            $inputs['rate']             = $request->rate;
            $inputs['founded_at']       = $request->founded_at;
            $inputs['tagline']          = $request->tagline;
            $inputs['short_description']= $request->short_description;
            $inputs['user_id']          = $request->user_id;

            if( $request->hasFile('logo') )
            {
                $path           = $request->file('logo')->store('images/logo');
                $inputs['logo'] = $path;
            }

            Company::create($inputs);
        }
        
        $company = Company::where('user_id', $request->user_id)->first();
        return redirect()->route( 'company.location', $company->id );
    }

    public function location( Request $request, $company )
    {
        $data['company'] = Company::where('id', $company)->first();
        $data['address'] = Address::where('company_id', $company)->get();
        $data['country'] = Country::pluck('name','iso2')->all();
        $data['state']   = State::all();
        
        return view('home.user.location',$data);
    }

    public function saveLocation( Request $request )
    {
        $company            = Company::find($request->company_id);
        $company->email     = $request->email['0'];
        $company->mobile    = $request->mobile['0'];
        $company->save();

        foreach( $request->id as $k => $val )
        {
            if( $val == '0' )
            {
                $inputs['company_id']   = $request->company_id;
                $inputs['user_id']      = $request->user_id;
                $inputs['address']      = $request->address[$k];
                $inputs['city']         = $request->city[$k];
                $inputs['state_iso2']   = $request->state_iso2[$k];
                $inputs['country_iso2'] = $request->country_iso2[$k];
                $inputs['zip']          = $request->zip[$k];
                $inputs['type']         = $request->type[$k];
                $inputs['mobile']       = $request->mobile[$k];
                $inputs['email']        = $request->email[$k];
                $inputs['autocomplete'] = $request->autocomplete_1[$k];
                
                Address::create( $inputs );
                
            }
            else
            {
                $address = Address::find( $val );
                
                if( $address )
                {
                    $address->address       = $request->address[$k];
                    $address->city          = $request->city[$k];
                    $address->state_iso2    = $request->state_iso2[$k];
       
                    $address->country_iso2  = $request->country_iso2[$k];
                    $address->zip           = $request->zip[$k];
                    $address->type          = $request->type[$k];
                    $address->email         = $request->email[$k];
                    $address->mobile        = $request->mobile[$k];
                    $address->autocomplete  = $request->autocomplete_1[$k];
                    
                    $address->save();
                }
            }    
        }

        return redirect()->route('company.focus',$company->id);
    }

    // public function focus( Request $request, $company )
    // {


    //     $comp           = Company::where('id', $company)->first();
    //     $category       = Category::all();
    //     $serviceLine    = ServiceLine::where('company_id', $company)->get();

    //     foreach( $serviceLine as $value ) 
    //     {
    //         if( $value->percent > 10 )
    //         {
    //             $subcat[] = $value->subcategory_id;
    //         }
    //     } 
        
    //     $subcat_children = SubcatChild::all();
    //     $subcat_child    = array();
        
    //     foreach ( $subcat_children as $value ) 
    //     {
    //         $subcat_child[$value->subcategory_id][] = $value;
    //     } 
        

    //     $addFocus = AddFocus::where( 'company_id', $company )->get();
    //     $add_focus = array();
        
    //     foreach ($addFocus as $value) 
    //     {
    //         $add_focus[$value->subcategory_id][] = $value;
    //     }  
       
        
    //     $industry           = Industry::all();
    //     $addIndustry        = AddIndustry::where( 'company_id', $company )->get();
        
    //     $clientSize         = ClientSize::all();
    //     $addClientSize      = AddClientSize::where( 'company_id', $company )->get();
    //     $specialization     = Specialization::all();
    //     $addSpecialization  = AddSpecialization::where( 'company_id', $company )->get();
        
    //     return view( 'home.test', [
    //                                         'categories'          => $category,
    //                                         'company'           => $comp,
    //                                         'addFocus'          => $addFocus,
    //                                         'industry'          => $industry,
    //                                         'addIndustry'       => $addIndustry,
    //                                         'clientSize'        => $clientSize,
    //                                         'addClientSize'     => $addClientSize,
    //                                         'specialization'    => $specialization,
    //                                         'addSpecialization' => $addSpecialization,
    //                                         'serviceLine'       => $serviceLine,
    //                                         'add_focus'         => $add_focus,
    //                                         'subcat_child'      => $subcat_child
    //                                     ] );
    // }


    public function focus( Request $request, $company )
    {


        $comp           = Company::where('id', $company)->first();
        $category       = Category::all();

        return view( 'home.focus', [
                                            'categories'          => $category,
                                            'company' =>$company
                                        ] );
    }


    public function test( Request $request, $company )
    {


        $comp           = Company::where('id', $company)->first();
        $category       = Category::all();
       
        $serviceLine    = ServiceLine::where('company_id', $company)->get();
        

        foreach( $serviceLine as $value ) 
        {
            if( $value->percent > 10 )
            {
                $subcat[] = $value->subcategory_id;
            }
        } 
        
        $subcat_children = SubcatChild::all();
        $subcat_child    = array();
        // dd( $subcat_children);
        
        foreach ( $subcat_children as $value ) 
        {
            $subcat_child[$value->subcategory_id][] = $value;
        } 
        

        $addFocus = AddFocus::where( 'company_id', $company )->get();
        $add_focus = array();
        
        foreach ($addFocus as $value) 
        {
            $add_focus[$value->subcategory_id][] = $value;
        }  
       
        
        $industry           = Industry::all();
        $addIndustry        = AddIndustry::where( 'company_id', $company )->get();
        
        $clientSize         = ClientSize::all();
        $addClientSize      = AddClientSize::where( 'company_id', $company )->get();
        
        $specialization     = Specialization::all();
        $addSpecialization  = AddSpecialization::where( 'company_id', $company )->get();

        
        return view( 'home.test', [
                                            'categories'          => $category,
                                         
                                        ] );
    
    }


    public function skill( Request $request )
    {
        $selectedCategories = $request->input('id');
      $subcategories =  SubcatChild::with('subcategory')
            ->where('subcategory_id', $selectedCategories)
            ->get();
        return response()->json($subcategories);
    }

    public function subskill( Request $request )
    {
        $selectedCategories = $request->input('id');
      $subcategories =  Skill::where('subcat_child_id', $selectedCategories)
            ->get();
        return response()->json($subcategories);
    }



    public function subcategories( Request $request )
    {

        $selectedCategories = $request->input('categories');
        $subcategories = Subcategory::select('subcategories.*', 'categories.category as category_name','categories.id as category_id')
                                    ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                                    ->where('category_id', $selectedCategories)
                                    ->get();
    
        // Return subcategories and their corresponding category names as JSON response
        return response()->json($subcategories);
    }




    public function saveFocus(Request $request)
    {
        
        if( !empty( $request->service ) )
        {
            $inputs = array();

            foreach( $request->service as $key => $val )
            {
                foreach( $val as $k => $v )
                {
                    $id     = $v[0];
                    $find   = ServiceLine::find($id);
                    
                    if( $find )
                    {
                        if( isset( $v[2] ) && $v[2] != 0 )
                        {
                            if( isset( $v[1] ) && $v[2] != 0 )
                            {
                                $find->percent = $v[2];
                                $find->save();
                            }
                            else
                            {
                                $find->delete();
                            }
                        }
                        else
                        {
                            $find->delete();
                        }    
                    }
                    else
                    {
                        if( !empty( $v[1] ) && $v[1] != 0 )
                        {
                            $inputs['company_id']       = $request->company_id;
                            $inputs['category_id']      = $key;
                            $inputs['subcategory_id']   = $k;
                            $inputs['percent']          = $v[1];
                            ServiceLine::create($inputs);
                        }
                    }
                }       
            }
        }    

        if( !empty( $request->focus ) )
        {
            $inputs = array();
            
            foreach( $request->focus as $key => $val )
            {
                foreach( $val as $k => $v )
                {
                    $id     = $v[0];
                    $find   = AddFocus::find( $id );
                    if( $find )
                    {
                        if( isset( $v[2] ) && $v[2] != 0 )
                        {
                            if( isset( $v[1] ) && !empty( $v[1] ) )
                            {
                                $find->percent = $v[2];
                                $find->save();
                            }
                            else
                            {
                                $find->delete();
                            }
                        }
                        else
                        {
                            $find->delete();
                        }
                    }
                    else
                    {
                        if( !empty( $v[1] ) && $v[1] != 0 )
                        {
                            $inputs['company_id']       = $request->company_id;
                            $inputs['subcategory_id']   = $key;
                            $inputs['subcat_child_id']  = $k;
                            $inputs['percent']          = $v[1];
                            AddFocus::create($inputs);
                        }    
                    }    
                }     
            }
        }

        if( !empty( $request->industry ) )
        {
            $inputs = array();
            
            foreach( $request->industry as $key => $val )
            {
                $id     = $val[0];
                $find   = AddIndustry::find( $id );
                
                if( $find )
                {
                    if( isset( $val[2] ) && $val[2] != 0 )
                    {
                        if( isset( $val[1] ) && $val[1] != 0 )
                        {
                            $find->percent = $val[2];
                            $find->save();
                        }
                        else
                        {
                            $find->delete();
                        }
                    }
                    else
                    {
                        $find->delete();
                    }    
                }
                else
                {
                    if( isset( $val[1] ) && $val[1] != 0 )
                    {
                        $inputs['company_id']   = $request->company_id;
                        $inputs['industry_id']  = $key;
                        $inputs['percent']      = $val[1];
                        
                        AddIndustry::create( $inputs );
                    }    
                }
            }    
        }

        if( !empty( $request->clientSize ) )
        { 
            $inputs = array();   
            foreach( $request->clientSize as $key => $val )
            {
                
                $id     = $val[0];
                $find   = AddClientSize::find( $id );

                if( $find )
                {
                    if( isset( $val[2] ) && $val[2] != 0 )
                    {
                        if( isset( $val[1] ) && $val[1] != 0 )
                        {
                            $find->percent = $val[2];
                            $find->save();
                        }
                        else
                        {
                            $find->delete();
                        }
                    }
                    else
                    {
                        $find->delete();
                    }    
                }
                else
                {
                    if( isset( $val[1] ) && $val[1] != 0 )
                    {
                        $inputs['company_id']       = $request->company_id;
                        $inputs['client_size_id']   = $key;
                        $inputs['percent']          = $val[1];
                        
                        AddClientSize::create($inputs);
                    }    
                }    
            }
        }

        if( !empty( $request->specialization ) )
        {   
            $inputs = array();

            foreach( $request->specialization as $key => $val )
            {
                $id     = $val[0];
                $find   = AddSpecialization::find( $id );
                
                if( $find )
                {
                    if( isset( $val[2] ) && $val[2] != 0 )
                    {
                        if( isset( $val[1] ) && $v[1] != 0 )
                        {
                            $find->percent = $val[2];
                            $find->save();
                        }
                        else
                        {
                            $find->delete();
                        }
                    }
                    else
                    {
                        $find->delete();
                    }    
                }
                else
                {
                    if( isset( $val[1] ) && $val[1] != 0 )
                    {
                        $inputs['company_id']        = $request->company_id;
                        $inputs['specialization_id'] = $key;
                        $inputs['percent']           = $val[1];
                        
                        AddSpecialization::create($inputs);
                    }    
                }
            }
        }

        return redirect()->route( 'company.marketing', $request->company_id );
    }

    public function adminInfo( Request $request, $company )
    {
        $comp       = Company::where( 'id', $company )->first();
        $adminInfo  = AdminInfo::where( 'company_id', $company )->first();
        
        return view('home.user.marketing' , ['company' => $comp,'adminInfo' => $adminInfo]);
    }

    public function saveAdminInfo(Request $request)
    {
          
        $id     = $request->id;
        $find   = AdminInfo::where( 'id', $id )->where( 'company_id', $request->company_id )->first();
        
        if( $find )
        {
            $find->company_id   = $request->company_id;
            $find->email        = $request->email;
            $find->mobile       = $request->mobile;
            $find->linkedin     = $request->linkedin;
            $find->facebook     = $request->facebook;
            $find->twitter      = $request->twitter;
            $find->analytics    = $request->analytics;

            $find->save();
        }
        else
        {
            $inputs['company_id']   = $request->company_id;
            $inputs['email']        = $request->email;
            $inputs['mobile']       = $request->mobile;
            $inputs['linkedin']     = $request->linkedin;
            $inputs['facebook']     = $request->facebook;
            $inputs['twitter']      = $request->twitter;
            $inputs['analytics']    = $request->analytics;

            AdminInfo::create($inputs);
        }   
        
        session()->flash( 'msg', 'Saved Successfully' );   
        return redirect()->route( 'plans', $request->company_id );
    }



    public function validationStep( Request $request )
    {


        $data       = array();
        $validExt   =
         array( 'jpg','jpeg','png','gif','jfif' );
        //  dd($request->all());
        
        if( $request->form == 'personal' )
        {                
            if( $_FILES['avatar']['name'] != '' )
            {    
                $file = $_FILES['avatar']['tmp_name'];

                if ( file_exists( $file ) )
                {
                    $ext = pathinfo( $_FILES['avatar']['name'], PATHINFO_EXTENSION );

                    if( !in_array( $ext, $validExt ) )
                    {
                        $data['avatar'] = 'Change error This is not image file to Please upload either a jpg or png file';
                    }
                }
                else
                {
                    $data['avatar'] = 'Not a Valid File Type';
                }
            }
            else
            {
                if( $request->oldAvatar == '' )
                {
                    $data['avatar'] = 'Please select an image';
                }
            }    

            if( $request->first_name == '' )
            {
                $data['first_name'] = 'First Name should not be empty';
            }
            elseif( strlen( $request->first_name ) < 2 )
            {
                $data['first_name'] = 'Minimum length should be two charecters';
            }
            elseif( is_numeric( $request->first_name[0] ) )
            {
                $data['first_name'] = ' First Name should not be start with numeric.';
            }
            
            if(!empty($request->last_name))
            {
                if( strlen($request->last_name) < 1 )
                {
                    $data['last_name'] = 'Minimum length should be two charecters';
                }
                elseif( is_numeric( $request->last_name[0] ))
                {
                    $data['last_name'] = 'Last Name should not be start with numeric.';
                }
            }
            if( !empty( $request->company ) )
            {
                if(strlen($request->company) < 1)
                {
                    $data['company'] = 'Minimum length should be two charecters';
                }
                elseif( is_numeric( $request->company[0] ) )
                {
                    $data['company'] = 'Company Name should not be start with numeric.';
                }
            }    

            if( $request->email == '' )
            {
                $data['email'] = 'Email should not be empty';
            }
            elseif( filter_var( $request->email, FILTER_VALIDATE_EMAIL ) === false ) 
            {
                $data['email'] = 'Email not valid';
            }

            if( !empty( $request->twitter ) )
            {
                if( filter_var( $request->twitter, FILTER_VALIDATE_URL ) === false ) 
                {
                    $data['twitter'] = 'url is not a valid URL';
                }
            }
            
            if( !empty( $request->linkedin ) )
            {
                if( filter_var( $request->linkedin, FILTER_VALIDATE_URL ) === false ) 
                {
                    $data['linkedin'] = 'url is not a valid URL';
                }
            }  
        }

        if( $request->form == 'form1' )
        {
            if( $_FILES['logo']['name'] != '' )
            {    
                $file = $_FILES['logo']['tmp_name'];
                
                if ( file_exists( $file ) )
                {
                    $ext = pathinfo( $_FILES['logo']['name'], PATHINFO_EXTENSION );
                    
                    if( !in_array( $ext, $validExt ) )
                    {
                        $data['logo'] = 'Change error This is not image file to Please upload either a jpg or png file';;
                    }
                }
                else
                {
                    $data['logo'] = 'Change error This is not image file to Please upload either a jpg or png file

                    ';
                }
            }
            else
            {
                if( $request->oldLogo == '' )
                {
                    $data['logo'] = 'Please select a file';
                }
            }   

            if( $request->name == '' )
            {
                $data['name'] = 'Company Name should not be empty';
            }
            elseif( strlen( $request->name ) < 2 )
            {
                $data['name'] = 'Minimum length should be two charecters';
            }
            elseif( is_numeric( $request->name[0] ) )
            {
                $data['name'] = 'CompanyName should not be start with numeric.';
            }

            if( $request->website == '' )
            {
                $data['website'] = 'website should not be empty';
            }
            elseif( filter_var( $request->website, FILTER_VALIDATE_URL ) === false ) 
            {
                $data['website'] = 'Url must start with https:// or http://';
            }

            if($request->size == '')
            {
                $data['size'] = 'Company Size should not be empty';
            }

            if ($request->tagline == '') {
                $data['tagline'] = 'Company Title should not be empty';
            } elseif (strlen($request->tagline) > 70) {
                $data['tagline'] = 'Company Title should not exceed 70 characters';
            }
            
            if ($request->short_description == '') {
                $data['short_description'] = 'Company summary should not be empty';
            } elseif (strlen($request->short_description) > 5000) {
                $data['short_description'] = 'Company summary should not exceed 5000 characters';
            }
            
        }

        if( $request->form == 'form2' )
        {   
            
            foreach( $request->address as $k => $v )
            {
                $addref  = $request->addref[$k];

                if($request->email[$k] == '')
                {
                    $data['email'.$addref] = 'Email should not be empty';
                }

                elseif( filter_var( $request->email[$k], FILTER_VALIDATE_EMAIL ) === false ) 
                {
                    $data['email'.$addref] = 'Email not valid';
                }
                if( $request->mobile[$k] == '' )
                {
                    $data['mobile'.$addref] = 'Mobile should not be empty';
                }
                elseif( strlen( $request->mobile[$k] ) < 10 ) 
                {
                    $data['mobile'.$addref] = 'Mobile no. not valid';
                } 

                if( $request->country_iso2[$k] == '' )
                {
                    $data['country'.$addref] = 'Country should not be empty';
                }

                if( $request->state_iso2[$k] == '' )
                {
                    $data['state'.$addref] = 'State should not be empty';
                } 
                if( $request->city[$k] == '' )
                {
                    $data['city'.$addref] = 'City should not be empty';
                }
                if( $request->address[$k] == '' )
                {
                    $data['address'.$addref] = 'Address should not be empty';
                } 
                
                if( !empty( $request->zip[$k] ) )
                {
                    if( strlen( $request->zip[$k] ) < 5 ) 
                    {
                        $data['zip'.$addref] = 'Zip not valid';
                    } 
                } 
            }

        }

        if( $request->form == 'form4' )
        {
            if( $request->email == '' )
            {
                $data['email'] = 'Email should not be empty';
            }
            elseif( filter_var( $request->email, FILTER_VALIDATE_EMAIL ) === false ) 
            {
                $data['email'] = 'Email not valid';
            }
        }

        return response()->json($data); 
    }


    public function getSubcatChild( Request $request )
    {
    
        #$data = $add_focus = SubcatChild::where( "subcategory_id", $request->subcategory_id )->get( [ "id", "subcategory_id", "name" ] );
        
        $add_focus = SubcatChild::where( "subcategory_id", $request->subcategory_id )->get( [ "id", "subcategory_id", "name" ] );

        #echo '<pre>'; die( print_r( $add_focus ) ); 
        
        $html = "";
        
        if( !empty( $add_focus ) && count( $add_focus ) > 0 )
        {
            $i = 0;
            foreach( $add_focus as $f )
            {
                $i++;
                $html .= '<div class="appendFocus_'.$f->subcategory_id.' appendFocus_all">
                            <h4 class="focusA_'.$f->subcategory_id.'">
                                <strong class="headF_'.$f->subcategory_id.' card-title">'.$f->subcategory->subcategory.'</strong>
                                <span style="float:right;">Total = <span id="p2_'.$f->subcategory_id.'">0</span>%</span>
                            </h4>';

                    if( $i == 1 )
                    { 
                        break;
                    }      
            }        
            
            foreach( $add_focus as $f )
            {
                $html .= '<div class="focusA focusA_'.$f->subcategory_id.' focusA'.$f->id.'">
                            <input type="hidden" name="focus['.$f->subcategory_id.']['.$f->id.'][]" value="0">
                            <div class="row mt-4 ml-2">
                                <input type="text" name="focus['.$f->subcategory_id.']['.$f->id.'][]" class="focus input_focus'.$f->subcategory_id.'" data-class="'.$f->subcategory_id.'" value="0" id="input_focus'.$f->subcategory_id.'_'.$f->id.'" onkeyup="addPercent(\'input_focus'.$f->subcategory_id.'\','.$f->subcategory_id.',\'p2_'.$f->subcategory_id.'\',\'\')">&nbsp;% &nbsp;&nbsp; <strong>'.$f->name.'</strong>
                            </div>
                          </div>';
            }

            $html .= '</div>';    
        }
        else
        {
            $html  = '<script>alert("No children found for this category.")</script>';  
        }
        
        echo $html;
    }

    public function getCountry( Request $request )
    {
        $data['country'] = Country::all();
        return response()->json($data);
    }

    public function getstate(Request $request)
    {
        $data['states'] = State::where( "country_code", $request->country_code )->get( [ "name", "iso2" ] );
        return response()->json( $data );
    }

    public function get( Request $request )
    {
        $data['cities'] = City::where( "state_code", $request->state_code )->where('country_code',$request->country_code )->get( [ "name", "id" ] );
        return response()->json( $data );
    }

    public function deleteLocation( Request $request, $location_id  )
    {
        
        if( Address::find( $location_id )->delete() )
        {
            session()->flash( 'msg', 'Yay.. Deleted successfully.' );
            return redirect()->back();
        }
        else
        {
            session()->flash( 'msg', 'Something went wrong. Address could not be deleted.' );
            return redirect()->back();
        }
    }

}
   
           
         
        

        
            
            
       
                            