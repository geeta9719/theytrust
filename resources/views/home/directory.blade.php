@extends('layouts.home-master')
@section('content')
<?php 
$reviews = array( 1, 3, 5, 10, 15, 20 );
$ratings = array( 1, 2, 3, 4, 5 );
if( isset( $_REQUEST['location'] ) && !empty( $_REQUEST['location'] ) )
{
	$loc 	= $_REQUEST['location'];
	$place 	= strtolower( $loc );
}
else
{
	$loc 	= '';
	$place 	= '';
}
if (isset($_REQUEST['services']) && is_array($_REQUEST['services']) && !($_REQUEST['services'][0] === ""))
{
	$subcat = $_REQUEST['services'];
	$slug 	= strtolower( str_replace( ' ', '-', $subcategories[ $subcat[0] ] ) );
}
else
{
	$subcat = array();
	$slug 	= '';
}
$bud 	= isset( $_REQUEST['budget'] ) 	? $_REQUEST['budget'] 	: '';
$rev 	= isset( $_REQUEST['reviews'] ) ? $_REQUEST['reviews'] 	: '';
$rat 	= isset( $_REQUEST['rating'] ) 	? $_REQUEST['rating'] 	: '';
$rates  = isset( $_REQUEST['rates'] ) 	? $_REQUEST['rates'] 	: array();
$ind 	= isset( $_REQUEST['industry'] )? $_REQUEST['industry'] : array();
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>.graph-sec .col-xl-5:last-child{
    z-index: -1;
    position: relative;

}
.graph-sec .col-xl-5:last-child{
    left: -66px;
}
.verified-sec .veri{
    margin: auto;
    padding-top: 10px;
}
.alert-success {

    width: 36%!important;
    margin: auto auto 10px 23%!important;
    text-align: center;}
    .select2-container--default .select2-selection--multiple{
        width: 229px;
        margin-left: 2px;
    }
@media (max-width: 650px){
    .alert-success {
        font-size: 13px;
     width: 100%!important; 
    margin: auto auto 10px auto!important;
}
    .graph-sec .col-xl-5:last-child {
    z-index: -1;
    position: relative;
    left: -92px;
}

}




</style>
<!--  section start -->
<section class="container-fluid list-top">
    <div class=" container">
        <a href="">Home | Directory</a>
        <h2>Top <?php if(!empty($_REQUEST['services'][0])){ echo $subcategories[$subcat[0]];} ?> Companies</h2>
    </div>
</section>

