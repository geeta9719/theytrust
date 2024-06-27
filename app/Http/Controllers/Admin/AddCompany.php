<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Subcategory;
use App\Mail\SendMail;
use App\Mail\ContactMail;
use App\Models\Budget;
use App\Models\Rate;
use App\Models\Size;
use App\Models\Attribution;
use App\Models\Industry;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\Address;
use App\Models\User;
use App\Models\ClientSize;
use App\Models\AddClientSize;
use App\Models\AddIndustry;
use App\Models\AddFocus;
use App\Models\ServiceLine;
use App\Models\SubcatChild;
use App\Models\Specialization;
use App\Models\AddSpecialization;
use App\Models\AdminInfo;
use App\Models\CompanySubcatChild;
use App\Models\CompanyHasSkill;
// use Response;

use Illuminate\Http\Response;
use Exception;

use App\Models\Country;
use App\Models\State;
use App\Models\City;



class AddCompany extends Controller
{

    public function add_company_and_user($user_id = null, $company_id = null)
    {
        $budgets = Budget::pluck('budget', 'id')->all();
        $rates = Rate::pluck('rate', 'id')->all();

        $sizes       = Size::pluck('size', 'id')->all();



        if ($user_id !== null && $company_id !== null) {
            $user      = User::find($user_id);
            $company   = Company::find($company_id);
        } else {
            $user      = array();
            $company   = array();
        }



        return view('admin.company.add_company', [
            'budgets'   => $budgets,
            'rates'     => $rates,
            'sizes'     => $sizes,
            'user'      => $user,
            'company'   => $company
        ]);
    }

    public function save_company_and_user(Request $request)
    {

        if (empty($request->user_id) && empty($request->company_id)) {


            $request->validate([
                'user_email'        => 'required|email|unique:users,email',
                'user_fname'        => 'required',
                'user_lname'        => 'required',
                'logo'              => 'mimes:jpeg,jpg,png|required|max:10000',
                'org_name'          => 'required',
                'website'           => 'required',
                'size'              => 'required',
                /*'tagline'           => 'required',*/
                'short_description' => 'required',
            ]);

            $create_user     = array(
                'first_name' => $request->user_fname,
                'last_name' => $request->user_lname,
                'name'      => $request->user_fname . ' ' . $request->user_lname,
                'email'     => $request->user_email,
                'role'      => 2,
                'status'    => 1,
                'slug'      => 'User'
            );

            $user = User::create($create_user);

            if (!empty($user->id)) {
                $inputs['profile_type']     = 'basic';
                $inputs['name']             = $request->org_name;
                $inputs['website']          = $request->website;
                $inputs['size']             = $request->size;
                $inputs['budget']           = $request->budget;
                $inputs['rate']             = $request->rate;
                $inputs['founded_at']       = $request->founded_at;
                $inputs['tagline']          = $request->tagline;
                $inputs['short_description'] = $request->short_description;
                $inputs['user_id']          = $user->id;

                if ($request->hasFile('logo')) {
                    $path           = $request->file('logo')->store('images/logo');
                    $inputs['logo'] = $path;
                }

                $company = Company::create($inputs);

                if ($company->id) {
                    return redirect()->back()->with('message', 'Company added successfully.');
                } else {
                    return redirect()->back()->with('msg', 'Something went wrong. Company Couldn\'t be added.');
                }
            } else {
                return redirect()->back()->with('msg', 'Something went wrong. Company Couldn\'t be added.');
            }
        } else {

            $user      = User::find($request->user_id);
            $company   = Company::find($request->company_id);

            if ($user->email != $request->user_email) {
                $validate['user_email']     = 'required|email|unique:users,email';
            }

            $validate['user_fname']        = 'required';
            $validate['user_lname']       = 'required';

            if ($request->hasFile('logo')) {
                $validate['logo']          = 'mimes:jpeg,jpg,png|required|max:10000';
            }

            $validate['org_name']          = 'required';
            $validate['website']           = 'required';
            $validate['size']              = 'required';
            #$validate['tagline']           = 'required';
            $validate['short_description'] = 'required';



            $request->validate($validate);



            # Update User Info

            $user->first_name = $request->user_fname;
            $user->last_name  = $request->user_lname;
            $user->name       = $request->user_fname . ' ' . $request->user_lname;
            $user->email      = $request->user_email;
            $user->save();


            # Update Company Info

            $company->profile_type     = 'basic';
            $company->name             = $request->org_name;
            $company->website          = $request->website;
            $company->size             = $request->size;
            $company->budget           = $request->budget;
            $company->rate             = $request->rate;
            $company->founded_at       = $request->founded_at;
            $company->tagline          = $request->tagline;
            $company->short_description = $request->short_description;
            $company->user_id          = $user->id;

            if ($request->hasFile('logo')) {
                $path          = $request->file('logo')->store('images/logo');
                $company->logo = $path;
            }

            $company->save();

            return redirect()->route('admin.company.add', [$request->user_id, $request->company_id])->with('message', 'Company updated successfully.');
        }
    }

