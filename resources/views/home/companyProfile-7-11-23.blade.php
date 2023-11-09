@extends('layouts.home-master')
@section('content')
<!-- listing section start -->
<section class="container-fluid list-top">
    <div class=" container">
        <a href="">Home | Company Profile</a>
        {{--<h2>TheyTrustUsLogin</h2>--}}
    </div>
</section>
<section class="container-fluid mt-5 mb-5 list-box">
    <div class=" container">
        <div class="row ">
            <div class="col-lg-12 col-md-12 firm-sec pl-md-4">
                <div class="graph-sec row border mx-0 pt-5 pb-5 px-3 ">
                    <div class="col-xl-2 col-lg-6 border-right verified-sec pb-3 pb-md-0">
                        <img src="{{ asset( $company->logo ) }}" alt="" class="img-fluid ">
                        @if( $company->is_publish )
                            <img src="{{asset('front_components/images/verified.png')}}" alt="" class="img-fluid ">
                        @endif
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
                        <div class="icon-box mt-4">
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/verified-icon1.png')}}" alt="">
                                {{ $bbb }}
                            </p>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/time.png')}}" alt="">
                                {{ $rrr ?? 'NA' }} / Hr
                            </p>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/person.png')}}" alt="">
                                {{ $company->size }}
                            </p>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/location2.png')}}" alt="">
                                {{ $company->address[0]->city ?? '' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 pl-md-4 mt-md-0 mt-4">
                        <h3>{{ ucfirst( $company->name ) }}</h3>
                        <p>{{ $company->tagline }}</p>
                        <div class="reviews-row">
                            <h3> {{number_format((float)$rate_review->rating, 1, '.', '') ?? ''}} </h3>
                            <div class="px-3">
                                <?php
                                    for($i=1;$i<=5;$i++)
                                    {
                                        if($i <= $rate_review->rating)
                                        {
                                        ?>
                                            <i class="fa fa-star bluestar"></i>
                                        <?php
                                        }
                                        elseif($rate_review->rating <= $i-1)
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
                            <h3>{{$rate_review->review}} REVIEWS</h3>
                        </div>
                        <div class="links">
                            <p>{{ $company->short_description }}</p>
                        </div>
                    </div>
                    <div class="col-xl-4  pl-md-0 mt-xl-0 mt-5 locationbox">
                        <h3>Location </h3>
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{asset('front_components/images/profilemap.png')}}" alt="" class="img-fluid"> &nbsp; {{ $company->address[0]->city ?? '' }} {{ $company->address[0]->country->name ?? ''}} <!-- <a href="">Show All</a> -->
                        </div>
                        {{-- <img src="{{asset('front_components/images/profile-google.jpg')}}" alt=""
                            class="img-fluid mt-4"> --}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15281491.841751238!2d72.1038341019075!3d20.757563059676368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1697655190803!5m2!1sen!2sin" width="365" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="container-fluid mt-5 mb-5 focus-sec">
    <div class=" container">
        <div class="row">
            <div class="col-lg-12 col-md-7  pl-md-4">
                <div class=" row border mx-0 py-4 px-3 align-items-center">
                    <div class="col-xl-8  pl-md-5 mt-xl-0 mt-5">
                        <h2>Focus</h2>
                    </div>
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
                    <div class="col-xl-4  pl-md-5 mt-xl-0 mt-5 focus-box">
                        <h3><a href="{{ route('claim-your-profile', $company->user_id ) }}" class="btn btn-lg btn-primary">Claim Your Profile</a></h3>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="container-fluid mt-5 mb-5 review-sec">
    <div class=" container">
        <div class="row graph-sec">
            <div class="col-lg-12 col-md-7  pl-md-4">
                <div class=" row border mx-0 py-4 px-3 align-items-center">
                    <div class="col-xl-6  pl-md-5 mt-xl-0 mt-5">
                        <h2>Reviews</h2>
                        <div class="reviews-row">
                            @if( isset( $rate_review ) )
                            <h3>{{ number_format( (float)$rate_review->rating, 1, '.', '' ) ?? '' }}</h3>
                            <div class="px-3">
                                <?php
                                for( $i=1; $i <= 5; $i++ )
                                {
                                    if($i <= $rate_review->rating)
                                    {
                                    ?>
                                        <i class="fa fa-star bluestar"></i>
                                    <?php
                                    }
                                    elseif( $rate_review->rating <= $i-1 )
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
                            <h3>{{ $rate_review->review }} REVIEWS</h3>
                             @endif
                        </div>
                      </div>
                    <div class="col-xl-6  pl-md-5 mt-xl-0 mt-5 pt-4 ">
                        <h2><a class="submitbtn" style="color:#fff;" href="{{ route( 'company.review', $company->id ) }}">Submit Review</a></h2>
                    </div>
                </div>
                @foreach($review as $key => $val)
                <div class="  row border mx-0 py-5 px-3 previw-sec" id="review{{$val->id}}">
                    <div class="col-md-3  pt-0 border-right">
                        <div class="icon-box ">
                            <h4>THE PROJECT</h4>
                            <h3>{{ ucfirst($val->project_title) }}</h3>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/verified-icon1.png')}}" alt="" class="img-fluid">
                                {{$val->project_type}}
                            </p>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/verified-icon1.png')}}" alt="" class="img-fluid">
                                {{$val->cost_range}}
                            </p>
                            <p class="d-flex  align-items-center">
                                <img src="{{asset('front_components/images/profilecalender.png')}}" alt="" class="img-fluid">
                                {{ date('M Y',strtotime($val->project_start)) }} - {{ date('M Y',strtotime( $val->project_end ) ) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3  pt-0 border-right">
                        <h4>THE REVIEW</h4>
                        <p>{{ date('d M Y', strtotime( $val->updated_at ) ) }}</p>
                        <p>{{$val->communication_review ? $val->communication_review : '' }}</p>
                    </div>
                    <div class="col-md-3  pt-0 border-right">
                        <div class="reviews-row p-0">
                            <h3 class="mr-2">{{ number_format((float)$val->overall_rating, 1, '.', '') ?? '' }}</h3>
                            <div class="">
                                <?php
                                    for( $i=1; $i<=5; $i++ )
                                    {
                                        if($i <= $val->overall_rating)
                                        {
                                        ?>
                                           <i class="fa fa-star bluestar"></i>
                                        <?php
                                        }
                                        elseif( $val->overall_rating <= $i-1 )
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
                            </div></br>
                        </div>
                        <p class="mt-2 qualitytxt">
                            Quality: {{ $val->quality }}/5                </br>
                            Timeliness: {{ $val->timeliness }}          </br>
                            Cost: {{ $val->cost }}                      </br>
                            Communication: {{ $val->communication }}    </br>
                            Expertise: {{ $val->expertise }}            </br>
                            Ease of working: {{ $val->ease_of_working }}</br>
                            Refer-ability: {{ $val->refer_ability }}
                        </p>
                    </div>
                    <div class="col-md-3  pt-0 text-center">
                        <h4>THE REVIEWER</h4>
                        <p>{{ $val->position_title }}, {{ $val->company_name }}</p>
                        <img src="{{asset('front_components/images/userprofile.png')}}" alt="" class="img-fluid">
                        <div class="icon-box  ">
                            <p class="d-flex mt-4 justify-content-center align-items-center">
                                <img src="{{asset('front_components/images/verified-icon1.png')}}" alt="" class="img-fluid">
                                {{$val->project_type}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<div class=" container text-center fullreview">
    <div class="row ">
        <a href="#fullreview{{$val->id}}" style="color:#fff;"><span class="submitbtn fr{{$val->id}}" onclick="showHideReview('fr{{$val->id}}','hr{{$val->id}}','fullreviews{{$val->id}}')">
        Read full Reviews</span>
        </a>
        <a href="#review{{$val->id}}" style="color:#fff;"><span class="submitbtn hr{{$val->id}}" style="display: none;" onclick="showHideReview('hr{{$val->id}}','fr{{$val->id}}','full{{$val->id}}')">Minimize Reviews</span>
        </a>
    </div>
</div>
 <!--Full Reviews section start -->
                    <div id="reviewContainer" class="row  ml-0 mr-0 company-dec px-4 py-5 fullreviews{{$val->id}} full{{$val->id}} " id="fullreview{{$val->id}}" style="display: none;" >
                        <div id="stick-top">
                        <div class="col-md-12 px-3 py-3">
                              <div class="row  ml-0 mr-0 searchresult">
                                <div class="col-md-3 pt-3 text-left px-0 stick-sec">
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
                                    <div class="scrollable-section">
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
                                                </div>
                                            </div>
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
@endsection
@section('script')
<script type="text/javascript">

    var showHideReview;
    var showHideAdd;
    $(document).ready(function () {
        showHideAdd = function (idd, idd1) {
            $("#" + idd).hide();
            $("#" + idd1).show();
        }
    });
    $(document).ready(function () {
        showHideReview = function (idd, idd1, idd2) {
            $("." + idd2).toggle();
            $("." + idd).hide();
            $("." + idd1).show();
        }
    });

    var container = document.getElementById('reviewContainer');
            container.scrollIntoView({ behavior: 'smooth' }); // Scroll to the container smoothly


</script>


</script>

@endsection