<section class="container-fluid mt-5 mb-5 list-box">
    <div class=" container">
        <div class="row">
            <div class="col-lg-3 col-md-5  pr-md-5">
                <a href="">Clear All</a>

                <form id="form2" action="{{ url('directory',[$slug, $place]) }}" method="POST">
                    @csrf
                    <input type="hidden" id="sub" name="services[]" value="<?php if(!empty($_REQUEST['services'][0])){echo $subcat[0];} ?>">
                    <input type="hidden" id="loc" name="location" value="<?php if(!empty($_REQUEST['location'])){echo $loc;} ?>">
                </form>

                <form class="filter-directory" id="form1">

                <div class="filter-box mt-2">
                    <div class="dropbox">

                        <div class="dropinner">
                            <select id="location" class="location-filter form-control" name="location" onchange="searchCompany()">
                                <option value="">Select Location</option>
                                @foreach( $loc_dropdown as $loc_drp  )
                                    @if( !empty( $loc_drp->city ) )
                                        <option value="{{ $loc_drp->city }}">{{ $loc_drp->city }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="dropinner">
                            <select id="services" name="services[]" multiple="multiple" onchange="searchCompany()">
                                <option value="">Select Services</option>
                                @foreach( $subcategories as $key => $subcategoy )
                                @if( in_array( $key, $subcat ) )
                                <option <?php if(isset($subcat) && in_array($key, $subcat)){echo 'selected';}?> value="{{$key}}">{{$subcategoy}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="dropinner">
                            <select class="form-control dropdown1" id="chk_budget" name="budget" onchange="searchCompany()">
                                <option value="">Client Budget</option>
                                @foreach($budget as $b)
                                    <?php 
                                        $bb     = explode( '-', $b['budget'] );
                                        $budd   =  $bb[0] . ' - $' . $bb[1];
                                    ?>
                                    <option <?php if(isset($bud) && $bud == $b['budget']){echo 'selected';} ?> value="{{$b['budget']}}"> {{$budd}} </option>
                                @endforeach 
                            </select>
                        </div>

                        <div class="dropinner">
                            <select class="form-control dropdown1" id="rates" name="rates[]" onchange="searchCompany()">
                                <option value="">Hourly Rate</option>
                                @foreach( $rate as $b )
                                <?php 
                                $bb = explode('-',$b['rate']);
                                $rr = $bb[0].' - $'.$bb[1];
                                ?>
                                <option <?php if(isset($rates) && in_array($b['rate'], $rates) ) { echo 'checked'; } ?> value="{{$b['rate']}}"> {{$rr}} </option>
                                
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="dropinner">
                            <select class="form-control dropdown1" id="industry" multiple="multiple" name="industry[]" onchange="searchCompany()">
                                <option value="">Industry</option>
                                @foreach( $industry as $key => $indust )
                                <option <?php if(isset($ind) && in_array($key, $ind)){echo 'checked';}?> value="{{$key}}"> {{$indust}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="dropinner">
                            <select class="form-control dropdown1" id="reviews" name="reviews" onchange="searchCompany()">
                                <option value="">Reviews</option>
                                @foreach( $reviews as $key => $review )
                                <option <?php if( isset( $rev ) && $rev == $review ) { echo 'checked'; } ?> value="{{$review}}"> {{$review}}+ </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="dropinner">
                            <select class="form-control dropdown1" id="ratings" name="rating" onchange="searchCompany()">
                                <option value="">Ratings</option>
                                
                                @foreach($ratings as $key=>$rating)
                                <option <?php if(isset($rat) && $rat == $rating){echo 'checked';}?> value="{{$rating}}">{{$rating}} 
                                    <span style="color:#ff3b00f2;font-size:35px;font-weight:bolder;padding-top:2px;"> 
                                        <img src="{{asset('front_components/images/red.png')}}" width="15px;" /> </span>
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                </form>
            </div>



            <div class="col-lg-9 col-md-7 firm-sec pl-md-4" id="addCompanyList">

                <div class="firm-box d-lg-flex ">
                    <p class="mr-5">@if($company) {{ $totalRecord }} @else {{0}} @endif Firms</p>
                    <p>List of the Best @if (isset($subcat[0]) && isset($subcategories[$subcat[0]]))
    {{ $subcategories[$subcat[0]] }}
@endif Firms</p>
                </div>

                @if( $company )
                    
                @foreach( $company as $key => $cmp )

                <div class="graph-sec row border mx-0 py-4 px-3 align-items-center item{{$key}}">
                    
                    <div class="col-xl-2 col-lg-6 border-right verified-sec pb-3 pb-md-0">
                        <img src="{{ url('storage/'.$cmp->logo) }}" alt="" class="img-fluid ">
                        
                        @if( $cmp->is_publish ) 
                            <img src="{{asset('front_components/images/verified.png')}}" alt="" class="img-fluid veri">
                        @endif


                        <?php
                            $bb   = explode('-',$cmp->budget);
                            $bbb  = '$'.$bb[0].'+';

                            if( !empty( $cmp->rate ) )
                            {
                                $rr = explode('-',$cmp->rate);
                                $rrr = '$'.$rr[0].'-$'.$rr[1];
                            }
                            else
                            {
                                $rrr = 'N/A ';
                            }
                        ?>
                        
                        <div class="icon-box mt-4">

                            @if( $cmp->budget )
                                <p class="d-flex  align-items-center">
                                    <img src="{{asset('front_components/images/verified-icon1.png')}}" alt=""> {{ $bbb }}
                                </p>
                            @endif

                            @if( $cmp->rate )
                                <p class="d-flex  align-items-center">
                                    <img src="{{asset('front_components/images/time.png')}}" alt=""> {{ $rrr }}/hr
                                </p>
                            @endif
                            
                            @if( $cmp->size ) 
                                <p class="d-flex  align-items-center">
                                    <img src="{{asset('front_components/images/person.png')}}" alt=""> {{ $cmp->size }}
                                </p>
                            @endif

                            @if( $cmp->city )
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/location2.png')}}" alt=""> {{ $cmp->city }}
                            </p>
                            @endif
                        </div>
                    </div>


                    <div class="col-xl-5 col-lg-6 pl-md-4 mt-md-0 mt-4">
                        <h3>{{ $cmp->name }}</h3>
                        <p>{{ $cmp->tagline }}</p>
                        

                        @if(isset($rate_review[$cmp->id]))

                        <div class="reviews-row">
                            <h3>{{ number_format((float)$rate_review[$cmp->id]->rating, 1, '.', '') ?? '' }}</h3>
                            <div class="px-3">
                                <?php
                                for( $i=1; $i<=5; $i++ )
                                {
                                    if( $i <= $rate_review[$cmp->id]->rating )
                                    {
                                    ?>
                                        <i class="fa fa-star bluestar"></i>
                                    <?php
                                    }
                                    elseif( $rate_review[$cmp->id]->rating <= $i-1 )
                                    {
                                    ?>
                                        <i class="fa fa-star-o bluestar"></i>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <i class="fa fa-star-half-o bluestar"></i>
                                    <?php
                                    }
                                }
                                ?>
                                    
                            </div>
                            @isset($cmp->id)
                            <a href="{{ url('profile/'.$cmp->id) }}#reviewsec" target="_blank" class=""> <h3>{{$rate_review[$cmp->id]->review}} REVIEWS</h3> </a>
                            @endisset
                        </div>

                        @endif

                        <div class="links">
                        @php
    $urlParts = explode('/', request()->path());
    $parentCategoryName = end($urlParts);
@endphp

<a href="{{ url($cmp->website) }}?utm_source=theythustus.co&utm_medium=referral&utm_campaign={{ $parentCategoryName }}" target="_blank" class=""><i class="fa fa-globe mr-1" aria-hidden="true"></i> View Website</a>


                            <a href="{{ url('profile/' . str_replace('+', '-', html_entity_decode(urlencode($cmp->name)))) }}" target="_blank" class="">
    <i class="fa fa-user mr-1" aria-hidden="true"></i> View Profile
</a>                            
                            <a href="{{ url( 'company-contact/'.$cmp->id ) }}" target="_blank" class=""><i class="fa fa-phone mr-1" aria-hidden="true"></i> Contact</a>
                        </div>
                    </div>
                    
                    <div class="col-xl-5  pl-md-0 mt-xl-0 mt-5">
                        
                        <p>
                            <?php $t = 0; ?>
                                
                            <div id="piechart{{ $cmp->id }}"></div>

                            <?php   
                                $data       = array();
                                $data[0]    = array( 'Services', 'Percent' );

                                for( $i = 0;$i < count( $service_lines[ $cmp->id ] ); $i++ )
                                {                                   
                                    if( $service_lines[$cmp->id][$i]->percent > 0 )
                                    {
                                        $t          = $t + $service_lines[$cmp->id][$i]->percent;
                                        $data[$i+1] = array( $subcategories[ $service_lines[ $cmp->id ][$i]->subcategory_id ], (int)$service_lines[ $cmp->id ][$i]->percent );
                                    }   
                                }

                                if( $t < 100 )
                                {
                                    $p = 100-$t;
                                    $data[$i+1] = array("None",$p);
                                }
                                
                                $data = json_encode( $data );

                            ?>
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                <script type="text/javascript">
                                
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                
                                function drawChart() 
                                {
                                    var data    = google.visualization.arrayToDataTable( <?php echo $data; ?> );
                                    var options = { 'title' : 'Service Focus', 'width' : 450, 'height' : 250 };
                                    var chart   = new google.visualization.PieChart( document.getElementById( "piechart<?php echo $cmp->id; ?>" ) );
                                    chart.draw( data, options );
                                }
                                </script>
                            </p>

                    </div>
                </div>

                @endforeach
                
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                
                <?php

                    $links      = "";
                    $blankLast  = "";
                    $blankFirst = "";



                    $request_uri  = url()->current();
                    $query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'default_value';

                    
                    $query_str  = "";
                    $prev_url   = url( $request_uri . '?page=' . ( $currentPage - 1 ) );
                    $next_url   = url( $request_uri . '?page=' . ( $currentPage + 1 ) );

                    if( !empty( $query_string ) )
                    {
                        $query_string   = explode( '&', $query_string );
                        $del_val        = "page=" . $currentPage . "";
                        $query_string   = array_diff( $query_string, [ $del_val ] );
                        
                        if( !empty( $query_string ) )
                        {
                            $query_str = '&'.implode( '&', $query_string );
                            $prev_url = url( $request_uri .'?page=' . ( $currentPage -1 ) . $query_str );
                            $next_url = url( $request_uri .'?page=' . ( $currentPage +1 ) . $query_str );
                        }
                    }

                    if( $currentPage == 1 )
                    {
                        $tabindex       = ' tabindex="-1" ';
                        $aria_disabled  = ' aria-disabled="true" ';
                        $disabled       = 'disabled';
                    }
                    else
                    {
                        $tabindex       = '';
                        $aria_disabled  = '';
                        $disabled       = '';
                    }

                    $links .= '<li class="page-item '.$disabled.'"><a class="page-link" href="'.$prev_url.'" '.$tabindex.' '.$aria_disabled.'>Previous</a></li>';
                    ?>

                    <?php

                    for ( $i=1; $i <= $totalPage; $i++ ) 
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

                            $links .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url( $request_uri . '?page=' . $i . $query_str ) . '">'.$i .'</a></li>';   
                        }
                        else
                        {
                            $active         = '';
                            $aria_current   = '';
                            $tabindex       = '';
                            $aria_disabled  = '';
                            $disabled       = '';

                            if( $i >= $currentPage-$beforeOrAfterCurrentPage || $i == 1 )
                            {                           
                                if( $i <= $currentPage+$beforeOrAfterCurrentPage || $i == $lastPage )
                                {
                                    $links .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>';
                                }
                                else
                                {
                                    if( $blankFirst == '' )
                                    {
                                        $blankFirst  = '...';
                                        $links      .= '...';
                                    }
                                }
                            }
                            else
                            {
                                if($blankLast == '')
                                {
                                    $blankLast = '...';
                                    $links    .= '...';
                                }
                            }           
                        }
                    }   

                    $links .= '<li class="page-item '.$disabled.'"><a class="page-link" href="'.$next_url.'" '.$tabindex.' '.$aria_disabled.'>Next</a></li>';
                    ?>
                
                    <?php echo $links; ?>
                </ul>
            </nav> 
            
            @else
                <div class="row" ><div style="margin: 0 auto;">No Match Found</div></div>            
            @endif

            </div>
        </div>
</section>
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $('#services').select2({
        placeholder: 'Services'
    });
</script>
<script type="text/javascript">
    $('#industry').select2({
        placeholder: 'Industries'
    });
</script>
<script type="text/javascript">
    $('.location-filter').select2({
        minimumInputLength : 3,
        placeholder: 'Location',
        allowClear: true,
        ajax: {
            url: '{{ route('select2-cities') }}',
            dataType: 'json',
            data: function (params) {
              var query = { search: params.term, _token: '{{csrf_token()}}'}
              return query;
            },
            processResults: function (res) 
            {
              return { results: res.results };
            }
        }
});
</script>

<script>
    var searchCompany;
    var clearAll;
    $(document).ready(function(){

        searchCompany = function(){
            var t = "<?=$main_slug;?>";
            //alert(t);
            var ser = $("#form1").serialize();
            var loc = $('.location-filter').val();

            loc = loc ? loc.toLowerCase() : loc;

            jQuery.ajax({
                url:"{{url('get-company-list')}}",
                type: "GET",
                data: ser,
                //dataType : 'json',
                success: function(result)
                {
                    $("#addCompanyList").html( result );
                    window.history.replaceState( "", "", "{{url('directory')}}/"+t+"/"+loc+"?page=1&"+ser );
                }
            });
        }
        clearAll = function()
        {
            $(".location-filter").select2( "val", "" );
            $("input").val('');
        }   
    });

</script>
@endsection