    public function add_company_location($companyId, $userId)
    {

        $country = Country::pluck('name', 'iso2')->all();
        $states  = State::all();

        $country_option_html = '';

        foreach ($country as $c_key => $c_val) {
            $country_option_html .= "<option value='$c_key'>$c_val</option>";
        }


        $addresses = Address::where('company_id', $companyId)->where('user_id', $userId)->get();

        $addresses = empty($addresses) ? array() : $addresses;




        return view('admin.company.add_location', [
            'user_id'               => $userId,
            'company_id'            => $companyId,
            'country'               => $country,
            'country_option_html'   => $country_option_html,
            'states'                => $states,
            'addresses'             => $addresses
        ]);
    }



    public function save_company_location(Request $request)
    {

        #echo '<pre>'; die( print_r( $request->all() ) );


        foreach ($request->action as $key => $act) {

            if ($request->is_head_office[$key] === 1) {
                $company = Company::find($request->company_id);

                if (!empty($company)) {
                    $company->email     = $request->email[$key];
                    $company->mobile    = $request->mobile[$key];
                    $company->save();
                }
            }


            if ($act === 'insert') {
                $inputs['company_id']    = $request->company_id;
                $inputs['user_id']       = $request->user_id;
                $inputs['address']       = $request->address[$key];
                $inputs['city']          = $request->city[$key];
                $inputs['state_iso2']    = $request->state_iso2[$key];
                $inputs['country_iso2']  = $request->country_iso2[$key];
                $inputs['zip']           = $request->zip[$key];
                $inputs['type']          = $request->is_head_office[$key] === 1 ? 1 : 2;
                $inputs['is_head_office'] = $request->is_head_office[$key];
                $inputs['mobile']        = $request->mobile[$key];
                $inputs['email']         = $request->email[$key];
                $inputs['autocomplete']  = $request->address[$key] . ', ' . $request->city[$key];

                Address::create($inputs);
            } elseif ($act === 'update') {

                $address = Address::find($request->id[$key]);

                if (!empty($address)) {
                    $address->company_id    = $request->company_id;
                    $address->user_id       = $request->user_id;
                    $address->address       = $request->address[$key];
                    $address->city          = $request->city[$key];
                    $address->state_iso2    = $request->state_iso2[$key];
                    $address->country_iso2  = $request->country_iso2[$key];
                    $address->zip           = $request->zip[$key];
                    $address->type          = $request->is_head_office[$key] === 1 ? 1 : 2;
                    $address->is_head_office = $request->is_head_office[$key];
                    $address->mobile        = $request->mobile[$key];
                    $address->email         = $request->email[$key];
                    $address->autocomplete  = $request->address[$key] . ', ' . $request->city[$key];

                    $address->save();
                }
            }
        }

        return redirect()->back()->with('message', 'Location added/updated successfully.');
    }


