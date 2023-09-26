@extends('layouts.home-master')
@section('content')

<?php 
$reviews = array(1,3,5,10,15,20);
$ratings = array(1,2,3,4,5);

if(isset($_GET['location'])){$loc = $_GET['location'];}else{$loc = array();}
if(isset($_GET['services'])){$subcat = $_GET['services'];}else{$subcat = array();}
if(isset($_GET['budget'])){$bud = $_GET['budget'];}else{$bud ="";}
if(isset($_GET['reviews'])){$rev = $_GET['reviews'];}else{$rev ="";}
if(isset($_GET['rating'])){$rat = $_GET['rating'];}else{$rat ="";}
if(isset($_GET['rates'])){$rat = $_GET['rates'];}else{$rat =array();}
if(isset($_GET['industry'])){$ind = $_GET['industry'];}else{$ind =array();}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 mx-auto text-center">
                    <!--<h2>EDIT PROFILE</h2>-->
                    <h3>Top {{$subcategories[$subcat[0]]}} Companies</h3>
                    <!--<p>Company Company Company Company Company Company</p>-->
                </div>
            </div>
        </div>
    </div>
</section>

<form id="form2" action="{{ url('companies') }}" method="GET">
	<!--@csrf-->
	<input type="hidden" id="sub" name="services[]" value="<?php if(isset($_GET['services'])){echo $subcat[0];} ?>">
	<input type="hidden" id="loc" name="location[]" value="<?php if(isset($_GET['location'])){echo $loc[0];} ?>">
