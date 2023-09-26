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

if( isset( $_REQUEST['services'] ) )
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

$rates 	= isset( $_REQUEST['rates'] ) 	? $_REQUEST['rates'] 	: array();

$ind 	= isset( $_REQUEST['industry'] )? $_REQUEST['industry'] : array();

?>

<style type="text/css">
	.serchbtn{padding: 6px 15px !important;}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 mx-auto text-center">
                    <!--<h2>EDIT PROFILE</h2>-->
                    <h3>Top <?php if(!empty($_REQUEST['services'][0])){ echo $subcategories[$subcat[0]];} ?> Companies</h3>
                    <!--<p>Company Company Company Company Company Company</p>-->
                </div>
            </div>
        </div>
    </div>
</section>

<form id="form2" action="{{ url('directory',[$slug, $place]) }}" method="POST">
	@csrf
	<input type="hidden" id="sub" name="services[]" value="<?php if(!empty($_REQUEST['services'][0])){echo $subcat[0];} ?>">
	<input type="hidden" id="loc" name="location" value="<?php if(!empty($_REQUEST['location'])){echo $loc;} ?>">
</form>

<section class="searchbox container">
	<form id="form1" method="get" action="" class=""><!--was-validated-->
	    <div class="row pr-5">
	        <div class="col-md-12"><!-- <h3>My Profile</h3> --></div>
	        <div class=" navbar-collapse" id="">
	            <ul class="">

	            	
					<li class="nav-item dropdown" style="border:1px solid gray; width: 10%;display: inline-block;padding: 2px;">
	                   
	                    <!-- <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Location</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	
	                    	@foreach($locations as $location)
								<span class="dropdown-item" href="#" for="location{{$location->id}}" >
									<input type="checkbox" id="location{{$location->id}}" name="location[]" onchange="searchCompany()" <?php //if(isset($loc) && in_array(strtolower($location->city), $loc)){echo 'checked';}?> value="{{$location->city}}"> {{$location->city}}, {{$location->country->name}}
								</span>
							@endforeach 

	                    </div>-->

	                    <select id="location{{$location->id}}" class="location-filter form-control" name="location" onchange="searchCompany()">
		               		@foreach( $loc_dropdown as $loc_drp  )
		               			@if( !empty( $loc_drp->city ) )
		               				<option value="{{ $loc_drp->city }}">{{ $loc_drp->city }}</option>
		               			@endif
		               		@endforeach
	               		</select>

	                </li>			

	            

	                <li class="nav-item dropdown" style="border:1px solid gray; width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Services</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach( $subcategories as $key => $subcategoy )
							<span class="dropdown-item" href="#" for="services{{$key}}" >
								<input type="checkbox" id="services{{$key}}" name="services[]" onchange="searchCompany()" <?php if(isset($subcat) && in_array($key, $subcat)){echo 'checked';}else {echo 'disabled="disabled"'; }?> value="{{$key}}"> {{$subcategoy}}
							</span>
							@endforeach
	                    </div>
	                </li>

	                <li class="nav-item dropdown" style="border:1px solid gray;width: 12%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding:5px 5px!important;">Client Budget</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($budget as $b)
                                <?php 
                                $bb = explode('-',$b['budget']);
                                $budd = '$'.$bb[0].' - $'.$bb[1];
                                ?>
								<span class="dropdown-item" href="#" for="chk_budget{{$b['budget']}}" >
									<input type="radio" id="chk_budget{{$b['budget']}}" name="budget" onchange="searchCompany()" <?php if(isset($bud) && $bud == $b['budget']){echo 'checked';}?> value="{{$b['budget']}}"> {{$budd}}
								</span>
							@endforeach
	                    </div>
	                </li>

	                <li class="nav-item dropdown" style="border:1px solid gray;width: 12%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Hourly Rate</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach( $rates as $b )
                                <?php 
                                $bb = explode('-',$b['rate']);
                                $rr = '$'.$bb[0].' - $'.$bb[1];
                                ?>
								<span class="dropdown-item" href="#" for="rates{{$b['rate']}}" >
									<input type="checkbox" id="rates{{$b['rate']}}" name="rates[]" onchange="searchCompany()" <?php if(isset($rates) && in_array($b['rate'], $rates) ) { echo 'checked'; } ?> value="{{$b['rate']}}"> {{$rr}}
								</span>
							@endforeach
	                    </div>
	                </li>
	                <li class="nav-item dropdown" style="border:1px solid gray;width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding:5px 5px!important;">Industry</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($industry as $key=>$indust)
							<span class="dropdown-item" href="#" for="industry{{$key}}" >
								<input type="checkbox" id="industry{{$key}}" name="industry[]" onchange="searchCompany()"<?php if(isset($ind) && in_array($key, $ind)){echo 'checked';}?> value="{{$key}}"> {{$indust}}
							</span>
							@endforeach
	                    </div>
	                </li>
	                <li class="nav-item dropdown" style="border:1px solid gray;width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Reviews</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	<span class="dropdown-item" for="ratings0" ><input type="radio" id="reviews0" name="reviews" onchange="searchCompany()" checked value=""> All Companies</span>
	                    	@foreach($reviews as $key=>$review)
							<span class="dropdown-item" href="#" for="reviews{{$review}}" >
								<input type="radio" id="reviews{{$review}}" name="reviews" onchange="searchCompany()" <?php if(isset($rev) && $rev == $review){echo 'checked';}?> value="{{$review}}"> {{$review}}+
							</span>
							@endforeach
	                    </div>
	                </li>
	                <li class="nav-item dropdown" style="border:1px solid gray;width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding:5px 5px!important;">Rating</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	<span class="dropdown-item" for="ratings0" ><input type="radio" id="ratings0" name="rating" onchange="searchCompany()" checked value=""> All Companies</span>
	                    	@foreach($ratings as $key=>$rating)
							<span class="dropdown-item" for="ratings{{$rating}}" >
								<input type="radio" id="ratings{{$rating}}" name="rating" onchange="searchCompany()" <?php if(isset($rat) && $rat == $rating){echo 'checked';}?> value="{{$rating}}"> {{$rating}} <span style="color:#ff3b00f2;font-size:35px;font-weight:bolder;padding-top:2px;"> <img src="{{asset('front_components/images/red.png')}}" width="15px;"> </span>
							</span>
							@endforeach
	                    </div>
	                </li>
	                <a href="javascript:void(0)" onclick="clearAll()" style="text-decoration: none;" class="serchbtn ">Clear All</a>
	            </ul>
	        </div>
	    </div>
    </form>	

    <div class="" id="addCompanyList">
    	<div class="col-md-12 pr-5">
	        <h5><!--count($company)-->
	        	<span class="totalList serchbtn">@if($company) {{ $totalRecord }} @else {{0}} @endif Firms</span> List of the Best {{$subcategories[$subcat[0]]}} Firms
	        </h5>
	    </div>
		@if($company)
			@foreach($company as $key=>$cmp)
			<div class="row  ml-0 mr-0 mt-3 searchresult item{{$key}}" style="border: 1px solid gray;">
		        <div class="col-md-10 recordbox">
		            <div class="row pt-3 ml-0 mr-0 pr-2">
		                <div class="col-md-2 ">
		                	<img src="{{ url('storage/'.$cmp->logo) }}" style="width:70%;height: 70%;" alt="">
		                </div>
		                <div class="col-md-5 ">
		                    <h3> {{ $cmp->name }}</h3>
		                    <p>
		                    	@if(isset($rate_review[$cmp->id]))
		                    	<span style="font-weight:bolder ;">{{number_format((float)$rate_review[$cmp->id]->rating, 1, '.', '') ?? ''}}</span>
		                    	<?php
		                    	for($i=1;$i<=5;$i++){
		                    		if($i <= $rate_review[$cmp->id]->rating){
		                    			?>
		                    			<span style="color: #ff3b00f2;font-size:35px;font-weight:bolder ;padding-top: 10px;">
		                    				<img src="{{asset('front_components/images/red.png')}}" width="15px;">
		                    			</span>
		                    			<?php
		                    		}elseif($rate_review[$cmp->id]->rating <= $i-1){
		                    			?>
		                    			<span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
		                    				<img src="{{asset('front_components/images/comb2.png')}}" width="15px;">
		                    			</span>
		                    			<?php
		                    		}else{?>
		                    			<span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
		                    				<img src="{{asset('front_components/images/red-half.png')}}" width="15px;">
		                    			</span>
		                    			<?php
		                    		}
		                    	}
		                    	?>
		                     	<span>{{$rate_review[$cmp->id]->review}} REVIEWS</span>
		                     	@endif
		                    </p>
		                </div>
		                <div class="col-md-4 ">
		                    <h5>{{ $cmp->tagline }}</h5>
		                </div>
		                <div class="col-md-1 "></div>
		            </div>
		            <?php
		            $bb = explode('-',$cmp->budget);
		            $bbb = '$'.$bb[0].'+';

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
		            <div class="row  ml-0 mr-0 boxbrd pt-0 pb-0">
		            	
		                <div class="col-md-2 pt-2 brdright"><!-- pt-3-->
		                    @if($cmp->is_publish) <h4><span> {{ 'Verified' }}</span></h4> @endif
							@if($cmp->budget) <p><i class="fa fa-tag" aria-hidden="true"></i> {{ $bbb }}</p> @endif
							@if($cmp->rate) <p><i class="fa fa-clock-o" aria-hidden="true" ></i> {{ $rrr }}/hr</p>@endif
							@if($cmp->size) <p><i class="fa fa-user" aria-hidden="true" ></i> {{ $cmp->size }}</p>@endif
							@if($cmp->city) <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $cmp->city }}</p>@endif
		                </div>

		                <div class="col-md-7 brdright ">
		                    
		                    <p>
		                    	<?php $t = 0;?>
		                    	
		                    	<div id="piechart{{$cmp->id}}"></div>

		                    	<?php	
		                    		$data 		= array();
		                    		$data[0] 	= array('Services','Percent');

		                    	for( $i = 0;$i < count( $service_lines[$cmp->id] ); $i++ )
		                    	{		                    		
		                    		if( $service_lines[$cmp->id][$i]->percent > 0 )
		                    		{
			                    		$t 			= $t + $service_lines[$cmp->id][$i]->percent;
			                    		$data[$i+1] = array($subcategories[$service_lines[$cmp->id][$i]->subcategory_id],(int)$service_lines[$cmp->id][$i]->percent);
			                    	}	
		                    	}
		                    	if($t < 100){
		                    		$p = 100-$t;
		                    		$data[$i+1] = array("None",$p);
		                    	}
		                    	$data = json_encode($data);
		                    	?>
								<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
								<script type="text/javascript">
								// Load google charts
								google.charts.load('current', {'packages':['corechart']});
								google.charts.setOnLoadCallback(drawChart);
								// Draw the chart and set the chart values
								function drawChart() 
								{
								  	var data = google.visualization.arrayToDataTable(<?=$data?>);
								  	// Optional; add a title and set the width and height of the chart
								  	var options = {'title':'Service Focus', 'width':450, 'height':250};
								  	// Display the chart inside the <div> element with id="piechart"
								  	var chart = new google.visualization.PieChart(document.getElementById("piechart<?=$cmp->id?>"));
								  	chart.draw(data, options);
								}
								</script>
		                    </p>
		                </div>
		                <div class="col-md-3 pt-2">
		                	@if(isset($rate_review[$cmp->id]))
		                    <p>"{{$rate_review[$cmp->id]->most_impressive}}"</p>
		                    <p>{{$rate_review[$cmp->id]->position_title}}</p>
		                    @endif
		                </div>
		            </div>
		        </div>
		        <div class="col-md-2 pt-3 text-center px-0">
		           <div class="container py-4 border-bottom ">
		            	<a href="{{url($cmp->website)}}" target="_blank" class="serchbtn w-100">View Website</a>
		           </div>
		           <div class="container py-4 border-bottom">
		            	<a href="{{url('profile/'.$cmp->id)}}" target="_blank" class="serchbtn w-100">View Profile</a>
		           </div>
		           <div class="container py-4">
		            	<a href="{{url('company-contact/'.$cmp->id)}}" target="_blank" class="serchbtn w-100">Contact</a>
		           </div>
		        </div>
		    </div> <br/>   
	        @endforeach

	        <nav aria-label="Page navigation example">
				<ul class="pagination">
				
				<?php

					$links     	= "";
					$blankLast 	= "";
					$blankFirst = "";

					//print_r($_SERVER); die;

					$request_uri  = url()->current(); //$_SERVER['SCRIPT_URI'];
					$query_string = $_SERVER['QUERY_STRING'];
					
					$query_str 	= "";
					$prev_url 	= url($request_uri.'?page='.($currentPage-1));
					$next_url 	= url($request_uri.'?page='.($currentPage+1));

					if(!empty($query_string))
					{
						$query_string 	= explode('&', $query_string);
						$del_val 		= "page=".$currentPage."";
						$query_string 	= array_diff($query_string,[$del_val]);
						
						if(!empty($query_string))
						{
							$query_str = '&'.implode('&', $query_string);
							$prev_url = url($request_uri.'?page='.($currentPage-1).$query_str);
							$next_url = url($request_uri.'?page='.($currentPage+1).$query_str);
						}
					}

					if( $currentPage == 1 )
					{
			    		$tabindex = ' tabindex="-1" ';
			    		$aria_disabled = ' aria-disabled="true" ';
			    		$disabled = 'disabled';
			    	}
			    	else
			    	{
			    		$tabindex = '';
		    			$aria_disabled = '';
		    			$disabled = '';
			    	}

			    	$links .= '<li class="page-item '.$disabled.'"><a class="page-link" href="'.$prev_url.'" '.$tabindex.' '.$aria_disabled.'>Previous</a></li>';
					?>

				    <!--<li class="page-item <?php echo $disabled;?>"><a class="page-link" href="<?php echo $prev_url;?>" <?php echo $tabindex; echo $aria_disabled;?> >Previous</a></li>-->
				    
				    <?php

				    for ( $i=1; $i <= $totalPage; $i++ ) 
				    { 
				    	if($i == $currentPage)
				    	{ 
				    		$active 		= ' active ';
				    		$aria_current 	= ' aria-current="page" ';

				    		if($i == $lastPage)
				    		{ 
					    		$tabindex = ' tabindex="-1" ';
				    			$aria_disabled = ' aria-disabled="true" ';
				    			$disabled = 'disabled';
				    		}

				    		$links .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>';	
				    	}
				    	else
				    	{
				    		$active = '';
				    		$aria_current = '';
				    		$tabindex = '';
				    		$aria_disabled = '';
				    		$disabled = '';

				    		if($i >= $currentPage-$beforeOrAfterCurrentPage || $i == 1)
				    		{				    		
					    		if($i <= $currentPage+$beforeOrAfterCurrentPage || $i == $lastPage)
					    		{
					    			$links .= '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>';
					    		}
					    		else
					    		{
					    			if($blankFirst == '')
					    			{
					    				$blankFirst = '...';
					    				$links .= '...';
					    			}
					    		}
					    	}
					    	else
					    	{
					    		if($blankLast == '')
					    		{
				    				$blankLast = '...';
				    				$links .= '...';
				    			}
					    	}			
				    	}

				    	/*echo '<li class="page-item '.$active.'" '.$aria_current.'><a class="page-link" href="'.url($request_uri.'?page='.$i.$query_str).'">'.$i.'</a></li>';*/

				    }	

				    $links .= '<li class="page-item '.$disabled.'"><a class="page-link" href="'.$next_url.'" '.$tabindex.' '.$aria_disabled.'>Next</a></li>';
				    ?>
				    <!--<li class="page-item <?php echo $disabled;?>"><a class="page-link" href="<?php echo $next_url;?>" <?php echo $tabindex; echo $aria_disabled;?> >Next</a></li>-->

				    <?php echo $links; ?>
				</ul>
			</nav> 
		@else
			<div class="row" ><div style="margin: 0 auto;">No Match Found</div></div>            
		@endif
    </div>
</section>                   
@endsection

@section('script')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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