    public function add_company_focus($company_id)
    {

        $company        = Company::where('id', $company_id)->first();
        $category       = Category::all();
        $serviceLine    = ServiceLine::where('company_id', $company_id)->get();

        foreach ($serviceLine as $value) {
            if ($value->percent > 10) {
                $subcat[] = $value->subcategory_id;
            }
        }

        $subcat_children = SubcatChild::all();
        $subcat_child    = array();

        foreach ($subcat_children as $value) {
            $subcat_child[$value->subcategory_id][] = $value;
        }


        $addFocus = AddFocus::where('company_id', $company_id)->get();
        $add_focus = array();

        foreach ($addFocus as $value) {
            $add_focus[$value->subcategory_id][] = $value;
        }


        $industry           = Industry::all();
        $addIndustry        = AddIndustry::where('company_id', $company_id)->get();

        $clientSize         = ClientSize::all();
        $addClientSize      = AddClientSize::where('company_id', $company_id)->get();

        $specialization     = Specialization::all();
        $addSpecialization  = AddSpecialization::where('company_id', $company_id)->get();

        return view('admin.company.add_focus', [
            'user_id'           => $company->user_id,
            'category'          => $category,
            'company'           => $company,
            'addFocus'          => $addFocus,
            'industry'          => $industry,
            'addIndustry'       => $addIndustry,
            'clientSize'        => $clientSize,
            'addClientSize'     => $addClientSize,
            'specialization'    => $specialization,
            'addSpecialization' => $addSpecialization,
            'serviceLine'       => $serviceLine,
            'add_focus'         => $add_focus,
            'subcat_child'      => $subcat_child
        ]);
    }


