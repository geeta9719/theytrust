<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Rennokki\Plans\Traits\HasPlans;
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
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Contact;
use App\Models\Newsletters;
use App\Models\ReviewerEmailLog;
use Rennokki\Plans\Models\PlanModel;




use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['category']       = Category::where('top_cat',1)->get();
        $data['categories'] = Category::with('subcategory')->get();
        $data['reviews'] = CompanyReview::latest()->take(3)->get();
        $data['subcategories'] = Subcategory::with(['subcat_child', 'category'])->get();


        // dd("asdfasdf");
        return view('home.index', $data);
    }

    public function about()
    {

        return view( 'home.about' );
    }

    public function privacy()
    {
        return view( 'home.privacy' );
    }

    public function terms()
    {
        return view( 'home.terms' );
    }

    public function faq()
    {
        return view( 'home.faq' );
    }

    public function showLocationsFromService( Request $request )
    {

        $data['country']    = DB::table('countries')->pluck('name','iso2')->all();
        $subcategory_id     = $request->subcategory_id;
        $locations          = DB::table('addresses')
            ->join('companies', 'companies.id', '=', 'addresses.company_id')
            ->join('service_lines', 'service_lines.company_id', '=', 'addresses.company_id')
            ->select('addresses.id as address_id','addresses.state_iso2','addresses.country_iso2','addresses.city','addresses.address', 'companies.name')
            ->where('service_lines.subcategory_id', $subcategory_id)
            ->where('addresses.address','!=', '')
            ->groupBy('addresses.address')
            ->get();


        $html = '<option value="">Select Location</option>';

        foreach( $locations as $loc )
        {
            $html .= "<option value='".$loc->city."' data-name='".strtolower($loc->city)."'>".$loc->city.", ".$data['country'][$loc->country_iso2]."</option>";
        }

        die( $html );
    }

    public function getCompany( Request $request )
    {

        /*************************************/

        $data['subcategories']  =   $subcategories = DB::table('subcategories')->pluck('subcategory','id')->all();
        $rate_reviews           =   DB::select("SELECT company_reviews.company_id, COUNT(company_reviews.id) AS review, avg(overall_rating) as rating,
                                    position_title, most_impressive FROM company_reviews GROUP BY company_reviews.company_id");
        $rate_review            = array();

        foreach( $rate_reviews as $val )
        {
            $rate_review[ $val->company_id ] = $val;
        }

        $data['rate_review'] = $rate_review;

        $service_line        = DB::select("SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent FROM service_lines");
        $service_lines       = array();

        foreach( $service_line as $val )
        {
            $service_lines[$val->company_id][] = $val;
        }

        $data['service_lines'] = $service_lines;


        /*************************************/


        $where = array();

        if( !empty( $request->services ) )
        {
            $where[]= 'WHERE service_lines.subcategory_id IN ('.implode(',',$request->services).')';
        }

        if( !empty( $request->location[0] ) )
        {
            $where[]= 'addresses.state_iso2 IN (\''.implode('\',\'',$request->location).'\')';
        }

        if( !empty( $request->budget ) )
        {
            $where[]= 'companies.budget = "'.$request->budget.'"';
        }

        if( !empty( $request->rates ) )
        {
            $where[]= 'companies.rate IN (\''.implode('\',\'',$request->rates).'\')';
        }

        if( !empty( $request->industry ) )
        {
            $where[]= 'add_industries.industry_id IN ('.implode(',',$request->industry).')';
        }

        if( !empty( $request->reviews ) )
        {
            $where[]= '(SELECT COUNT(company_reviews.id) AS reviews GROUP BY company_reviews.company_id) >= '.$request->reviews;
        }

        if( !empty( $request->rating ) )
        {
            $where[]= '(SELECT avg(company_reviews.overall_rating) AS rating GROUP BY company_reviews.company_id) >= '.$request->rating;
        }

        $where      = implode( ' AND ', $where );

        $company    = DB::select("SELECT DISTINCT(companies.id),companies.*,addresses.address FROM companies LEFT JOIN addresses ON addresses.company_id = companies.id
                        LEFT JOIN service_lines     ON service_lines.company_id     = addresses.company_id
                        LEFT JOIN add_industries    ON add_industries.company_id    = service_lines.company_id
                        LEFT JOIN company_reviews   ON company_reviews.company_id   = add_industries.company_id ".$where);



        $totalList  = ( $company ) ? count( $company ) : 0;

        $html       = "";
        $html      .=  '

        <div class="col-md-12  pr-5">
            <h5><span class="totalList serchbtn">'.$totalList.' Firms</span> List of the Best Advertising Agencies & Marketing Firms</h5>
        </div>';

        foreach( $company as $key => $val )
        {
            $html .=  '
            <div class="row  ml-0 mr-0 mt-3 searchresult item'.$key.'" style="border: 1px solid gray;">
                <div class="col-md-9 recordbox">
                    <div class="row pt-3 ml-0 mr-0 pr-2">
                        <div class="col-md-2 ">
                            <img src="'.url('storage/'.$val->logo).'" style="width:70%;height: 70%;" alt="">
                        </div>
                        <div class="col-md-5 ">
                            <h3> '.$val->name.'</h3>
                            <p>';

                                if( isset( $rate_review[ $val->id ] ) )
                                {
                                    $html .=  '<span style="font-weight:bolder ;">'.number_format((float)$rate_review[$val->id]->rating, 1, '.', '').'</span>';

                                    for( $i=1; $i<=5; $i++ )
                                    {
                                        if( $i <= $rate_review[ $val->id ]->rating )
                                        {
                                            $html .='<span style="color:#ff3b00f2;font-size:35px;font-weight:bolder;padding-top:10px;"> <img src="'.asset('front_components/images/red.png').'" width="15px;"> </span>';
                                        }
                                        elseif( $rate_review[ $val->id ]->rating <= $i-1 )
                                        {
                                            $html .='<span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;"> <img src="'.asset('front_components/images/comb2.png').'" width="15px;"> </span>';
                                        }
                                        else
                                        {
                                            $html .='<span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;"> <img src="'.asset('front_components/images/red-half.png').'" width="15px;"> </span>';
                                        }
                                    }

                                    $html .='<span>'.$rate_review[$val->id]->review.' REVIEWS</span>';
                                }

                            $html .='</p>

                        </div>
                        <div class="col-md-4 ">
                            <h5>'.$val->tagline.'</h5>
                        </div>
                        <div class="col-md-1 "></div>
                    </div>
                    <div class="row  ml-0 mr-0 boxbrd pt-0 pb-0">
                        <div class="col-md-2 brdright pt-2">
                            <h4><span>Verified</span></h4>
                            <p><i class="fa fa-tag" aria-hidden="true"></i>'.$val->budget.'</p>
                            <p><i class="fa fa-clock-o" aria-hidden="true" ></i>'.$val->rate.'</p>
                            <p><i class="fa fa-user" aria-hidden="true" ></i>'.$val->size.'</p>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>'.$val->address.'</p>
                        </div>
                        <div class="col-md-6 brdright">';

                            $html .= '<p>

                            <div id="piechart'.$val->id.'"></div>';

                                $t      = 0;
                                $data   = array();
                                $data[0]= array( 'Services', 'Percent' );

                                for( $i = 0; $i < count( $service_lines[ $val->id ] ); $i++ )
                                {
                                    if( $service_lines[ $val->id ][$i]->percent > 0 )
                                    {
                                        $t          = $t + $service_lines[ $val->id ][ $i ]->percent;
                                        $data[$i+1] = array( $subcategories[ $service_lines[ $val->id ][$i]->subcategory_id ], (int)$service_lines[ $val->id ][$i]->percent );
                                    }
                                }

                                if( $t < 100 )
                                {
                                    $p          = 100 - $t;
                                    $data[$i+1] = array( "None", $p );
                                }

                                $data = json_encode( $data );

                                ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable(<?=$data ?>);

    var options = {
        'title': 'Service Focus',
        'width': 350,
        'height': 250
    };

    var chart = new google.visualization.PieChart(document.getElementById("piechart<?=$val->id?>"));
    chart.draw(data, options);
}
</script>

<?php
                            $html .= '
                            </p>';

                            $html .='
                        </div>
                        <div class="col-md-4 pt-3">';

                            if( isset( $rate_review[ $val->id ] ) )
                            {
                                $html .='<p>"'.$rate_review[ $val->id ]->most_impressive.'</p>
                                <p>'.$rate_review[$val->id]->position_title.'</p>';
                            }

                            $html .='
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pt-3 text-center px-0">
                   <div class="container py-4 border-bottom ">
                        <a href="'. url( $val->website ) . '" target="_blank" class="serchbtn w-100">View Website</a>
                   </div>
                   <div class="container py-4 border-bottom">
                        <a href="'. url( 'company-profile/' . $val->id ) .'" target="_blank" class="serchbtn w-100">Visit Profile</a>
                   </div>
                   <div class="container py-4">
                        <a href="'. url( 'company-contact/' . $val->id ) .'" target="_blank" class="serchbtn w-100">Contact</a>
                   </div>
                </div>
            </div> <br/>
            ';
        }

        die( $html );

    }

    public function companies( Request $request )
    {

        $data['industry']   = Industry::pluck('name','id')->all();
        $data['budget']     = Budget::pluck('budget','id')->all();
        $data['rate']       = Rate::pluck('rate','id')->all();
        $data['locations']  = DB::table('addresses')->where('addresses.address','!=', '')->pluck('address','state_iso2')->all();

        /*************************************/

        $data['subcategories']  = DB::table('subcategories')->pluck('subcategory','id')->all();
        $rate_review            = DB::select( "SELECT company_reviews.company_id, COUNT(company_reviews.id) AS review, avg(overall_rating) as rating,
                                  position_title, most_impressive FROM company_reviews GROUP BY company_reviews.company_id" );
        $rate                   = array();

        foreach( $rate_review as $val )
        {
            $rate[$val->company_id] = $val;
        }

        $data['rate_review'] = $rate;


        $service_line        = DB::select("SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent FROM service_lines");
        $service_lines       = array();

        foreach( $service_line as $val )
        {
            $service_lines[$val->company_id][] = $val;
        }

        $data['service_lines'] = $service_lines;

        //dd($data['service_lines']);

        /*************************************/

        $where = array();

        if( !empty( $request->services ) )
        {
            $where[]= 'WHERE service_lines.subcategory_id IN (' . implode( ',', $request->services ) . ')';
        }

        if( !empty( $request->location[0] ) )
        {
            $where[]= 'addresses.state_iso2 IN (\''.implode('\',\'',$request->location).'\')';
        }

        if( !empty( $request->budget ) )
        {
            $where[]= 'companies.budget = "'.$request->budget.'"';
        }

        if( !empty( $request->rates ) )
        {
            $where[]= 'companies.rate IN (\''.implode('\',\'',$request->rates).'\')';
        }

        if( !empty( $request->industry ) )
        {
            $where[]= 'add_industries.industry_id IN ('.implode(',',$request->industry).')';
        }

        if( !empty( $request->reviews ) )
        {
            $where[]= '(SELECT COUNT(company_reviews.id) AS reviews GROUP BY company_reviews.company_id) >= '.$request->reviews;
        }

        if( !empty( $request->rating ) )
        {
            $where[]= '(SELECT avg(company_reviews.overall_rating) AS rating GROUP BY company_reviews.company_id) >= '.$request->rating;
        }

        $where = implode( ' AND ', $where );

        $data['company'] = $company = DB::select( "SELECT DISTINCT(companies.id), companies.*, addresses.address FROM companies
                                        LEFT JOIN addresses ON addresses.company_id = companies.id
                                        LEFT JOIN service_lines ON service_lines.company_id = companies.id
                                        LEFT JOIN add_industries ON add_industries.company_id = companies.id
                                        LEFT JOIN company_reviews ON company_reviews.company_id = companies.id " . $where );

        return view( 'home.searchDirectory', $data );

    }

    public function getSearchList( Request $request )
    {
        $term           = explode(' ',$request->term);

        $whereComp      = array();
        $whereComp1     = array();
        $whereCity      = array();
        $whereSub       = array();

        foreach( $term as $t )
        {
            if( strlen( $t ) >= 3 )
            {
                $whereSub[]     = " subcategories.subcategory like '%".$t."%'";
                $whereCity[]    = " addresses.city like '%".$t."%'";

                $whereComp[]    = " companies.name like '%".$t."%'";
                $whereComp1[]   = " 'name', 'like', '%".$request->term."%'";
            }
        }

        $whereC         = ' WHERE '.implode(' OR ', $whereComp);
        $whereC1        = 'where('.implode(' )->orWhere( ', $whereComp1).')';
        $whereC2        = implode(' )->orWhere( ', $whereComp1);


        $whereS         = ' WHERE '.implode(' OR ', $whereSub);
        $whereCI        = ' WHERE '.implode(' OR ', $whereCity);
        $data['sub']    = DB::select( "SELECT subcategories.id, subcategories.subcategory FROM subcategories " . $whereS );

        $subc = array();

        //print_r($data['sub']);

        if( count( $data['sub'] ) > 0 )
        {
            foreach( $data['sub'] as $sub )
            {
                $subc[] = $sub->subcategory;
            }

            $subc = " WHERE subcategories.subcategory IN ('".implode('\',\'', $subc)."') ";
        }
        else
        {
            $subc = "";
        }

        //echo "SELECT subcategories.id,subcategories.subcategory FROM subcategories ".$whereS;

        $data['city']   = DB::select("SELECT addresses.company_id,addresses.city FROM addresses ".$whereCI." GROUP BY addresses.city");
        $city           = array();


        if( count( $data['city'] ) > 0 )
        {
            foreach( $data['city'] as $add )
            {
                $city[] = $add->city;
            }

            if( !empty( $subc ) )
            {
                $city = " AND addresses.city IN ('".implode('\',\'', $city)."') ";
            }
            else
            {
                $city = " WHERE addresses.city IN ('".implode('\',\'', $city)."') ";
            }
        }
        else
        {
            $city = "";
        }



        if( !empty( $subc ) || !empty( $city ) )
        {
            $data['subcategory'] = DB::select("SELECT subcategories.id,subcategories.subcategory,addresses.city,addresses.state_iso2 FROM subcategories
                                    INNER JOIN service_lines ON service_lines.subcategory_id = subcategories.id
                                    INNER JOIN addresses ON addresses.company_id = service_lines.company_id  " . $subc . $city . " GROUP BY service_lines.subcategory_id" );
        }
        else
        {
            $data['subcategory'] = array();
        }

        $data['company'] = DB::select("SELECT companies.id,companies.name,companies.logo FROM companies ".$whereC);


        $rate_review     = DB::select("SELECT company_reviews.company_id, avg(overall_rating) as rating FROM company_reviews GROUP BY company_reviews.company_id");

        $rate = array();

        foreach( $rate_review as $val )
        {
            $rate[$val->company_id] = $val;
        }

        $data['rate_review'] = $rate;

        $html       = "";
        $subcat_loc = "";
        $state_iso2 = "";

        $html      .= '
        <div class="search_results__row top_companies">';

            if( count( $data['subcategory'] ) > 0 )
            {
                $html .= '
                <div class="search_results__title"><strong>Top Companies</strong></div>
                <ul class="search_results__content">';

                foreach( $data['subcategory'] as $subcat )
                {
                    if( !empty( $data['city'] ) )
                    {
                        $subcat_loc = " in ".ucfirst($subcat->city);
                        $state_iso2 = '&location[]='.$subcat->state_iso2;
                    }

                    $html .= '
                    <li style="list-style:none;"><a style="text-decoration:none;" href="'.url('companies?_token='.csrf_token().'&services[]='.$subcat->id).$state_iso2.'">Top <strong>'.ucfirst($subcat->subcategory).'</strong> Companies '.$subcat_loc.'</a></li>';
                }

                $html .= '</ul>';
            }

            $company_loc = "";

            if( count( $data['company'] ) > 0 )
            {
                $html .= '

                <div class="search_results__title"><strong>Profiles</strong></div>
                <ul class="search_results__content">';

                foreach( $data['company'] as $company )
                {

                    if( isset( $data['rate_review'][$company->id] ) )
                    {
                        $rt = number_format((float)$data['rate_review'][$company->id]->rating, 1, '.', '').' <img src="'.asset('front_components/images/red.png').'" width="15px;">';
                    }
                    else
                    {
                        $rt = '0.0  <img src="'.asset('front_components/images/red.png').'" width="15px;">';
                    }

                    $html .= '
                    <li style="list-style:none;">
                        <a style="text-decoration:none;" href="'.url('company-profile/'.ucfirst($company->id)).'"><img src="'.asset('storage/'.$company->logo).'" width="20px" height="20px"> &nbsp;<strong>'.$company->name.'</strong> '.$company_loc.'</a>
                        <span style="float:right;">'.$rt.' </span>
                    </li>';
                }

                $html .= '</ul>';
            }

            $html .= '</div>';

        die( $html );
    }

    public function companyProfile( Request $request, $company_id )
    {
        /*************************************/

        $data = array();

        $data['subcategories']  = DB::table('subcategories')->pluck('subcategory','id')->all();
        $data['subcat_child']   = DB::table('subcat_children')->pluck('name','id')->all();
        $data['industry']       = DB::table('industries')->pluck('name','id')->all();

        $rate_review = DB::select( "SELECT company_reviews.company_id, COUNT(company_reviews.id) AS review, avg(overall_rating) as rating, position_title, most_impressive FROM company_reviews WHERE company_reviews.company_id = ".$company_id." GROUP BY company_reviews.company_id" );

        if( $rate_review )
        {
            $data['rate_review'] = $rate_review[0];
        }

        //dd($data['rate_review']);

        $service_line = DB::select( "SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent FROM service_lines WHERE service_lines.company_id = ".$company_id );

        $data['service_lines'] = $service_line;

        //dd($data['service_lines']);

        $add_focus          = DB::select("SELECT add_foci.company_id, add_foci.subcat_child_id, add_foci.percent FROM add_foci WHERE add_foci.company_id = ".$company_id);
        $data['add_focus']  = $add_focus;

        //dd($data['add_focus']);

        $add_industry       = DB::select("SELECT add_industries.company_id, add_industries.industry_id, add_industries.percent FROM add_industries WHERE add_industries.company_id = ".$company_id);

        $data['add_industry'] = $add_industry;
        //dd($data['service_lines'])

        $review             = DB::select( "SELECT company_reviews.* FROM company_reviews WHERE company_reviews.company_id = ".$company_id );

        $data['review']     = $review;

        //dd($data['review']);

        /*************************************/

        $data['company']    = Company::find($company_id);
        $data['address']    = Address::where('company_id',$company_id)->get();

        //dd($data);
        return view('home.companyProfile', $data);
    }

    public function companyContact( Request $request, $company_id )
    {
        session( [ 'referer' => url( 'company-contact/' . $company_id ) ] );

        $data['companies'] = DB::table('companies')->where( 'id', $company_id )->get();

        if( Auth::check() )
        {

            return view('home.companyContact', $data);
        }
        else
        {
            return redirect('auth/linkedin');
        }
    }

    public function sendCompanycontactEmail( Request $request )
    {
        //echo "<pre>"; print_r($request->all());die;

        $request->validate([
            'full_name'     => 'required',
            'company_name'  => 'required',
            'contact_email' => 'required|email',
            'subject'       => 'required',
            'message'       => 'required'
        ]);

        $details = [
            'title'         => $request->full_name,
            'company_name'  => $request->company_name,
            'contact_email' => $request->contact_email,
            'subject'       => $request->subject,
            'message'       => $request->message
        ];

        Mail::to('raivipin94@gmail.com')->send(new SendMail($details));

        return back()->with('success', 'Mail Send!!!');
    }

    public function validationStep(Request $request)
    {

        //dd($request);

        $data = array();

        if( $request->form == 'form1' )
        {
            if($request->project_type == '')
            {
                $data['project_type'] = 'Project type should not be empty';
            }

            if($request->project_title == '')
            {
                $data['project_title'] = 'Project title should not be empty';
            }
            elseif(strlen($request->project_title) == 2)
            {
                $data['project_title'] = 'Minimum length should be two charecters';
            }
            elseif(is_numeric($request->project_title[0]))
            {
                $data['project_title'] = 'Project type should not be start with numeric.';
            }

            if($request->company_type == '')
            {
                $data['company_type'] = 'Company type should not be empty';
            }

            if($request->cost_range == '')
            {
                $data['cost_range'] = 'Cost should not be empty';
            }
            if($request->project_start == '')
            {
                $data['project_start'] = 'Project start date should not be empty';
            }
            if($request->project_end == '')
            {
                $data['project_end'] = 'Project end date should not be empty';
            }
        }

        if( $request->form == 'form2' )
        {
            if($request->company_position == '')
            {
                $data['company_position'] = 'It should not be empty';
            }
            if($request->for_what_project == '')
            {
                $data['for_what_project'] = 'It should not be empty';
            }
            if($request->how_select == '')
            {
                $data['how_select'] = 'It should not be empty';
            }
            if($request->scope_of_work == '')
            {
                $data['scope_of_work'] = 'It should not be empty';
            }
            if($request->team_composition == '')
            {
                $data['team_composition'] = 'It should not be empty';
            }
            if($request->any_outcome == ''){
                $data['any_outcome'] = 'It should not be empty';
            }
            if($request->how_effective == '')
            {
                $data['how_effective'] = 'It should not be empty';
            }
            if($request->most_impressive == '')
            {
                $data['most_impressive'] = 'It should not be empty';
            }
            if($request->area_of_improvements == '')
            {
                $data['area_of_improvements'] = 'It should not be empty';
            }
            if($request->quality == '')
            {
                $data['quality'] = 'It should not be empty';
            }
            if($request->timeliness == '')
            {
                $data['timeliness'] = 'It should not be empty';
            }
            if($request->cost == '')
            {
                $data['cost'] = 'It should not be empty';
            }


            if($request->communication == '')
            {
                $data['communication'] = 'It should not be empty';
            }

            if($request->expertise == '')
            {
                $data['expertise'] = 'It should not be empty';
            }

            if($request->ease_of_working == '')
            {
                $data['ease_of_working'] = 'It should not be empty';
            }

            if($request->refer_ability == '')
            {
                $data['refer_ability'] = 'It should not be empty';
            }
            if($request->overall_rating == '')
            {
                $data['overall_rating'] = 'It should not be empty';
            }
        }


        if( $request->form == 'form3' )
        {

            if( $request->full_name == '' )
            {
                $data['full_name'] = 'Name should not be empty';
            }

            elseif( strlen( $request->full_name ) == 2 )
            {
                $data['full_name'] = 'Minimum Length should be two charecters';
            }

            if($request->position_title != '')
            {
                if( strlen( $request->position_title ) == 2 )
                {
                    $data['position_title'] = 'Minimum length should be two charecters';
                }
            }
            if( $request->company_name != '' )
            {
                if( strlen( $request->position_title ) == 2 )
                {
                    $data['position_title'] = 'Company Name should be two charecters long atleast.';
                }
            }

            if( $request->company_size == '' )
            {
                $data['company_size'] = 'Company Size should not be empty';
            }

            // if( $request->city == '' )
            // {
            //     $data['city'] = 'City should not be empty';
            // }

            // if( $request->state == '' )
            // {
            //     $data['state'] = 'State should not be empty';
            // }

            // if( $request->country == '' )
            // {
            //     $data['country'] = 'Country should not be empty';
            // }
        }

        if( $request->form == 'form4' )
        {

            if( $request->company_email == '' )
            {
                $data['company_email'] = 'Email should not be empty';
            }

            elseif( filter_var( $request->company_email, FILTER_VALIDATE_EMAIL ) === false )
            {
                $data['company_email'] = 'Email not valid';
            }

            if($request->phone_number == '')
            {
                $data['phone_number'] = 'Phone should not be empty';
            }

            elseif( strlen( $request->phone_number ) != 10 )
            {
                $data['phone_number'] = 'Length should be 10 charecters';
            }

            elseif( !is_numeric( $request->phone_number[0] ) )
            {
                $data['phone_number'] = 'Phone should be numeric.';
            }

            if( $request->linkedin_url == '' )
            {
                $data['linkedin_url'] = 'Linkedin url should not be empty';
            }

            elseif( filter_var( $request->linkedin_url, FILTER_VALIDATE_URL ) === false )
            {
                $data['linkedin_url'] = 'Url is not a valid URL';
            }

            if( $request->company_url != '' )
            {
                if(filter_var($request->company_url, FILTER_VALIDATE_URL) === false) {
                    $data['company_url'] = 'url is not a valid URL';
                }
            }
        }

        return response()->json($data);
    }

    public function getListed(Request $request)
    {
        $cd = '';

        if(Auth::check())
        {
            $uid = auth()->user()->id;
            $cd = Company::select('*')->where('user_id', '=', $uid)->first();

            if($cd)
            {
                return redirect()->route('company.dashboard',$cd->id);
            }
            else
            {
                $user =  Auth::user();
                 if(!$user->hasActiveSubscription()){
                    return redirect('user/' . $user->id . '/basicInfo?profile=basic');

                 }
                 $company = Company::where('user_id', $user->id)->first();
                 if (!$company) {
                    return redirect()->route('user.basicInfo', ['user' => $user]);
                }
                // // // Check for the company's address
                // // $address = Address::where('company_id', $company->id)->first();
                // // if (!$address) {
                // //     return redirect()->route('company.location', ['company' => $company]);
                // // }

                // // return redirect('membership-plans');
                // return redirect()->route('user.personal');
                return view('home.getListed');
            }
        }
        else
        {
            
            //session(['referer' => url('user/personal')]);
            session(['referer' => url('sponsorship')]);
            return redirect('auth/linkedin');
        }
    }

    public function getPlancompare(Request $request)
    {
        // dd("adsfsdf");


        return view('home.plans');
        $cd = '';

        if(Auth::check())
        {
            $uid = auth()->user()->id;
            $cd = Company::select('*')->where('user_id', '=', $uid)->first();

            if($cd)
            {
                return redirect()->route('company.dashboard',$cd->id);
            }
            else
            {
                return view('plans-compare');
               
            }
        }
        else
        {
            //session(['referer' => url('user/personal')]);
            session(['referer' => url('sponsorship')]);
            return redirect('auth/linkedin');
        }
    }


    public function getPriceListing()
    {

        if( Auth::check() )
        {
            $user =  Auth::user();
            $key = \config('services.stripe.secret');
            $stripe = new \Stripe\StripeClient($key);
            $plansraw = $stripe->plans->all();
            $plans = $plansraw->data;
            
            foreach($plans as $plan) {
                $prod = $stripe->products->retrieve(
                    $plan->product,[]
                );
                $plan->product = $prod;
            }
            $user = Auth::user();

            return view('home.getPriceListing', [
                'user'=>$user,
                'plans' => $plans
            ]);
        }
        else
        {
            return redirect('auth/linkedin');
        }
    }


    public function saveChoosenPlan( Request $request )
    {
        $plan   = $request->plan;
        $user_id= $request->user_id;

        $user   = User::find( $user_id );

        $user->plan = $plan;

        if( $user->save() )
        {
            return response()->json( ['status'=> 'success'] );
        }
        else
        {
            return response()->json( ['status'=> 'failure'] );
        }

    }


    public function review(Request $request,$company)
    {
        if(Auth::check()){
            return redirect()->route('company.getReview',$company);
        }else{
            session(['referer' => url('company/'.$company.'/getReview')]);
            return redirect('auth/linkedin');
        }
    }

    public function getReview( Request $request, $company )
    {

        $data['company'] = Company::find($company);
        $data['category'] = Category::All();

        //$data['size'] = Size::pluck('size','id')->all();

        $s = Size::all();

        foreach ( $s as $value )
        {
            $b = explode('-',$value->size);
            $size[$b[0]] = $value;
        }

        ksort($size);

        //dd($size);

        $data['size'] = $size;

        //$data['budget'] = Budget::pluck('budget','id')->all();

        $bud = Budget::all();
        foreach ($bud as $value) {
            $b = explode('-',$value->budget);
            $budget[$b[0]] = $value;
        }
        ksort($budget);
        //dd($budget);
        $data['budget'] = $budget;

        $data['attribution'] = Attribution::All();

        $data['countries']     = Country::All();

        return view('home.getReview' ,$data);
    }

    public function saveReview( Request $request )
    {

        // dd($request->all());
        $inputs = array();

        $inputs['company_id']               = $request->company_id;
        $inputs['user_id']                  = $request->user_id;


        # Step 1

        $inputs['project_type']             = $request->project_type;
        $inputs['project_title']            = $request->project_title;
        $inputs['company_type']             = $request->company_type;
        $inputs['cost_range']               = $request->cost_range;
        $inputs['project_start']            = $request->project_start;
        $inputs['project_end']              = $request->project_end;


        # Step 2 #DONE

        $inputs['company_position']         = $request->company_position;
        $inputs['for_what_project']         = $request->for_what_project;
        $inputs['how_select']               = $request->how_select;
        $inputs['scope_of_work']            = $request->scope_of_work;
        $inputs['team_composition']         = $request->team_composition;
        $inputs['any_outcomes']             = $request->any_outcome;
        $inputs['how_effective']            = $request->how_effective;
        $inputs['most_impressive']          = $request->most_impressive;
        $inputs['area_of_improvements']     = $request->area_of_improvements;


        $inputs['quality']                  = $request->quality;
        $inputs['quality_review']           = $request->quality_review;

        $inputs['timeliness']               = $request->timeliness;
        $inputs['timeliness_review']        = $request->timeliness_review;

        $inputs['cost']                     = $request->cost;
        $inputs['cost_review']              = $request->cost_review;

        $inputs['communication']            = $request->communication;
        $inputs['communication_review']     = $request->communication_review;

        $inputs['expertise']                = $request->expertise;
        $inputs['expertise_review']         = $request->expertise_review;

        $inputs['ease_of_working']          = $request->ease_of_working;
        $inputs['ease_of_working_review']   = $request->ease_of_working_review;

        $inputs['refer_ability']            = $request->refer_ability;
        $inputs['refer_ability_review']     = $request->refer_ability_review;

        $inputs['overall_rating']           = $request->overall_rating;
        $inputs['overall_rating_review']    = $request->overall_rating_review;


        #DONE

        $inputs['full_name']                = $request->full_name;
        $inputs['position_title']           = $request->position_title;
        $inputs['company_name']             = $request->company_name;
        $inputs['company_size']             = $request->company_size;
        $inputs['country']                  = $request->country;
        $inputs['state']                    = "null";
        $inputs['city']                     = "null";


        $inputs['company_email']            = $request->company_email;
        $inputs['phone_number']             = $request->phone_number;
        $inputs['linkedin_url']             = $request->linkedin_url;
        $inputs['company_url']              = $request->company_url;

        CompanyReview::create( $inputs );

        return response()->json( $inputs );

    }

    public function contact( Request $request )
    {
        return view('home.contact');
    }

    public function sendContactEmail( Request $request )
    {

        $request->validate([
                                'help_options'  => 'required',
                                'first_name'    => 'required',
                                'last_name'     => 'required',
                                'email'         => 'required|email',
                                'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
                          ]);



        $inputs['help_options']   = $request->help_options;
        $inputs['first_name']     = $request->first_name;
        $inputs['last_name']      = $request->last_name;
        $inputs['email']          = $request->email;
        $inputs['phone']          = $request->phone;
        $inputs['message']          = $request->message;


        Contact::create( $inputs );

        $subject    =  "New Enquiry From Contact Page";

        $email_type = 'contact';

        $details    = [
                        'first_name'    => $request->first_name,
                        'last_name'     => $request->last_name,
                        'email'         => $request->email,
                        'phone'         => $request->phone,
                        'help_options'  => $request->help_options,
                        'subject'       => $subject
                      ];

        Mail::to( 'pavank@cheenti.com')->send( new ContactMail( $details, $subject, $email_type ) );

        return back()->with( 'success', 'Your request has been submitted successfully.' );

    }

    public function send_email_to_reviewer( Request $request )
    {

        $inputs['email']          = $request->email;
        $inputs['email_subject']  = $request->email_subject;
        $inputs['email_content']  = html_entity_decode( $request->email_content, ENT_QUOTES, "ISO-8859-1" );

        ReviewerEmailLog::create( $inputs );

        $subject        =  $request->email_subject;
        $details        =  ['email_content' => html_entity_decode( $request->email_content, ENT_QUOTES, "ISO-8859-1" ), 'subject' => $subject ];
        $email_type     =  'reviewer_email';

        Mail::to( 'pavank@cheenti.com')->send( new ContactMail( $details, $subject, $email_type ) );

        return response()->json( ['status' => 'success' ] );
    }

    public function company_review_email_logs( Request $request )
    {

        $data['review_logs'] = ReviewerEmailLog::paginate(5);

        return view( 'admin.company.review_email_logs', $data );
    }




    //     Newsletters::create( $inputs );

    //     return back()->with( 'newsuccess', 'Thanks.. You have been subscribed successfully.' );

    // }
   
    //     Newsletters::create( $inputs );

    //     return back()->with( 'newsuccess', 'Thanks.. You have been subscribed successfully.' );

    // }

    public function subscribeNewsletter(Request $request)
    {
            $request->validate(['email' => 'required|email']);

            $inputs['email'] = $request->email;
            Newsletters::create($inputs);

            return redirect()->to(url()->previous() . '#success-msg')->with('newsuccess', 'Thanks.. You have been subscribed successfully.');
    }


    // public function saveChoosenPlan( Request $request )
    // {
    //     $plan   = $request->plan;
    //     $user_id= $request->user_id;

    //     $user   = User::find( $user_id );

    //     $user->plan = $plan;

    //     if( $user->save() )
    //     {
    //         return response()->json( ['status'=> 'success'] );
    //     }
    //     else
    //     {
    //         return response()->json( ['status'=> 'failure'] );
    //     }

    // }
}