</form>
<section class="searchbox container">
	<form id="form1" method="get" action="" class=""><!--was-validated-->
	    <div class="row pr-5">
	        <div class="col-md-12"><!-- <h3>My Profile</h3> --></div>
	        <div class=" navbar-collapse" id="">
	            <ul class=" " >
					<li class="nav-item dropdown" style="border:1px solid gray; width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Location</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($locations as $key=>$location)
							<span class="dropdown-item" href="#" for="location{{$key}}" >
								<input type="checkbox" id="location{{$key}}" name="location[]" onchange="searchCompany()" <?php if(isset($loc) && in_array($key, $loc)){echo 'checked';}?> value="{{$key}}"> {{$location}}
							</span>
							@endforeach
	                    </div>
	                </li>			

	                <li class="nav-item dropdown" style="border:1px solid gray; width: 10%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Services</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($subcategories as $key=>$subcategoy)
							<span class="dropdown-item" href="#" for="services{{$key}}" >
								<input type="checkbox" id="services{{$key}}" name="services[]" onchange="searchCompany()" <?php if(isset($subcat) && in_array($key, $subcat)){echo 'checked';}?> value="{{$key}}"> {{$subcategoy}}
							</span>
							@endforeach
	                    </div>
	                </li>

	                <li class="nav-item dropdown" style="border:1px solid gray;width: 12%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding:5px 5px!important;">Client Budget</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($budget as $key=>$budgets)
							<span class="dropdown-item" href="#" for="chk_budget{{$budgets}}" >
								<input type="radio" id="chk_budget{{$budgets}}" name="budget" onchange="searchCompany()" <?php if(isset($bud) && $bud == $budgets){echo 'checked';}?> value="{{$budgets}}"> {{$budgets}}
							</span>
							@endforeach
	                    </div>
	                </li>

	                <li class="nav-item dropdown" style="border:1px solid gray;width: 12%;display: inline-block;padding: 2px;">
	                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="padding: 5px 5px!important;">Hourly Rate</a>
	                    <div class="dropdown-menu" style="max-height: 300px;overflow-y: scroll;">
	                    	@foreach($rate as $key=>$rates)
							<span class="dropdown-item" href="#" for="rates{{$rates}}" >
								<input type="checkbox" id="rates{{$rates}}" name="rates[]" onchange="searchCompany()" <?php if(isset($rat) && in_array($rates, $rat)){echo 'checked';}?> value="{{$rates}}"> {{$rates}}
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
	        <h5>
	        	<span class="totalList serchbtn">@if($company) {{count($company)}} @else {{0}} @endif Firms</span> List of the Best {{$subcategories[$subcat[0]]}} Firms
	        </h5>
	    </div>
		@if($company)
			@foreach($company as $key=>$cmp)
			<div class="row  ml-0 mr-0 mt-3 searchresult item{{$key}}" style="border: 1px solid gray;">
		        <div class="col-md-9 recordbox">
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
		            <div class="row  ml-0 mr-0 boxbrd pt-0 pb-0">
		                <div class="col-md-2 pt-2 brdright"><!-- pt-3-->
		                    <h4><span><?php if(isset($rate_review[$cmp->id]) && $rate_review[$cmp->id]->review >= 1){ echo 'Verified'; } ?></span></h4>
							@if($cmp->budget) <p><i class="fa fa-tag" aria-hidden="true"></i> {{ $cmp->budget }}</p> @endif
							@if($cmp->rate) <p><i class="fa fa-clock-o" aria-hidden="true" ></i> {{ $cmp->rate }} /hr</p>@endif
							@if($cmp->size) <p><i class="fa fa-user" aria-hidden="true" ></i> {{ $cmp->size }}</p>@endif
							@if($cmp->address) <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $cmp->address }}</p>@endif
		                </div>
		                <div class="col-md-6 brdright ">
		                    <!--<p> <strong>Service Focus</strong> </p>-->
		                    <p>
		                    	<?php $t = 0;?>
		                    	<div id="piechart{{$cmp->id}}"></div>
		                    	<?php	
		                    	$data = array();
		                    	$data[0] = array('Services','Percent');
		                    	for($i = 0;$i < count($service_lines[$cmp->id]); $i++){		                    		
		                    		if($service_lines[$cmp->id][$i]->percent > 0){
			                    		$t = $t + $service_lines[$cmp->id][$i]->percent;
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
								function drawChart() {
								  	var data = google.visualization.arrayToDataTable(<?=$data?>);
								  	// Optional; add a title and set the width and height of the chart
								  	var options = {'title':'Service Focus', 'width':350, 'height':250};
								  	// Display the chart inside the <div> element with id="piechart"
								  	var chart = new google.visualization.PieChart(document.getElementById("piechart<?=$cmp->id?>"));
								  	chart.draw(data, options);
								}
								</script>
		                    </p>

		                   	<!--<p class="">
		                    	<?php 
		                    	/*if($service_lines[$cmp->id][0]->percent > 0){
		                    		echo $service_lines[$cmp->id][0]->percent.'% '; 
		                    		echo $subcategories[$service_lines[$cmp->id][0]->subcategory_id];
		                    	}else{
		                    		echo 'None';
		                    	}*/	
		                    	?>
		                    </p>-->
		                </div>
		                <div class="col-md-4 pt-2">
		                	@if(isset($rate_review[$cmp->id]))
		                    <p>"{{$rate_review[$cmp->id]->most_impressive}}"</p>
		                    <p>{{$rate_review[$cmp->id]->position_title}}</p>
		                    @endif
		                </div>
		            </div>
		        </div>
		        <div class="col-md-3 pt-3 text-center px-0">
		           <div class="container py-4 border-bottom ">
		            	<a href="{{url($cmp->website)}}" target="_blank" class="serchbtn w-100">View Website</a>
		           </div>
		           <div class="container py-4 border-bottom">
		            	<a href="{{url('company-profile/'.$cmp->id)}}" target="_blank" class="serchbtn w-100">View Profile</a>
		           </div>
		           <div class="container py-4">
		            	<a href="{{url('company-contact/'.$cmp->id)}}" target="_blank" class="serchbtn w-100">Contact</a>
		           </div>
		        </div>
		    </div> <br/>   
	        @endforeach
		@else
			<div class="row" ><div style="margin: 0 auto;">No Match Found</div></div>            
		@endif
    </div>
</section>                   
@endsection

@section('script')
<script>
	var searchCompany;
	var clearAll;
	$(document).ready(function(){
		searchCompany = function(){
			var ser = $("#form1").serialize();
			console.log(ser);
			jQuery.ajax({
				url:"{{url('get-company')}}",
				type: "GET",
				data: ser,
				//dataType : 'json',
				success: function(result){
					//alert(result);
					console.log(result);
					$("#addCompanyList").html(result);
					window.history.pushState('', '', 'companies?'+ser);
				}
			});
		}
		clearAll = function(){
			$("#form2").submit();
		}	
	});
</script>


@endsection