    public function save_company_focus(Request $request)
    {

        if (!empty($request->service)) {
            $inputs = array();

            foreach ($request->service as $key => $val) {
                foreach ($val as $k => $v) {
                    $id     = $v[0];
                    $find   = ServiceLine::find($id);

                    if ($find) {
                        if (isset($v[2]) && $v[2] != 0) {
                            if (isset($v[1]) && $v[2] != 0) {
                                $find->percent = $v[2];
                                $find->save();
                            } else {
                                $find->delete();
                            }
                        } else {
                            $find->delete();
                        }
                    } else {
                        if (!empty($v[1]) && $v[1] != 0) {
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

        if (!empty($request->focus)) {
            $inputs = array();

            foreach ($request->focus as $key => $val) {
                foreach ($val as $k => $v) {
                    $id     = $v[0];
                    $find   = AddFocus::find($id);
                    if ($find) {
                        if (isset($v[2]) && $v[2] != 0) {
                            if (isset($v[1]) && !empty($v[1])) {
                                $find->percent = $v[2];
                                $find->save();
                            } else {
                                $find->delete();
                            }
                        } else {
                            $find->delete();
                        }
                    } else {
                        if (!empty($v[1]) && $v[1] != 0) {
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

        if (!empty($request->industry)) {
            $inputs = array();

            foreach ($request->industry as $key => $val) {
                $id     = $val[0];
                $find   = AddIndustry::find($id);

                if ($find) {
                    if (isset($val[2]) && $val[2] != 0) {
                        if (isset($val[1]) && $val[1] != 0) {
                            $find->percent = $val[2];
                            $find->save();
                        } else {
                            $find->delete();
                        }
                    } else {
                        $find->delete();
                    }
                } else {
                    if (isset($val[1]) && $val[1] != 0) {
                        $inputs['company_id']   = $request->company_id;
                        $inputs['industry_id']  = $key;
                        $inputs['percent']      = $val[1];

                        AddIndustry::create($inputs);
                    }
                }
            }
        }

        if (!empty($request->clientSize)) {
            $inputs = array();
            foreach ($request->clientSize as $key => $val) {

                $id     = $val[0];
                $find   = AddClientSize::find($id);

                if ($find) {
                    if (isset($val[2]) && $val[2] != 0) {
                        if (isset($val[1]) && $val[1] != 0) {
                            $find->percent = $val[2];
                            $find->save();
                        } else {
                            $find->delete();
                        }
                    } else {
                        $find->delete();
                    }
                } else {
                    if (isset($val[1]) && $val[1] != 0) {
                        $inputs['company_id']       = $request->company_id;
                        $inputs['client_size_id']   = $key;
                        $inputs['percent']          = $val[1];

                        AddClientSize::create($inputs);
                    }
                }
            }
        }

        if (!empty($request->specialization)) {
            $inputs = array();

            foreach ($request->specialization as $key => $val) {
                $id     = $val[0];
                $find   = AddSpecialization::find($id);

                if ($find) {
                    if (isset($val[2]) && $val[2] != 0) {
                        if (isset($val[1]) && $v[1] != 0) {
                            $find->percent = $val[2];
                            $find->save();
                        } else {
                            $find->delete();
                        }
                    } else {
                        $find->delete();
                    }
                } else {
                    if (isset($val[1]) && $val[1] != 0) {
                        $inputs['company_id']        = $request->company_id;
                        $inputs['specialization_id'] = $key;
                        $inputs['percent']           = $val[1];

                        AddSpecialization::create($inputs);
                    }
                }
            }
        }

        return redirect()->route('admin.company.focus', $request->company_id)->with('message', 'Focus added successfully.');
    }


    public function getdata($id)
    {
        $serviceLines = ServiceLine::with(['category'])
            ->where('company_id', $id)
            ->get();
    
        $formattedData = [];
    
        foreach ($serviceLines as $serviceLine) {
            $subcategories = DB::table('add_foci')
                ->join('subcategories', 'add_foci.subcategory_id', '=', 'subcategories.id')
                ->where('subcategories.category_id', $serviceLine->category->id)
                ->select('subcategories.id', 'subcategories.subcategory', 'add_foci.percent as inputValue')
                ->get();
    
            $formattedSubcategories = [];
            foreach ($subcategories as $subcategory) {
                $skills = DB::table('company_subcat_child')
                    ->join('subcat_children', 'company_subcat_child.subcat_child_id', '=', 'subcat_children.id')
                    ->where('subcat_children.subcategory_id', $subcategory->id)
                    ->select('subcat_children.id', 'subcat_children.name')
                    ->get();
    
                $formattedSkills = [];
                foreach ($skills as $skill) {
                    // Fetch subskills for the current skill using companyhasskill table

                    $subskills = DB::table('companyhasskill')
                        ->join('skills', 'companyhasskill.skill_id', '=', 'skills.id')
                        ->where('skills.subcat_child_id', $skill->id)
                        ->select('skills.id', 'skills.name')
                        ->get();
    
                        
                    $formattedSubskills = [];
                    foreach ($subskills as $subskill) {
                        $formattedSubskills[] = [
                            'sub_skill_id' => $subskill->id,
                            'sub_skill_name' => $subskill->name,
                        ];
                    }
    
                    $formattedSkills[] = [
                        'skill_id' => $skill->id,
                        'skill_name' => $skill->name,
                        'subskills_count' => count($formattedSubskills), // Count of subskills
                        'subskills' => $formattedSubskills, // List of subskills
                    ];
                }
    
                $formattedSubcategories[] = [
                    'subcategory_id' => $subcategory->id,
                    'subcategory_name' => $subcategory->subcategory,
                    'value' => $subcategory->inputValue,
                    'skills' => $formattedSkills,
                ];
            }
    
            // Add formatted data for each service line
            $formattedData[] = [
                'category_id' => $serviceLine->category->id,
                'category_name' => $serviceLine->category->category,
                'inputValue' =>  $serviceLine->percent,
                'subcategories' => $formattedSubcategories,
            ];
        }
    
        return response()->json($formattedData);
    }
    






    public function getdataIndustry($id)
    {
        $industry = Industry::get();
        $company   = Company::find($id);
        $clientSize  = ClientSize::all();
        return view('home.Industry', [
            'industry' => $industry,
            'company' => $company,
            'clientSize' => $clientSize
        ]);
    }


    public function industryData($id)
    {

        $industry   =   AddIndustry::with('industry')->where("company_id", $id)->get();
        $client_size =  AddClientSize::with('client_size')->where("company_id", $id)->get();

        $data = array('industry' => $industry, 'client_size' => $client_size);


        return response()->json($data);
    }

    public function save_company_service(Request $request, $id)
    {
        try {
            $data = $request->all();
            ServiceLine::where('company_id', $id)->delete();
            AddFocus::where('company_id', $id)->delete();
            CompanySubcatChild::where('company_id', $id)->delete();
            CompanyHasSkill::where('company_id', $id)->delete();

            foreach ($data['selectedData'] as $item) {
                $categoryId = $item['category_id'];
                $companyId = $id;
                $serviceLineInputs = [
                    'company_id' => $companyId,
                    'category_id' => $categoryId, // Assuming the category ID key is 'category_id'
                    'percent' => $item['inputValue'] // Assuming the input value key is 'percent'
                ];
                ServiceLine::create($serviceLineInputs);

                // Process subcategories
                foreach ($item['subcategories'] as $subcategory) {
                    $sub = Subcategory::where('subcategory', $subcategory['subcategory_name'])->first();
                    if ($subcategory['value']) { // Assuming the input value key for subcategory is 'percent'
                        $addFocusInputs = [
                            'company_id' => $companyId,
                            'subcategory_id' => $sub->id,
                            'percent' => $subcategory['value'], // Assuming the input value key is 'percent'
                            'subcat_child_id' => 0
                        ];
                        AddFocus::create($addFocusInputs);
                        foreach ($subcategory['skills'] as $skill) {
                            CompanySubcatChild::create([
                                'company_id' => $companyId,
                                'subcategory_id' => $sub->id, // Using $sub->id instead of $subcategoryId
                                'subcat_child_id' => $skill['skill_id']
                            ]);
                            foreach ($skill['subskills'] as $suskill) {
                                CompanyHasSkill::create([
                                    'company_id' => $companyId,
                                    'skill_id' => $suskill['sub_skill_id']
                                ]);
                            }
                        }
                    }
                }
            }

            return response()->json(['message' => 'Data saved successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while saving data: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }





    public function save_company_industry(Request $request, $id)
    {
        AddIndustry::where('company_id', $id)->delete();

        AddClientSize::where('company_id', $id)->delete();
        $data = $request->all();
        foreach ($data['industries'] as $item) {
            $inputs = [
                'company_id' => $id,
                'industry_id' => $item['id'],
                'percent' => $item['percentage']
            ];
            AddIndustry::create($inputs);
        }
        foreach ($data['clientSizes'] as $item) {
            $categoryId = $item['id'];
            $inputs = [
                'company_id' => $id,
                'client_size_id' => $item['id'],
                'percent' => $item['percentage']
            ];
            AddClientSize::create($inputs);
        }
    }


    public function add_admin_info(Request $request, $company_id)
    {
        $company    = Company::where('id', $company_id)->first();
        $adminInfo  = AdminInfo::where('company_id', $company_id)->first();

        $user       = User::find($company->user_id);

        return view('admin.company.add_marketing', ['company' => $company, 'adminInfo' => $adminInfo, 'user_email' => $user->email]);
    }

    public function save_company_admin_info(Request $request)
    {

        $id     = $request->id;
        $find   = AdminInfo::where('id', $id)->where('company_id', $request->company_id)->first();

        if ($find) {
            $find->company_id   = $request->company_id;
            $find->email        = $request->email;
            $find->mobile       = $request->mobile;
            $find->linkedin     = $request->linkedin;
            $find->facebook     = $request->facebook;
            $find->twitter      = $request->twitter;
            $find->analytics    = $request->analytics;

            $find->save();
        } else {
            $inputs['company_id']   = $request->company_id;
            $inputs['email']        = $request->email;
            $inputs['mobile']       = $request->mobile;
            $inputs['linkedin']     = $request->linkedin;
            $inputs['facebook']     = $request->facebook;
            $inputs['twitter']      = $request->twitter;
            $inputs['analytics']    = $request->analytics;

            AdminInfo::create($inputs);
        }

        session()->flash('msg', 'Saved Successfully');

        return redirect()->route('admin.company.admininfo', $request->company_id);
    }
}
