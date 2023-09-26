@extends('layouts.home-master')

@section('content')

<style>
.bggray{
    background-color: #fcfcfc;
    padding: 20px;
    max-width: 325px;
    width: 100%;
}
</style>

<div id="company-profile-page">
<section class="container-fluid companyprofile-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">
                    <h3>Company Profile</h3>
                    <h1>TheyTrustUsLogin</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="company_profile container pt-5 ">
    <div class="borderbox">
        <div class="row  ml-0 mr-0 company text-center profileone">
            <div class="col-md-3 brdbottom companybox leftbrd text-center text-md-left" style="padding-left: 0px;"> 
                <span class=""><img src="{{asset($company->logo)}}" alt="" style="width: 50px;height: 50px;"></span>
                <span  class="pt-2 pl-2"><strong>{{ ucfirst( $company->name ) }}</strong></span>
            </div>
            <div class="col-md-3 brdbottom companybox align-middle d-flex align-items-center justify-content-center ">
                <a href="#summary">Summary</a>
            </div>
            <div class="col-md-3 brdbottom companybox d-flex align-items-center justify-content-center">
                <a href="#focus">Focus</a>
            </div>
            <div class="col-md-3 brdbottom companybox d-flex align-items-center justify-content-center">
                <a href="#review">Reviews</a>
            </div>
        </div>
        <div class="row  ml-0 mr-0 company-dec profilesecondrow px-4 py-5  ">
            <div class="col-md-6 ">
                <h3>{{$company->tagline}}</h3>
                <p>
                    @if(isset($rate_review))
                    <span style="font-weight:bolder ;">{{number_format((float)$rate_review->rating, 1, '.', '') ?? ''}}</span>
                    <?php
                    for($i=1;$i<=5;$i++){
                        if($i <= $rate_review->rating){
                            ?>
                            <span style="color: #ff3b00f2;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                <img src="{{asset('front_components/images/red.png')}}" width="15px;">
                            </span>
                            <?php
                        }elseif($rate_review->rating <= $i-1){
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
                    <span><a href="#review">{{$rate_review->review}} REVIEWS</a></span>
                    @endif
                </p>
                <!-- wordwrap($big, 10);-->
                <div id="short_desc">
                    <p>{{substr($company->short_description,0,200)}}</p>
                    <a href="javascript:void(0)" onclick="showHideAdd('short_desc','full_desc')">Read More . . .</a>
                </div>    
                <div id="full_desc" style="display:none;">
                    <p>{{$company->short_description}}</p>
                    <a href="javascript:void(0)" onclick="showHideAdd('full_desc','short_desc')">Read Less . . .</a>
                </div>    
                
            </div>
            <?php
            
            $bb  = explode( '-', $company->budget );
            $bbb = '$'.$bb[0] . '+';

            if( !empty( $rr ) )
            {
                $rr  = explode('-',$company->rate);
                $rrr = '$'.$rr[0].'-$'.$rr[1]; 
            }
            else
            {
                $rrr = 'N/A ';
            }

            ?>
            <div class="col-md-3  pt-2">
                @if($company->is_publish) <h3> {{ 'VERIFIED' }}</h3> @endif
                <p><i class="fa fa-tag" aria-hidden="true"></i> {{ $bbb }}</p>
				<p><i class="fa fa-clock-o" aria-hidden="true" ></i> {{ $rrr }} / hr</p>
				<p><i class="fa fa-user" aria-hidden="true" ></i> {{ $company->size }}</p>
				<p><i class="fa fa-flag" aria-hidden="true"></i> Founded at {{ $company->founded_at }}</p>
            </div>
            <div class="col-md-3 pt-2">
                <h3>LOCATION</h3>
                <div id="headAdd">
                    <p >
                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $company->address[0]->city ?? '' }} {{ $company->address[0]->country->name ?? ''}} 
                        <a href="javascript:void(0)" onclick="showHideAdd('headAdd','fullAdd')">Show All</a>
                    </p>
                    <img src="https://theytrust-us.developmentserver.info/front_components/images/staticmap.png"
                    class="img-fluid" alt="">
                </div>    
                <?php $i=0;?>
                @foreach($company->address as $add)
                <?php $i++; ?>
                <div style="display:none;" id="fullAdd">
                    <p><?php if($i==1) {echo ' HEADQUARTERS ';}else{echo ' OTHER LOCATIONS ';}?> 
                    <a href="javascript:void(0)" onclick="showHideAdd('fullAdd','headAdd')"> Show Less</a></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $add->autocomplete }} </p>
    				<p>{{ $add->city }} {{ $add->zip }}</p>
    				<p>{{ $add->country->name }}</p>
    				<p>{{ $add->mobile }}</p>
                </div>    
                @endforeach
                
            </div>
        </div>
        <div class="row  ml-0 mr-0 company-dec px-0 py-0  profilethiredrow">
            <div class="row ml-0 mr-0 focusbox">  <h3 id="focus">Focus </h3></div>
            <div class="row ml-0 mr-0">
                <div class="col-md-4 pt-2">
                    <p>
                        <div class="row text-center" id="piechart1"></div>
                        <?php 
                        if(count($service_lines) > 0){
                            $t = 0;  
                            $data = array();
                            $data[0] = array('Service Lines','Percent');
                            for($i = 0;$i < count($service_lines); $i++){                                 
                                if($service_lines[$i]->percent > 0){
                                    $t = $t + $service_lines[$i]->percent;
                                    $data[$i+1] = array($service_lines[$i]->subcategory->subcategory,(int)$service_lines[$i]->percent);
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
                                var options = {'title':'Service Lines', 'width':450, 'height':300};
                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById("piechart1"));
                                chart.draw(data, options);
                            }
                            </script>
                            <?php
                        }
                        ?>    
                    </p>    
                </div>
                <div class="col-md-4 pt-2">
                    <p>
                        <div class="row text-center" id="piechart4"></div>
                        <?php 
                        if(count($add_client_size) > 0){
                            $t = 0;  
                            $data = array();
                            $data[0] = array('Client Focus','Percent');
                            for($i = 0;$i < count($add_client_size); $i++){                                 
                                if($add_client_size[$i]->percent > 0){
                                    $t = $t + $add_client_size[$i]->percent;
                                    $data[$i+1] = array($add_client_size[$i]->client_size->name,(int)$add_client_size[$i]->percent);
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
                                var options = {'title':'Client Focus', 'width':440, 'height':300};
                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById("piechart4"));
                                chart.draw(data, options);
                            }
                            </script>
                            <?php
                        }
                        ?>    
                    </p>    
                </div>
                <div class="col-md-4 pt-2">
                    <p>
                        <div class="row text-center" id="piechart2"></div>
                        <?php $t = 0; 
                        if(count($add_industry) > 0){
                            $data = array();
                            $data[0] = array('Industry Focus','Percent');
                            for($i = 0;$i < count($add_industry); $i++){                                 
                                if($add_industry[$i]->percent > 0){
                                    $t = $t + $add_industry[$i]->percent;
                                    $data[$i+1] = array($add_industry[$i]->industry->name,(int)$add_industry[$i]->percent);
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
                                var options = {'title':'Industry Focus', 'width':450, 'height':300};
                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById("piechart2"));
                                chart.draw(data, options);
                            }
                            </script>
                            <?php
                        }?>    
                    </p>
                </div> 
                @if(count($add_focus) > 0)
                    @foreach($add_focus as $key => $value)
                    <div class="col-md-4 pt-2">
                        <p>
                            <div class="row text-center" id="piechart3{{$key}}"></div>
                            <?php 
                            $t = 0;
                            if(count($value) > 0){
                                $data = array();
                                $data[0] = array($add_focus[$key][0]->subcategory->subcategory.' Focus','Percent');
                                for($i = 0;$i < count($value); $i++){                                 
                                    if($value[$i]->percent > 0){
                                        $t = $t + $value[$i]->percent;
                                        $data[$i+1] = array($value[$i]->subcat_child->name,(int)$value[$i]->percent);
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
                                    var options = {'title':'{{$add_focus[$key][0]->subcategory->subcategory}} Focus', 'width':450, 'height':300};
                                    // Display the chart inside the <div> element with id="piechart"
                                    var chart = new google.visualization.PieChart(document.getElementById("piechart3{{$key}}"));
                                    chart.draw(data, options);
                                }
                                </script>
                                <?php
                            }?>    
                        </p>
                    </div>
                    @endforeach
                @endif
            </div>    
        </div>

        <div class="row">
            <h3><a href="{{ route('claim-your-profile', $company->user_id ) }}" class="btn btn-lg btn-primary">Claim Your Profile</a></h3>
        </div>


        <!-- Reviews section start -->

        <div class="row  ml-0 mr-0 company-dec px-4 reviews  reviewbox">
        <h3 id="review">Reviews </h3>
         </div>
        <div class="row  ml-0 mr-0 company-dec px-4 reviews ">
            <div class="col-md-12 px-3 py-3">
                <!-- <h3 id="review">Reviews </h3> -->
                <p>
                    @if(isset($rate_review))
                    <span style="font-weight:bolder ;">{{number_format((float)$rate_review->rating, 1, '.', '') ?? ''}}</span>
                    <?php

                    for( $i=1; $i<=5; $i++ )
                    {
                        if($i <= $rate_review->rating)
                        {
                            ?>
                            <span style="color: #ff3b00f2;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                <img src="{{asset('front_components/images/red.png')}}" width="15px;">
                            </span>
                            <?php
                        }
                        elseif( $rate_review->rating <= $i-1 )
                        {
                        ?>
                            <span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                <img src="{{asset('front_components/images/comb2.png')}}" width="15px;">
                            </span>
                        <?php
                        }
                        else
                        {
                        ?>
                            <span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                <img src="{{asset('front_components/images/red-half.png')}}" width="15px;">
                            </span>
                            <?php
                        }
                    }
                    ?>
                    <span>{{$rate_review->review}} REVIEWS</span>
                    @endif
                    <a class="submitbtn" style="color:#fff;" href="{{ route( 'company.review', $company->id ) }}">Submit Review</a>
                </p>

                <div class="row  ml-md-0 mr-md-0 searchresult">
                    
                    @foreach($review as $key => $val)
                    
                    <div class="col-md-9 recordbox" id="review{{$val->id}}">
                        
                        <div class="row  ml-0 mr-0 boxbrd pt-2 pb-2">
                            
                            <div class="col-md-4 brdright pt-3">
                                <p> <strong>THE PROJECT</strong> </p>
                                <p><h3>{{ ucfirst($val->project_title) }}</h3></p>
                                <p class="txtsmall" title="Project Category"><i class="fa fa-tag" aria-hidden="true"></i>{{$val->project_type}}</p>
                                <p class="txtsmall" title="Project Size"><i class="fa fa-tag" aria-hidden="true"></i> {{$val->cost_range}}</p>
                                <p class="txtsmall" title="Project Length"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('M Y',strtotime($val->project_start)) }} - {{ date('M Y',strtotime( $val->project_end ) ) }}</p>
                            </div>
                            
                            <div class="col-md-4 brdright pt-3">
                                <p> <strong>THE REVIEW</strong> </p>
                                <p>{{$val->most_impressive}}</p>
                                <p>{{ date('d M Y', strtotime( $val->updated_at ) ) }}</p>
                            </div>

                            <div class="col-md-4 pt-3">

                                <p style="color: #0087f2;"> 
                                    <strong>{{number_format((float)$val->overall_rating, 1, '.', '') ?? ''}}</strong> &nbsp;
                                    
                                    <?php
                                    for( $i=1; $i<=5; $i++ )
                                    {
                                        if($i <= $val->overall_rating)
                                        {
                                        ?>
                                            <span style="color: #ff3b00f2;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                                <img src="{{asset('front_components/images/red.png')}}" width="15px;">
                                            </span>
                                        <?php
                                        }
                                        elseif( $val->overall_rating <= $i-1 )
                                        {
                                            ?>
                                            <span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                                <img src="{{asset('front_components/images/comb2.png')}}" width="15px;">
                                            </span>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <span style="color: black;font-size:35px;font-weight:bolder ;padding-top: 10px;">
                                                <img src="{{asset('front_components/images/red-half.png')}}" width="15px;">
                                            </span>
                                        <?php
                                        }
                                    }
                                    ?>
                                </p>
                                <p class="txtsmall">Quality:{{$val->quality}}</p>
                                <p class="txtsmall">Timeliness:{{ $val->timeliness }}</p>
                                <p class="txtsmall">Cost:{{$val->cost}}</p>
                                <p class="txtsmall">Communication:{{$val->communication}}</p>
                                <p class="txtsmall">Expertise:{{$val->expertise}}</p>
                                <p class="txtsmall">Ease of working:{{$val->ease_of_working}}</p>
                                <p class="txtsmall">Refer-ability:{{$val->refer_ability}}</p>
                            </div>
                        </div>
                        <div class="row  ml-0 mr-0 boxbrd pt-2 pb-2">
                            <div class="col-md-6 brdright pt-3">
                                @if($val->project_summary)
                                <p> <strong>Project summary:</strong> </p>
                                <p>{{$val->project_summary}}</p>
                                @endif
                            </div>
                            <div class="col-md-6 pt-3 pb-2">
                                @if($val->feedback_summary)
                                <p> <strong>Feedback summary:</strong> </p>
                                <p>{{$val->feedback_summary}}</p>
                                @endif
                                <a href="#fullreview{{$val->id}}" style="color:#fff;"><span class="submitbtn fr{{$val->id}}" onclick="showHideReview('fr{{$val->id}}','hr{{$val->id}}','fullreviews{{$val->id}}')">Read full Reviews</span></a>
                                <a href="#review{{$val->id}}" style="color:#fff;"><span class="submitbtn hr{{$val->id}}" style="display: none;" onclick="showHideReview('hr{{$val->id}}','fr{{$val->id}}','full{{$val->id}}')">Minimize Reviews</span></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 pt-3 text-center px-0">
                        
                        <div class="container py-3 border-bottom border-right">
                            <p><strong>THE REVIEWER</strong></p>
                            <p>{{ $val->position_title }}, {{ $val->company_name }}</p>
                            <!--<img src="{{ asset('images/user.png') }} " alt="">-->
                            <img src="https://theytrust-us.developmentserver.info/front_components/images/user.png" class="img-fluid" alt="">
                        </div>

                        <div class="container py-5 border-bottom border-right ">
                            <p class="txtsmall"><i class="fa fa-user" aria-hidden="true"></i> {{$val->company_size}} Employees</p>
                            <p class="txtsmall"><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $val->city_country }}</p>
                        </div>
                    </div>

                    <!--Full Reviews section start -->

                    <div class="row  ml-0 mr-0 company-dec px-4 py-5 fullreviews{{$val->id}} full{{$val->id}} " id="fullreview{{$val->id}}" style="display: none;">
                        <div class="col-md-12 px-3 py-3">
                            
                            <h3 id="reviews">Full Reviews </h3>
                            
                            <div class="row  ml-0 mr-0 searchresult">
                                <div class="col-md-3 pt-3 text-left px-0">
                                    <div class="container py-2 border-bottom ">
                                        <p >THE REVIEWER</p></br>
                                        <a href="#background{{$val->id}}" class="btnreview" > Background </a>
                                    </div>
                                    <div class="container py-2 border-bottom ">
                                        <a href="#challenge{{$val->id}}" class="btnreview"> Challenge </a>
                                    </div>
                                    <div class="container py-2 border-bottom ">
                                        <a href="#solution{{$val->id}}" class="btnreview"> Solution </a>
                                    </div>
                                    <div class="container py-2 border-bottom ">
                                        <a href="#results{{$val->id}}" class="btnreview"> Results </a>
                                    </div>
                                    <div class="container py-2 border-bottom ">
                                        <a href="#ratings{{$val->id}}" class="btnreview"> Ratings </a>
                                    </div>
                                </div>
                                <div class="col-md-9 recordbox border-left">
                                    <div class="row  ml-0 mr-0 border-bottom pt-2 pb-2">
                                        <div class="col-md-12  pt-3" id="background{{$val->id}}">
                                            <p>A Theytrustus analyst personally interviewed this client over the phone. Below is an edited transcript.</p>
                                            <h3 class="pt-3"> BACKGROUND</h3>
                                            <h5><strong>Introduce your business and what you do there.</strong>   </h5>  
                                            <p> {{$val->company_position}}</p>
                                        </div>
                                    </div>
                                    <div class="row  ml-0 mr-0 border-bottom pt-2 pb-2">
                                        <div class="col-md-12  pt-3" id="challenge{{$val->id}}">
                                           <h3 class="pt-3"> OPPORTUNITY / CHALLENGE</h3>
                                            <h5><strong>What challenge were you trying to address with "<strong>{{ucfirst($company->name)}}</strong>"?</strong>  </h5>
                                            <p>{{$val->for_what_project}}</p>
                                        </div>
                                    </div>
                                    <div class="row  ml-0 mr-0 border-bottom pt-2 pb-2">
                                        <div class="col-md-12  pt-3" id="solution{{$val->id}}">
                                            <h3 class="pt-3"> SOLUTION</h3>
                                            <h5>  <strong> What was the scope of their involvement ? </strong>  </h5>
                                            <p>{{$val->how_select}}</p>



                                            <h5>  <strong>What is the team composition?</strong>  </h5>
                                            <p>{{$val->team_composition}}</p>


                                            <h5>  <strong>How did you come to work with?</strong>  </h5>
                                            <p>{{$val->scope_of_work}}</p>



                                            <h5>  <strong>How much have you invested with them?</strong>  </h5>
                                             <p>{{$val->cost_range}}</p>
                                             <!-- <p>{{$val->any_outcomes}}</p> -->
                                        </div>
                                    </div>
                                    <div class="row  ml-0 mr-0 border-bottom pt-2 pb-2">
                                        <div class="col-md-12  pt-3" id="results{{$val->id}}">
                                            <h5>  <strong>What is the status of this engagement?</strong>  </h5>
                                            <p>{{$val->how_effective}}</p>
                                            <h3 class="pt-3">RESULTS & FEEDBACK</h3>
                                            <h5><strong>What did you find most impressive about them?</strong>  </h5>
                                             <p>{{$val->most_impressive}}</p>
                                             <h5><strong>Are there any areas they could improve?</strong>  </h5>
                                             <p>{{$val->area_of_improvements}}</p>
                                        </div>
                                    </div>                           
                                    <div class="row  ml-0 mr-0 border-bottom pt-2 pb-2">
                                        <div class="col-md-12  pt-3" id="ratings{{$val->id}}">
                                           <h3 class="pt-3">  RATINGS</h3>
                                            <h5>  <strong> What evidence can you share that demonstrates the impact of the?</strong></h5>
                                            <div class="row">
                                                <div class="col-md-12 d-flex" >
                                                    <div><p class="" style="color:#000; font-weight:bold;font-size: 18px;"><strong>{{ 'Overall Score' }}</strong></p></div>
                                                <div class="ml-2 d-block"> <p style="color:#000; font-weight:bold;font-size: 18px;"><strong>{{number_format((float)$val->overall_rating, 1, '.', '') ?? ''}}</strong></p>
 </div>
                                                   
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row bggray">
                                                                
                                                                <div class="col-md-9">
                                                                    <span><strong>Timeliness</strong> <br/>{{ $val->timeliness_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{ number_format(( float )$val->timeliness, 1, '.', '') ?? ''}}</strong>
                                                                </div>
                                                            </div>    
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="row bggray mt-md-0 mt-3" >
                                                               
                                                                <div class="col-md-9 ">  
                                                                    <span><strong>Cost</strong> <br/>{{ $val->cost_review }}</span>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->cost, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>        
                                                        </div>

                                                    </div>

                                                    <div class="row pt-3">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="row bggray">
                                                              
                                                                <div class="col-md-9">  
                                                                    <span><strong>Quality</strong> <br/>{{ $val->quality_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->quality, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 ">
                                                            <div class="row bggray mt-md-0 mt-3">
                                                                
                                                                <div class="col-md-9">  
                                                                    <span><strong>Refer-ability</strong> <br/>{{ $val->refer_ability_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->refer_ability, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--  -->

                                                    <div class="row pt-3">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="row bggray">
                                                              
                                                                <div class="col-md-9">  
                                                                    <span><strong>Communication</strong> <br/>{{ $val->communication_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->communication, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 ">
                                                            <div class="row bggray mt-md-0 mt-3">
                                                                
                                                                <div class="col-md-9">  
                                                                    <span><strong>Expertise</strong> <br/>{{ $val->expertise_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->expertise, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--  -->


                                                    <div class="row pt-3">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="row bggray">
                                                              
                                                                <div class="col-md-9">  
                                                                    <span><strong>Ease of working</strong> <br/>{{ $val->ease_of_working_review }}</span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>{{number_format((float)$val->ease_of_working, 1, '.', '') ?? ''}}</strong>
                                                                </div>  
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!--  -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Full Reviews section end -->
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Reviews section end -->
        
    </div>
</section>                      
@endsection

@section('script')
<script type="text/javascript">
    var showHideReview;
    var showHideAdd;
    $(document).ready( function() {
        showHideAdd = function( idd, idd1 )
        {
            $("#"+idd).hide();
            $("#"+idd1).show();
        }
    });  

    $(document).ready( function() {
        showHideReview = function( idd, idd1, idd2 )
        {
            $("."+idd2).toggle();
            $("."+idd).hide();
            $("."+idd1).show();
        }
    });   
</script>        
@endsection
</div>