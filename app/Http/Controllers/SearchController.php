<?php
namespace App\Http\Controllers;

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
use App\Models\Seo;
use App\Models\CompanyHasProject;
use App\Models\SubcatChild;





use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //
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

    public function get_location(Request $request){
        //DB::enableQueryLog(); //start for print query
        $data['country'] = DB::table('countries')->pluck('name','iso2')->all();
        $subcategory_id = $request->subcategory_id;
        $locations = DB::table('addresses')
            ->join('companies', 'companies.id', '=', 'addresses.company_id')
            ->join('service_lines', 'service_lines.company_id', '=', 'addresses.company_id')
            ->select('addresses.id as address_id','addresses.state_iso2','addresses.country_iso2','addresses.city','addresses.address', 'companies.name')
            ->where('service_lines.subcategory_id', $subcategory_id)
            ->where('addresses.address','!=', '')
            ->groupBy('addresses.address')
            ->get();
            //dd(DB::getQueryLog()); //print here query
            $html = '<option value="">Select Location</option>';
        //print_r($data['country']);
        foreach($locations as $loc){
            $html .= "<option value='".$loc->city."' data-name='".strtolower($loc->city)."'>".$loc->city.", ".$data['country'][$loc->country_iso2]."</option>";
        }
        echo $html;die;
    } 


    public function getIdByCatName( $cat_name )
    {
       
        $cat    = Category::where( 'category', $cat_name )->first( ['id'] );

        if( empty( $cat ) )
        {
            $cat = Subcategory::where( 'subcategory', $cat_name )->first( ['id'] );

            return $cat ? $cat->id : null;
        }
        else
        {
            return $cat->id;
        }

        return null;
    }


    public function getPreSelectedLocationDropdown( $cat_id = null  )
    {
        if( $cat_id !== null )
        {
            $locations =  DB::select( "SELECT  *, count(*) as city_count FROM addresses WHERE company_id 
                                     IN( SELECT DISTINCT company_id FROM service_lines WHERE category_id = $cat_id OR subcategory_id = $cat_id ) 
                                     GROUP BY city ORDER by city_count DESC" );
            return ( $locations ) ? $locations : array();
        }
        else
        {
            return array();
        }
    }


    public function companies( Request $request, $ser = null, $loc = null )
    {


        $cat_id           = $this->getIdByCatName( $ser );

        $data['industry'] = Industry::pluck( 'name','id' )->all();

        $industry = AddIndustry::with('industry')->get();
    


        
        $bud              = Budget::all();


        foreach ($bud as $value) {
            $b = explode('-', $value->budget);
            $minValue = intval(str_replace('$', '', $b[0])); // Extract and convert the minimum value to an integer
            $budget[$minValue] = $value;
        }
        

        ksort( $budget );
        $data[ 'budget' ] = $budget;
        $r = Rate::all();


        foreach ($r as $value) {
            $b = explode('-', $value->rate);
            $minValue = intval(str_replace('$', '', $b[0])); // Extract and convert the minimum value to an integer
            $rate[$minValue] = $value;
        }
    
        ksort($rate);



        
        $data['rate']           = $rate;

        $data['loc_dropdown']   = $this->getPreSelectedLocationDropdown( $cat_id );


        $data['locations']      = Address::where( 'addresses.address', '!=', '' )->groupBy( 'addresses.city' )->get();


        $data['main_slug']      = $ser;

       

        $data['subcategories']  = DB::table( 'subcategories' )->pluck( 'subcategory', 'id' )->all();


        $rate_review            = DB::select(
                                                "SELECT company_reviews.company_id, 
                                                COUNT(company_reviews.id) AS review, avg(overall_rating) as rating, position_title, most_impressive 
                                                FROM company_reviews GROUP BY company_reviews.company_id"
                                            );
       
        
        $rate = array();

        foreach( $rate_review as $val )
        {
            $rate[ $val->company_id ] = $val;
        }



        $data['rate_review'] = $rate;
        

        $service_line   = DB::select( "SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent, subcategories.subcategory FROM service_lines   LEFT JOIN subcategories ON subcategories.id = service_lines.id");
        
        $service_lines  = array();


        foreach( $service_line as $val )
        {
            $service_lines[ $val->company_id ][] = $val;
        }



        $data['service_lines'] = $service_lines;

        
       

        $where = array();


        
        if (!empty($request->services)) {
            $filteredServices = array_filter($request->services, function ($value) {
                return !is_null($value);
            });
        
            if (!empty($filteredServices)) {
                $where[] = 'WHERE service_lines.subcategory_id IN (' . implode(',', $filteredServices) . ')';
            }
        }

        elseif( !empty( $ser ) )
        {
            $cat = DB::table('categories')
            ->join( 'subcategories', 'categories.id', '=', 'subcategories.category_id' )
            ->where( 'categories.category', str_replace( '-', ' ', $ser ) )
            ->orWhere( 'subcategories.subcategory', str_replace( '-', ' ', $ser ) )
            ->get( ['categories.id', 'subcategories.id as sid', 'subcategories.subcategory' ] );


            if( !empty( $cat ) )
            {
                
                foreach( $cat as $scat )
                {
                    $_REQUEST['services'][] = $scat->sid;
                }

                $where[] = "WHERE service_lines.subcategory_id IN ( ".implode( ',', $_REQUEST['services'] ) . ")";

            }

        }
        
        if( !empty( $request->location ) )
        {
            // dd($request->location);
            $where[]= "addresses.city='".$request->location . "'";
        }
        

        elseif( !empty( $loc ) )
        {
            $_REQUEST['location']        = $loc;
            $where[] = "addresses.city   = '".$loc."'";
        }
        
        if( !empty( $request->budget ) )
        {
            $where[]= 'companies.budget = "'.$request->budget.'"';
        }

        /*if( !empty( $request->rates ) )
        {
           $where[]= 'companies.rate IN ( \''.implode('\',\'',$request->rates).'\')'; 
        }*/

        if( !empty( $request->rates[0] ) && count( $request->rates ) > 0 )
        {
            $where[]= 'companies.rate IN ( \''.implode('\',\'',$request->rates).'\')';
        }

        if( !empty( $request->industry ) )
        {
            $where[]= 'add_industries.* IN ('.implode(',',$request->industry).')';
        }

        if( !empty( $request->reviews ) )
        {
            $where[]= '( SELECT COUNT(company_reviews.id) AS reviews GROUP BY company_reviews.company_id ) >= '.$request->reviews;
        }

        if( !empty( $request->rating ) )
        {
            $where[]= '( SELECT avg(company_reviews.overall_rating) AS rating GROUP BY company_reviews.company_id ) >= '.$request->rating;
        }

        

        $where = implode( ' AND ', $where );
        /************** pagination *********************/



        $total_record = DB::select(
                                    "SELECT count( DISTINCT(companies.id) )  as record  ,add_industries.* FROM companies 
                                     LEFT JOIN addresses ON addresses.company_id = companies.id 
                                     LEFT JOIN service_lines ON service_lines.company_id = companies.id 
                                     LEFT JOIN add_industries ON add_industries.company_id = companies.id 
                                     LEFT JOIN company_reviews ON company_reviews.company_id = companies.id " . $where 
                                  );

        
        $data['totalRecord']                = $total_record[0]->record;
        $data['perPage']                    = $per_page = 10;
        $data['beforeOrAfterCurrentPage']   = 2;
        $data['totalPage']                  = $total_pages   = ceil( $data['totalRecord'] / $per_page );


        if( isset( $_REQUEST['page'] ) && !empty( $_REQUEST['page'] ) )
        {
            $page   = $_REQUEST['page'];
            $offset = ($page*$per_page)-$per_page;
            $from   = $offset;
            $to     = $offset + $per_page;
        }
        else
        {
            $page   = 1;
            $offset = 0;
            $from   = 0;
            $to     = $per_page;
        }

        $data['from']       = $from;
        $data['to']         = $to;
        $data['currentPage']= $page;
        $data['lastPage']   = $total_pages;

        
        $company_sql = "SELECT companies.id, companies.*, add_industries.id as add_industries_id, add_industries.percent as percent, industries.name as i_name, addresses.address, addresses.city, subcategories.id as subcategory_id, subcategories.subcategory as subcategory_name  
        FROM companies 
        LEFT JOIN addresses ON addresses.company_id = companies.id 
        LEFT JOIN service_lines ON service_lines.company_id = companies.id 
        LEFT JOIN add_industries ON add_industries.company_id = companies.id 
        LEFT JOIN subcategories ON subcategories.id = service_lines.subcategory_id
        LEFT JOIN industries ON industries.id = add_industries.industry_id
        LEFT JOIN company_reviews ON company_reviews.company_id = companies.id " . $where . " AND companies.is_publish != 0 
        GROUP BY companies.id 
        LIMIT " . $per_page . " OFFSET " . $offset;


        
        $data['company'] = $company = DB::select( $company_sql ); 

        $data['company'] = array_values(array_unique($data['company'], SORT_REGULAR));

        $industry = AddIndustry::with('industry')->get();


        



        foreach ($data['company'] as $company) {
             $company->industries = $industry->where('company_id', $company->id)->pluck('industry');
          
        }

        return view( 'home.directory', $data );


    } 



    public function test1( Request $request, $ser = null, $loc = null )
    {


        $cat_id           = $this->getIdByCatName( $ser );

        $data['industry'] = Industry::pluck( 'name','id' )->all();
        
        $bud              = Budget::all();


        foreach ($bud as $value) {
            $b = explode('-', $value->budget);
            $minValue = intval(str_replace('$', '', $b[0])); // Extract and convert the minimum value to an integer
            $budget[$minValue] = $value;
        }
        

        ksort( $budget );
        $data[ 'budget' ] = $budget;
        $r = Rate::all();


        foreach ($r as $value) {
            $b = explode('-', $value->rate);
            $minValue = intval(str_replace('$', '', $b[0])); // Extract and convert the minimum value to an integer
            $rate[$minValue] = $value;
        }
    
        ksort($rate);



        
        $data['rate']           = $rate;

        $data['loc_dropdown']   = $this->getPreSelectedLocationDropdown( $cat_id );


        $data['locations']      = Address::where( 'addresses.address', '!=', '' )->groupBy( 'addresses.city' )->get();


        $data['main_slug']      = $ser;

       

        $data['subcategories']  = DB::table( 'subcategories' )->pluck( 'subcategory', 'id' )->all();


        $rate_review            = DB::select(
                                                "SELECT company_reviews.company_id, 
                                                COUNT(company_reviews.id) AS review, avg(overall_rating) as rating, position_title, most_impressive 
                                                FROM company_reviews GROUP BY company_reviews.company_id"
                                            );
       
        
        $rate = array();

        foreach( $rate_review as $val )
        {
            $rate[ $val->company_id ] = $val;
        }



        $data['rate_review'] = $rate;
        

        $service_line   = DB::select( "SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent , service_lines.subcategory FROM service_lines" );
        
        $service_lines  = array();




        foreach( $service_line as $val )
        {
            $service_lines[ $val->company_id ][] = $val;
        }



        $data['service_lines'] = $service_lines;

        
       

        $where = array();


        
        if (!empty($request->services)) {
            $filteredServices = array_filter($request->services, function ($value) {
                return !is_null($value);
            });
        
            if (!empty($filteredServices)) {
                $where[] = 'WHERE service_lines.subcategory_id IN (' . implode(',', $filteredServices) . ')';
            }
        }

        elseif( !empty( $ser ) )
        {
            $cat = DB::table('categories')
            ->join( 'subcategories', 'categories.id', '=', 'subcategories.category_id' )
            ->where( 'categories.category', str_replace( '-', ' ', $ser ) )
            ->orWhere( 'subcategories.subcategory', str_replace( '-', ' ', $ser ) )
            ->get( ['categories.id', 'subcategories.id as sid', 'subcategories.subcategory' ] );


            if( !empty( $cat ) )
            {
                
                foreach( $cat as $scat ) {
                    $_REQUEST['services'][] = $scat->sid;
                }

                $where[] = "WHERE service_lines.subcategory_id IN ( ".implode( ',', $_REQUEST['services'] ) . ")";

            }

        }
        
        if( !empty( $request->location ) )
        {
            // dd($request->location);
            $where[]= "addresses.city='".$request->location . "'";
        }
        

        elseif( !empty( $loc ) )
        {
            $_REQUEST['location']        = $loc;
            $where[] = "addresses.city   = '".$loc."'";
        }
        
        if( !empty( $request->budget ) )
        {
            $where[]= 'companies.budget = "'.$request->budget.'"';
        }

        /*if( !empty( $request->rates ) )
        {
           $where[]= 'companies.rate IN ( \''.implode('\',\'',$request->rates).'\')'; 
        }*/

        if( !empty( $request->rates[0] ) && count( $request->rates ) > 0 )
        {
            $where[]= 'companies.rate IN ( \''.implode('\',\'',$request->rates).'\')';
        }

        if( !empty( $request->industry ) )
        {
            $where[]= 'add_industries.industry_id IN ('.implode(',',$request->industry).')';
        }

        if( !empty( $request->reviews ) )
        {
            $where[]= '( SELECT COUNT(company_reviews.id) AS reviews GROUP BY company_reviews.company_id ) >= '.$request->reviews;
        }

        if( !empty( $request->rating ) )
        {
            $where[]= '( SELECT avg(company_reviews.overall_rating) AS rating GROUP BY company_reviews.company_id ) >= '.$request->rating;
        }

        

        $where = implode( ' AND ', $where );
        /************** pagination *********************/



        $total_record = DB::select(
                                    "SELECT count( DISTINCT(companies.id) ) as record FROM companies 
                                     LEFT JOIN addresses ON addresses.company_id = companies.id 
                                     LEFT JOIN service_lines ON service_lines.company_id = companies.id 
                                     LEFT JOIN add_industries ON add_industries.company_id = companies.id 
                                     LEFT JOIN company_reviews ON company_reviews.company_id = companies.id " . $where 
                                  );

        
        $data['totalRecord']                = $total_record[0]->record;
        $data['perPage']                    = $per_page = 10;
        $data['beforeOrAfterCurrentPage']   = 2;
        $data['totalPage']                  = $total_pages   = ceil( $data['totalRecord'] / $per_page );


        if( isset( $_REQUEST['page'] ) && !empty( $_REQUEST['page'] ) )
        {
            $page   = $_REQUEST['page'];
            $offset = ($page*$per_page)-$per_page;
            $from   = $offset;
            $to     = $offset + $per_page;
        }
        else
        {
            $page   = 1;
            $offset = 0;
            $from   = 0;
            $to     = $per_page;
        }

        $data['from']       = $from;
        $data['to']         = $to;
        $data['currentPage']= $page;
        $data['lastPage']   = $total_pages;

        

        $company_sql     = "SELECT DISTINCT(companies.id), companies.*, addresses.address, addresses.city FROM companies 
                                                    LEFT JOIN addresses ON addresses.company_id             = companies.id 
                                                    LEFT JOIN service_lines ON service_lines.company_id     = companies.id 
                                                    LEFT JOIN add_industries ON add_industries.company_id   = companies.id 
                                                    LEFT JOIN company_reviews ON company_reviews.company_id = companies.id ".$where." 
                                                    AND  companies.is_publish !=0 LIMIT ".$per_page." OFFSET ".$offset;
        
        $data['company'] = $company = DB::select( $company_sql ); 


        return view( 'directory1', $data );


    } 



    public function getCompany( Request $request )
    {
       

        $data['subcategories']  = $subcategories = DB::table( 'subcategories' )->pluck( 'subcategory', 'id' )->all();

        $rate_reviews           = DB::select( "SELECT company_reviews.company_id, COUNT(company_reviews.id) AS review, avg(overall_rating) as rating, position_title, most_impressive FROM company_reviews GROUP BY company_reviews.company_id" );

        $rate_review = array();

        foreach( $rate_reviews as $val )
        {
            $rate_review[ $val->company_id ] = $val;
        }

        $data['rate_review'] = $rate_review;

        $service_line = DB::select("SELECT service_lines.company_id, service_lines.subcategory_id, service_lines.percent FROM service_lines");
        
        $service_lines = array();

        foreach( $service_line as $val )
        {
            $service_lines[$val->company_id][] = $val;
        }

        $data['service_lines'] = $service_lines;        

        $where = array();

        if( !empty( $request->services[0] ) && count( $request->services ) > 0 )
        {
            $where[]= ' service_lines.subcategory_id IN ('.implode(',',$request->services).')';
        }

        if( !empty( $request->location ) )
        {
            $where[]= "addresses.city IN('".$request->location."')";
        }

        if( !empty( $request->budget ) )
        {
            $where[]= 'companies.budget = "'.$request->budget.'"';
        }

        if( !empty( $request->rates[0] ) && count( $request->rates ) > 0 ) 
        {
            $where[]= 'companies.rate IN (\''.implode('\',\'',$request->rates).'\')';
        }

        if( !empty( $request->industry[0] ) && count( $request->industry ) > 0 )
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

        
        $where     = count( $where ) > 0 ? ' WHERE ' . implode( ' AND ', $where ) : '';




        $sql_total = "SELECT count( DISTINCT( companies.id ) ) as record FROM companies 
                      LEFT JOIN addresses ON addresses.company_id           = companies.id 
                      LEFT JOIN service_lines ON service_lines.company_id   = companies.id 
                      LEFT JOIN add_industries ON add_industries.company_id = companies.id 
                      LEFT JOIN company_reviews ON company_reviews.company_id = companies.id " . $where;


        #die( print_r( [ $request->all(), $sql_total, $where ] ) );

        /**************pagination*********************/

        $total_record = DB::select( $sql_total );

        //dd($total_record);





        $data['totalRecord']                = $totalRecord              = $total_record[0]->record;
        $data['perPage']                    = $perPage                  = $per_page     = 10;
        $data['beforeOrAfterCurrentPage']   = $beforeOrAfterCurrentPage = 2;
        $data['totalPage']                  = $totalPage                = $total_pages  = ceil($data['totalRecord'] / $per_page);

        if( isset( $_REQUEST['page'] ) && !empty( $_REQUEST['page'] ) )
        {
            $page   = $_REQUEST['page'];
            $offset = ( $page * $per_page ) - $per_page;
            $from   = $offset;
            $to     = $offset + $per_page;
        }
        else
        {
            $page   = 1;
            $offset = 0;
            $from   = 0;
            $to     = $per_page;
        }

        $data['from']       = $from;
        $data['to']         = $to;
        $data['currentPage']= $currentPage  = $page;
        $data['lastPage']   = $lastPage     = $total_pages;

        /**************pagination*********************/


        $sql_get_comp = "SELECT DISTINCT( companies.id ), companies.*, addresses.address, addresses.city FROM companies 
                                 LEFT JOIN addresses ON addresses.company_id = companies.id 
                                 LEFT JOIN service_lines ON service_lines.company_id = addresses.company_id 
                                 LEFT JOIN add_industries ON add_industries.company_id = service_lines.company_id 
                                 LEFT JOIN company_reviews ON company_reviews.company_id = add_industries.company_id 
                                ".$where." LIMIT ".$per_page." OFFSET ".$offset; 


        //die( $sql_get_comp );

        $company        = DB::select( $sql_get_comp );     

        $html           = "";

        $totalList      = $company ? $totalRecord : 0;

        $subcatsdisplay = ( !empty( $request->services[0] ) && count( $request->services ) > 0 )  ? $subcategories[ $request->services[0] ] : '';


        $html .=  '<div class="firm-box d-lg-flex ">
                        <p class="mr-5">'.$totalList.' Firms</p>
                        <p>List of the Best ' .$subcatsdisplay. '  Firms</p>
                   </div>';

        foreach( $company as $key => $val )
        {


        $html .=  '<div class="graph-sec row border mx-0 py-4 px-3 align-items-center item'.$key.'">
                    
                    <div class="col-xl-2 col-lg-6 border-right verified-sec pb-3 pb-md-0">
                        <img src="'.url('storage/'.$val->logo).'" alt="" class="img-fluid ">';

                        
        if( $val->is_publish )
        { 
           $html .=  '<img src="'.asset('front_components/images/verified.png').'" alt="" class="img-fluid ">';
        }
        

        $bb   = explode('-',$val->budget);
        $bbb  = $bb[0].'+';

        if( !empty( $val->rate ) )
        {
            $rr = explode('-',$val->rate);
            $rrr = $rr[0].'-'.$rr[1];
        }
        else
        {
            $rrr = 'N/A ';
        }

        $html .=  '<div class="icon-box mt-4">';

            if( $val->budget )
            {
                $html  .=  '<p class="d-flex  align-items-center">
                                <img src="'. asset( 'front_components/images/verified-icon1.png'). '" alt=""> '. $bbb .'+
                            </p>';
            }

            if( $val->rate )
            {
                $html  .=  '<p class="d-flex  align-items-center">
                                <img src="' . asset('front_components/images/time.png') .'" alt=""> ' . $rrr .'/hr
                            </p>';
            }
            
            if( $val->size ) 
            {
                $html  .=  '<p class="d-flex  align-items-center">
                                <img src="' . asset('front_components/images/person.png').'" alt=""> '. $val->size .'
                            </p>';
            }
            

            if( $val->city )
            {
                $html  .=  '<p class="d-flex  align-items-center">
                                <img src="' . asset('front_components/images/location2.png') .'" alt="">' . $val->city .'
                            </p>';
            }

        $html  .=       '</div>
                    </div>';

        $html  .=  '<div class="col-xl-6 col-lg-6 pl-md-4 mt-md-0 mt-4">
                        <h3> '. $val->name . '</h3>
                        <p>  '. $val->tagline .'</p>';



        if( isset( $rate_review[$val->id] ) )
        {
            $html  .=  '<div class="reviews-row">';
            $html  .=  '    <h3> '. number_format( (float)$rate_review[$val->id]->rating, 1, ".", "" ) ?? "" .'</h3>';
            $html  .=  '        <div class="px-3">';
                                    
                                    for( $i=1; $i<=5; $i++ )
                                    {
                                        if( $i <= $rate_review[$val->id]->rating )
                                        {
                                           $html .=  '<i class="fa fa-star"></i>';
                                        }
                                        elseif( $rate_review[$val->id]->rating <= $i-1 )
                                        {

                                        }
                                        else
                                        {
                    
                                        }
                                    }
               
                $html  .=  '    </div>
                            <h3> ' .$rate_review[$val->id]->review . ' REVIEWS</h3>
                        </div>';
        }

        $html  .=  '<div class="links">
                        <a href="'. url( $val->website ) .'" target="_blank" class="">View Website</a>
                        <a href="'. url( 'profile/'.$val->id ) .'" target="_blank" class="">View Profile</a>
                        <a href="'. url( 'company-contact/'.$val->id ) .'" target="_blank" class="">Contact</a>
                    </div>
                </div>';

                $html .= '<div class="col-xl-4 pl-md-0 mt-xl-0 mt-5">';
                $html .= '<p>';
                $html .= '<div id="piechart' . $val->id . '"></div>';
                
                $t = 0;
                $data = [];
                $data[] = ['Services', 'Percent'];
                
                for ($i = 0; $i < count($service_lines[$val->id]); $i++) {
                    if ($service_lines[$val->id][$i]->percent > 0) {
                        $t = $t + $service_lines[$val->id][$i]->percent;
                        $data[$i + 1] = [
                            $subcategories[$service_lines[$val->id][$i]->subcategory_id],
                            (int)$service_lines[$val->id][$i]->percent
                        ];
                    }
                }
                
                if ($t < 100) {
                    $p = 100 - $t;
                    $data[$i + 1] = ['None', $p];
                }
                
                $data = json_encode($data);
                $html .= '</p>';
                $html .= '</div>';
                
                // JavaScript Section
                $html .= '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
                $html .= '<script type="text/javascript">';
                $html .= 'google.charts.load("current", {"packages":["corechart"]});';
                $html .= 'google.charts.setOnLoadCallback(drawChart' . $val->id . ');';
                
                $html .= 'function drawChart' . $val->id . '() {';
                $html .= 'var data = google.visualization.arrayToDataTable(' . $data . ');';
                $html .= 'var options = {"title":"Service Focus", "width":350, "height":250};';
                $html .= 'var chart = new google.visualization.PieChart(document.getElementById("piechart' . $val->id . '"));';
                $html .= 'chart.draw(data, options);';
                $html .= '}';
                $html .= '</script>';

        // <?php

        $html .= '              </p>
                            </div>
                        </div>';

                       
            }

    $html .='
        <nav aria-label="Page navigation example">
            <ul class="pagination">';

                $links       = "";
                $blankLast   = "";
                $blankFirst  = "";

                $request_uri    = explode( '?',$_SERVER['HTTP_REFERER'] );
                $request_uri    = $request_uri[0];
                $query_string   = $_SERVER['QUERY_STRING'];
                
                $query_str  = "";
                $prev_url   = url( $request_uri .'?page='.( $currentPage-1 ) );
                $next_url   = url( $request_uri .'?page='.( $currentPage+1 ) );

                if( !empty( $query_string ) )
                {
                    $query_string   = explode( '&', $query_string );
                    $del_val        = "page=".$currentPage."";
                    $query_string   = array_diff( $query_string, [ $del_val ] );

                    if( !empty( $query_string ) )
                    {
                        $query_str  = '&'.implode('&', $query_string);
                        $prev_url   = url( $request_uri.'?page='.( $currentPage-1 ) . $query_str );
                        $next_url   = url( $request_uri.'?page='.( $currentPage+1 ) . $query_str );
                    }
                }

                if( $currentPage == 1 )
                {
                    $tabindex       = ' tabindex="-1" ';
                    $aria_disabled  = ' aria-disabled="true" ';
                    $disabled       = ' disabled';
                }
                else
                {
                    $tabindex       = '';
                    $aria_disabled  = '';
                    $disabled       = '';
                }

                $html .='<li class="page-item '.$disabled.'"><a class="page-link" href="'.$prev_url.'" '.$tabindex.' '.$aria_disabled.' >Previous</a></li>';
                
                for ( $i = 1; $i <= $totalPage; $i++ ) 
                { 
                    if( $i == $currentPage )
                    { 
                        $active         = ' active ';
                        $aria_current   = ' aria-current="page" ';

                        if( $i == $lastPage )
                        { 
                            $tabindex       = ' tabindex="-1" ';
                            $aria_disabled  = ' aria-disabled="true" ';
                            $disabled       = 'disabled';
                        }

                        $html .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>'; 
                    }
                    else
                    {
                        $active         = '';
                        $aria_current   = '';
                        $tabindex       = '';
                        $aria_disabled  = '';
                        $disabled       = '';

                        if($i >= $currentPage-$beforeOrAfterCurrentPage || $i == 1)
                        {                            
                            if($i <= $currentPage+$beforeOrAfterCurrentPage || $i == $lastPage)
                            {
                                $html .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>';
                            }
                            else
                            {
                                if( $blankFirst == '' )
                                {
                                    $blankFirst = '...';
                                    $html      .= '...';
                                }
                            }
                        }
                        else
                        {
                            if( $blankLast == '' )
                            {
                                $blankLast = '...';
                                $html     .= '...';
                            }
                        }
                    }
                
                }

                $html .='<li class="page-item '.$disabled.'"><a class="page-link" href="'.$next_url.'" '.$tabindex.' '.$aria_disabled.' >Next</a></li>
            </ul>
        </nav>';

        echo $html; die();

        
    }

    public function getSearchList( Request $request )
    {
        $term       = explode( ' ', $request->term );
        $whereComp  = array();
        $whereComp1 = array();
        $whereCity  = array();
        $whereSub   = array();

        $whereCat   = array();

        foreach( $term as $t )
        {
            if( strlen( $t ) >= 3 )
            {
                $whereSub[]     = " subcategories.subcategory like '%".$t."%'";
                $whereCat[]     = " categories.category like '%".$t."%'";

                $whereCity[]    = " addresses.city like '%".$t."%'";
                $whereComp[]    = " companies.name like '%".$t."%'";
                $whereComp1[]   = " 'name', 'like', '%".$request->term."%'";
            }   
        }

        $whereC     = ' WHERE ('.implode(' OR ', $whereComp) . ' ) AND companies.is_publish != 0 ';
        $whereC1    = ' WHERE ('.implode(' )->orWhere( ', $whereComp1).')';
        $whereC2    = implode(' )->orWhere( ', $whereComp1);

        $whereS     = ' WHERE ' . implode(' OR ', $whereSub ) . ' OR ' .implode( ' OR ', $whereCat );
        $whereCI    = ' WHERE '.implode(' OR ', $whereCity);
        

        $data['sub']= DB::select( "SELECT subcategories.id, subcategories.subcategory FROM subcategories 
                                   LEFT JOIN categories  on categories.id = subcategories.category_id " . $whereS );

                            
        
        
        $subc       = array();
        
        if(count($data['sub']) > 0)
        {
            foreach($data['sub'] as $sub)
            {
                $subc[] = $sub->subcategory;
            }

            $subc = " WHERE subcategories.subcategory IN ( '".implode('\',\'', $subc)."') ";
        }
        else
        {
            $subc = "";
        }
        
        $data['city']   = DB::select("SELECT addresses.company_id,addresses.city FROM addresses ".$whereCI." GROUP BY addresses.city");
        $city           = array();


        if( count( $data['city'] ) > 0 )
        {
            foreach($data['city'] as $add)
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

        if( !empty( $subc ) || !empty( $city ))
        {
            $data['subcategory'] = DB::select("SELECT subcategories.id,subcategories.subcategory,addresses.city,addresses.state_iso2 FROM subcategories INNER JOIN service_lines ON service_lines.subcategory_id = subcategories.id INNER JOIN addresses ON addresses.company_id = service_lines.company_id  ".$subc .$city." GROUP BY service_lines.subcategory_id" );
        }
        else
        {
            $data['subcategory'] = array();
        }

        $data['company'] = DB::select("SELECT companies.id,companies.name,companies.logo FROM companies ".$whereC);

        $rate_review = DB::select("SELECT company_reviews.company_id, avg(overall_rating) as rating FROM company_reviews GROUP BY company_reviews.company_id");

        $rate = array();

        foreach($rate_review as $val)
        {
            $rate[$val->company_id] = $val;
        }

        $data['rate_review'] = $rate;


        $query = Seo::query();

        

        if ($request->term) {
            $query->where('name', 'LIKE', "%$request->term%");
        }

        $topSeoCompanies = $query->orderBy('usage_count', 'desc')->take(2)->get();




        $html = "";

        $subcat_loc = "";
        $state_iso2 = "";
        $html .= '
        <div class="search_results__row top_companies">';
            if(count($data['subcategory']) > 0){
                $html .= '
                <div class="search_results__title"><strong>Top Companies</strong></div>
                <ul class="search_results__content">';
                foreach($data['subcategory'] as $subcat){
                    if(!empty($data['city'])){$subcat_loc = " in ".ucfirst($subcat->city);$state_iso2 = '&location[]='.$subcat->state_iso2;}
                    /*$html .= '
                    <li style="list-style:none;"><a style="text-decoration:none;" href="'.url('directory',[strtolower(str_replace(' ','-',$subcat->subcategory)),strtolower($subcat->city)]).'">Top <strong>'.ucfirst($subcat->subcategory).'</strong> Companies '.$subcat_loc.'</a></li>';*/
                    $html .= '
                    <li style="list-style:none;"><a style="text-decoration:none;" href="'.url('directory',[strtolower(str_replace(' ','-',$subcat->subcategory))]).'">Top <strong>'.ucfirst($subcat->subcategory).'</strong> Companies '.$subcat_loc.'</a></li>';
                }
                $html .= '</ul>';
            }
 
                $html .= '<div class="search_results__title"><strong>Top SEO Companies</strong></div>
                <ul class="search_results__content">';
                foreach ($topSeoCompanies as $seoCompany) {
                    $html .= '<li style="list-style:none;">
                        <a style="text-decoration:none;" href="' . url('profile/' . $seoCompany->id) . '"><img src="' . asset('storage/' . $seoCompany->logo) . '" width="20px" height="20px"> &nbsp;<strong>' . $seoCompany->name . '</strong></a>
                    </li>';
                }
                $html .= '</ul>';



            $company_loc = "";
            if( count( $data['company'] ) > 0 )
            {
                $html .= '
                <div class="search_results__title"><strong>Profiles</strong></div>
                <ul class="search_results__content">';
                foreach($data['company'] as $company){
                    //if(!empty($data['city'])){$company_loc = " ".ucfirst($company->city);}
                    if(isset($data['rate_review'][$company->id])){
                        $rt = number_format((float)$data['rate_review'][$company->id]->rating, 1, '.', '').' <img src="'.asset('front_components/images/red.png').'" width="15px;">';
                    }else{
                        $rt = '0.0  <img src="'.asset('front_components/images/red.png').'" width="15px;">'; 
                    }
                    $html .= '
                    <li style="list-style:none;">
                        <a style="text-decoration:none;" href="'.url('profile/'.$company->id).'"><img src="'.asset('storage/'.$company->logo).'" width="20px" height="20px"> &nbsp;<strong>'.$company->name.'</strong> '.$company_loc.'</a>
                        <span style="float:right;">'.$rt.' </span>
                    </li>';
                }       
                $html .= '</ul>';
            }

            $html .= '
        </div>';

        echo $html; die(); 
    }  
        public function Seosearch(){
            return view('search.index');
        }

    public function companyProfile( Request $request, $company_id )
    {
        $data  = array();
        $focus = array();
       


        $data['company'] = Company::where('id', $company_id)->first();

        if (!$data['company']) {
            $cleaned_company_id = str_replace('-', ' ', $company_id);
            $data['company'] = Company::where('name', 'like', '%' . $cleaned_company_id . '%')->first();
            $company_id =   $data['company']->id;
        }
                    

        $data['rate_review'] = DB::table('company_reviews')
                                ->select('company_id','position_title','most_impressive','project_title')
                                ->selectRaw('count(id) as review')
                                ->selectRaw('avg(overall_rating) as rating')
                                ->where('company_id',$company_id)
                                ->first();

        $data['review']         = CompanyReview::where( 'company_id', $company_id )->get();
        $data['service_lines']  = ServiceLine::where( 'company_id', $company_id )->get();
        $data['add_industry']   = AddIndustry::where( 'company_id', $company_id )->get();
        $data['add_client_size']= AddClientSize::where( 'company_id', $company_id )->get();
        $data['add_focus']      = AddFocus::where( 'company_id', $company_id )->get();
        $data['addresses']      = Address::where( 'company_id', $company_id )->get();
        $data['projects']      = CompanyHasProject::where( 'company_id', $company_id )->get();
        foreach( $data['add_focus'] as $add_focus )
        {
            $focus[$add_focus->subcategory_id][] = $add_focus;
        }
        $data['add_focus'] = $focus;
        return view( 'home.companyProfile', $data );
    }


    public function review( Request $request, $company_id )
    {
        $data  = array();
        $focus = array();


        $data['company'] = Company::where('id', $company_id)->first();

        // if (!$data['company']) {
        //     $cleaned_company_id = str_replace('-', ' ', $company_id);
        //     $data['company'] = Company::where('name', 'like', '%' . $cleaned_company_id . '%')->first();
        //     $company_id =   $data['company']->id;
        // }
        if (!$data['company']) {
            $cleaned_company_id = str_replace('-', ' ', $company_id);
            $data['company'] = Company::where('name', 'like', '%' . $cleaned_company_id . '%')->first();
           
        
           
            if ($data['company']) {
                $company_id = $data['company']->id;
              
            } else {
               
                 $company_id = 0; // or any default value
              
            }
        }
                    

        $data['rate_review'] = DB::table('company_reviews')
                                ->select('company_id','position_title','most_impressive','project_title')
                                ->selectRaw('count(id) as review')
                                ->selectRaw('avg(overall_rating) as rating')
                                ->where('company_id',$company_id)
                                ->first();


       
                                // dd($company_id);

        $data['review']         = CompanyReview::where( 'company_id', $company_id )->get();
        $data['service_lines']  = ServiceLine::where( 'company_id', $company_id )->get();
        $data['add_industry']   = AddIndustry::where( 'company_id', $company_id )->get();
        $data['add_client_size']= AddClientSize::where( 'company_id', $company_id )->get();
        $data['add_focus']      = AddFocus::where( 'company_id', $company_id )->get();
        $data['addresses']      = Address::where( 'company_id', $company_id )->get();
        $data['projects']      = CompanyHasProject::where( 'company_id', $company_id )->get();
        foreach( $data['add_focus'] as $add_focus )
        {
            $focus[$add_focus->subcategory_id][] = $add_focus;
        }
        $data['add_focus'] = $focus;
        return view( 'home.review', $data );
    }

    public function test( Request $request, $company )
    {
        // dd($company);

        $comp           = Company::where('id', $company)->first();
        $category       = Category::all();
        $serviceLine    = ServiceLine::where('company_id', $company)->get();
        // DD($serviceLine);

        foreach( $serviceLine as $value ) 
        {
            if( $value->percent > 10 )
            {
                $subcat[] = $value->subcategory_id;
            }
        } 
        
        $subcat_children = SubcatChild::all();
        $subcat_child    = array();
        
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
        return view( 'home.user.focus', [
                                            'category'          => $category,
                                            'company'           => $comp,
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
                                        ] );
        return view( 'home.test',  );
    }

    public function get_searched_city_select2( Request $request )
    {

        if( !empty( $request->search ) )
        {
            $city = filter_var( $request->search, FILTER_SANITIZE_STRING );

             $sql = 'SELECT ad.city as city, count(c.id) as count FROM `addresses` ad 
                     LEFT JOIN companies c ON c.id = ad.company_id 
                     WHERE ad.city LIKE "%{$request->search}%"" AND ad.city IS NOT NULL AND c.is_publish = 1 GROUP BY city ORDER BY count DESC';

            $d_sql= 'SELECT ad.city as city, count(c.id) as count FROM `addresses` ad 
                     LEFT JOIN companies c ON c.id = ad.company_id 
                     WHERE ad.city LIKE "%'. $city .'%" AND ad.city IS NOT NULL /*AND c.is_publish = 1*/ GROUP BY city ORDER BY count DESC';
             $result = DB::select( $d_sql );

             if( count( $result ) > 0 )
             {
                
                $json = array();

                foreach( $result as $key => $city )
                {
                    $json[$key]['id']       = $city->city;
                    $json[$key]['text']     = $city->city .' (' . $city->count . ')';
                }

                return die( json_encode( [ 'results' => $json  ] ) );

             }
             else
             {
                return die( json_encode( [ 'results' => array() ] ) );
             }
        }
        else
        {
            return die( json_encode( [ 'results' => array() ] ) );
        }
    }
}


