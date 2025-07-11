@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    /* Updated CSS styles */
    .hero-section {
        padding: 50px 0;
       
        background-color: #f5f2fd;
    }

    .hero-section .whitebox {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .hero-section h3 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align:center;
    }

    .hero-section h3 span {
        color: #007bff;
    }

    .hero-section h4 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .hero-section p {
        font-size: 18px;
        font-weight: bold;
    }
    .hero-section p span{
       color:#00bdd6;
    }

    .hero-section img {
        max-width: 100%;
        height: auto;
    }
.recent h3{
    font-size: 16px;
    font-weight: 800;
    color: #000 !important;
}
    /* Styles for the Provider Search Section */
    .provider-sec-box{
background-color:#f5f2fd;
padding-bottom: 62px;
    }
    .provider-sec {

    max-width: 967px !important;
   
}
    .provider-sec {
        border-radius: 101px!important;
        background-color: #ffffff;
        padding: 21px 26px;
    /* border-bottom: 1px solid #ddd; */
    max-width: 61%;
    }
    .provider-sec .dropdown2{
  
    border: 1px solid #aaa;}
    .provider-sec .inner {
        display: flex;
        align-items: center;
        gap: 15px;
        /* border: 1px solid #ddd; */
        border-radius: 5px;
        padding: 15px;
    }
    .recent-reviews .they{
font-weight:bold;
}
.user-img{
    align-items: center;

}
.reviewedbybox .dotted {
    border-top: 1px dashed #ddd;
    margin: 20px 0;
}
.reviewedbybox h4 {
    background-color: #dde1e5;
    padding: 6px 15px 9px 15px;
    width: fit-content;
    margin-bottom: 18px;
    font-size: 14px;
    text-transform: capitalize;
    font-weight: bold;
}
.portfolio .greybox h3 {
    background-color: #dde1e5;
    padding: 7px 30px 10px 30px;
    width: fit-content;
    margin-bottom: 18px;
}
    .provider-sec p {
        margin: 0;
        font-size: 18px;
    }

    .provider-sec select {
        flex: 1;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
    }

    .provider-sec .location {
        display: flex;
        align-items: center;
    }

    .provider-sec .location img {
        margin-right: 10px;
    }

    .provider-sec .btn-secondary {
        background-color: #00bdd6;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 28px;
        font-size: 18px;
        cursor: pointer;
    }
.user-name h4{
    font-size: 13px;
    font-weight: 600;
    margin-left: 11px;
    margin-top: 0;
    color: #6d6d6d;
    text-transform: capitalize;
}
    /* Styles for the Recent Reviews Section */
    .recent-reviews {
        padding: 50px 0;
        background-color: #fff;
    }

    .recent-reviews h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .recent-reviews h3 {
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .recent-reviews p {
        font-size: 14px;
        margin-bottom: 30px;
        text-decoration: underline;
    }

    .reviewby {
        margin-bottom: 0px;
    }

    .reviewby .greybox {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    .reviewby h3 {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
        margin-left:11px;
    }

    .reviewby .userbox {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        /* border-bottom:2px solid #ccc; */
    }
.cmpbox{
    border-bottom:2px solid #ccc;
}
    .reviewby .userbox img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .reviewby .user-name {
        flex: 1;
    }

    .reviewby .user-name h2 {
        font-size: 20px;
        margin: 0;
    }

    .reviewby .user-name p {
        margin: 0;
        color: #666;
    }

    .reviewby .qualitybox {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .reviewby .qualityreview {
        flex: 1;
        text-align: center;
    }

    /* .reviewby .qualityreview button {
        display: block;
        background: none;
        border: none;
        color: #007bff;
        font-size: 18px;
        cursor: pointer;
        margin-bottom: 5px;
    } */
    .checked {
    color: orange;
}
.star {
    padding: 11px 0;
}
 .ptitle {
    min-width: 143px;
}
    .reviewby .qualityreview .star {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .reviewby .qualityreview .star i {
        color: #ffc107;
    }

    .reviewby .dotted {
        border-top: 1px dashed #ddd;
        margin: 20px 0;
    }

    .recent-reviews .reviewby .greybox {
        margin-bottom: 20px;
    }

    .recent-reviews .reviewby .reviewby button {
        color: #00bdd6;
    background-color: #00bdd62e !important;
    border-color: #00bdd6 !important;
    border-radius: 5px;
    padding: 3px 8px 7px 8px;
    font-size: 13px;
    margin-right: 5px;
    font-weight: bold;
    border: 0;
    border-radius: 14px;
    }
    .reviewby .qualityreview button {
    color: #000;
    background-color: #f2f3f5 !important;
    border-color: #f2f3f5 !important;
    border-radius: 5px;
    padding: 3px 8px 7px 8px;
    font-size: 13px;
    margin-right: 5px;
    font-weight: bold;
    border: 0;
    border-radius: 14px;
}
    /* Utility Classes */
    .text-center {
        text-align: center;
    }

    .text-md-left {
        text-align: left;
    }

/* btn */
.circle-button {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 50px; /* Width and height to make it circular */
  height: 50px;
  background-color: #007BFF; /* Blue background color */
  border: none;
  border-radius: 50%; /* Makes the button circular */
  color: white;
  font-size: 24px; /* Size of the icon */
  cursor: pointer;
  transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.circle-button:hover {
  background-color: #0056b3; /* Darker blue on hover */
}

.circle-button:active {
  background-color: #003f7f; /* Even darker blue when active */
}

.circle-button .icon::before {
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  content: "\f002"; /* Unicode for Font Awesome search icon */
}

.provider-sec .fa{
    font-size:23px!important;
}
.amlooking{
    width:800px;
}
/* btn */

.reviewrate{
    display:flex;
}
.companyname{
  
    font-size: 21px!important;
    margin-left: 10px;

}
.explorebox .exploreinner{
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* border: 1px solid #ddd; */
    margin-bottom: 43px;
    margin-right:20px;
    width: 23%;
}
.explorebox .exploreinner:hover{
    box-shadow: 0px 10px 60px 0px rgba(85, 128, 255, 0.2);
}
.skills-section{
    background-color: #FAFAFA;
padding:80px 0 ;
}
.skill-box{
    padding: 50px 30px 50px 30px;
    border-style: solid;
    border-width: 0px 0px 0px 0px;
    border-color: #f5f5f5;
    border-radius: 5px 5px 5px 5px;
    background-color: #fff;
    margin-bottom: 43px;
    margin-right:20px;
    width: 23%;
}
.skill-box:hover{
    box-shadow: 0px 10px 60px 0px rgba(85, 128, 255, 0.2);
}
.movers-section{
    background-color: #f5f2fd;
    padding: 80px 0;
}
.moversbox{
    background: #fff;
    padding: 0px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
    width: 31%;
    margin-right:20px;
    margin-bottom: 20px;
  
}
.moversbox .moverscol1{
    padding:0
}


.moversbox button {
    color: #00bdd6;
    background-color: #00bdd62e !important;
    border-color: #00bdd6 !important;
    border-radius: 5px;
    padding: 7px 12px 10px 29px;
    font-size: 16px;
    margin-right: 5px;
    font-weight: bold;
    border: 0;
    border-radius: 0;
    margin-bottom: 20px;
    width: 100%;
    text-align: left;
}
.moversbox .btn {
    color: #000;
    background-color: #fff !important;
    border-color: #00bdd6 !important;
    border-radius: 5px;
    padding: 7px 12px 10px 29px;
    font-size: 16px;
    margin-right: 5px;
    font-weight: bold;
    border: 0;
    border-radius: 0;
    margin-bottom: 20px;
    width: 100%;
    text-align: left;
}

.col2box h2{
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}



    @media (max-width: 767px) {
        .reviewby .userbox {
            flex-direction: column;
            text-align: center;
        }

        .reviewby .user-name {
            text-align: center;
        }
    }

    .categories-section {
        padding: 80px 0;
        background-color:#f5f2fd;
    }

    .categories-section h3 {
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .categories-section p {
        font-size: 14px;
    margin-bottom: 30px;
    font-weight: bold;
    text-decoration: underline;
    }

    .categories-section h4 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .categories-section ul {
        list-style-type: none;
        padding: 0;
    }

    .categories-section ul li {
        margin-bottom: 10px;
    }

    .categories-section ul li a {
        text-decoration: none;
        color: #007bff;
    }

    .categories-section ul li a:hover {
        text-decoration: underline;
    }

    .text-right a {
        color: #007bff;
    }

    .text-right a:hover {
        text-decoration: underline;
    }
</style>

<!-- Hero Section -->
<section class="container-fluid banner animatedParent hero-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12  animated fast go fadeInLeft text-center">
                {{-- <div class="whitebox"> --}}
                    <h3>Enabling Decision Making for <span>B2B Customers</span></h3>
                    <!-- <h4><span>Discover Real Businesses with Real Reviews</span> to Choose Your Next Service Provider</h4> -->
                    <p>Discover <span>Real Businesses</span> with <span>Real Reviews<span> to Choose Your Next <span>Service Provider<span></p>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>

<!-- Provider Search Section -->
<section class="container-fluid provider-sec-box">
    <div class="provider-sec container">
        <form action="{{ url('companies') }}" method="POST" id="searchForm">
            @csrf
            <div class="inner">
                <!-- <p>I am looking for</p> -->
                <select class="form-control dropdown1 address" id="subcategories" name="services[]">
                    <span>I am looking for</span>
                    @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}" data-name="{{strtolower(str_replace(' ','-',$subcategory->subcategory))}}">{{$subcategory->subcategory}}</option>
                    @endforeach
                </select>
                <div class="d-flex align-items-center location">
                    <!-- <img src="{{asset('front_components/images/map1.png')}}" alt="" class="img-fluid mapcss"> -->
                    <select class="form-control address location dropdown2" id="locations" name="location"></select>
                </div>
                <button class="btn btn-secondary circle-button" onclick="setAction()"> <i class="icon fa fa-search"></i>
                <!-- Find Provider -->
            </button>
             
            </div>
        </form>
    </div>
</section>

<!-- Recent Reviews Section -->
<section class="container-fluid recent-reviews">
    <div class="container">
        <h3 class="text-center">Recent Reviews</h3>
        <p class="text-center they">They Cared to Share their Experiences.</p>
        <div class="row">
            @foreach($reviews as $review)
            <div class="col-md-4 reviewby recent">
                <div class="greybox">

               


                <div class="d-lg-flex userbox ">
                
                        <div class="d-lg-flex user-img">
                            <img src="{{ $review['user_image'] ?? asset('img/black-image.png') }}" alt=""
                                class="img-fluid d-md-inline d-table mx-auto">
                            <div class="user-name text-center text-md-left">
                                <!-- <h2>{{ $review->fullname }}</h2> -->
                                <h3 class="companyname"> {{ $review->company_name }} </h3>
                            </div>
                        </div>
                        <!-- <div class="text-center text-md-left reviewrate">
                            <br> {!! generateStarRating($review['overall_rating']) !!}
                        </div> -->
                    </div>
                    <p class="dotted"></p>




                    <div class="d-lg-flex reviewedbybox">
                    <p class="dotted"></p>
                        <div class="d-lg-flex user-img ">
                        <h4> <i style="font-size:19px" class="fa"></i> Reviewed By </h4>

                        </div></div>




                    <div class="d-lg-flex userbox">
                        <div class="d-lg-flex user-img ">
                       
                            <img src="{{ $review['user_image'] ?? asset('img/black-image.png') }}" alt=""
                                class="img-fluid d-md-inline d-table mx-auto">
                            <div class="user-name text-center text-md-left">
                                <h2>{{ $review->fullname }}</h2>
                                <h3>{{ $review->company_name }} | {{ $review->country }}</h3>
                                <h4>{{ $review->position_title }} </h4>
                            
                            
                            </div>
                        </div>
                        <div class="text-center text-md-left reviewrate">
                            <br> {!! generateStarRating($review['overall_rating']) !!}
                        </div>
                    </div>
                    <div class="user-col">
                        <div class="d-lg-flex reviewby pt-2">
                            <div class="ptitle mb-2 mb-lg-0"><button>Project Type</button></div>
                            <div>
                                <p>{{ $review['project_type'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Services Provided</button></div>
                            <div>
                                <p>{{  $review->how_effective }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Project Value</button></div>
                            <div>
                                <p>{{ $review['cost_range'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Client Size</button></div>
                            <div>
                                <p>{{ $review['company_size'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Client Industry</button></div>
                            <div>
                                <p>{{ $review['client_industry'] }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="dotted"></p>
                    <div class="d-flex reviewby">
                        <div class="ptitle"><button>Detailed Rating</button></div>
                    </div>
                    <div class="qualitybox row">
                        <div class="pt-4 qualityreview">
                            <button>Quality</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['quality']) !!}
                            </div>
                            <button>{{ $review['quality'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Timeliness</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['timeliness']) !!}
                            </div>
                            <button>{{ $review['timeliness'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Cost</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['cost']) !!}
                            </div>
                            <button>{{ $review['cost'] }}</button>
                        </div>
                        <div class="pt-2 qualityreview">
                            <button>Expertise</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['expertise']) !!}
                            </div>
                            <button>{{ $review['expertise'] }}</button>
                        </div>
                        <div class="pt-2 qualityreview">
                            <button>Communication</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['communication']) !!}
                            </div>
                            <button>{{ $review['communication'] }}</button>
                        </div>
                        <div class="pt-2 qualityreview">
                            <button>Ease of Working</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['ease_of_working']) !!}
                            </div>
                            <button>{{ $review['ease_of_working'] }}</button>
                        </div>
                        <div class="pt-2 qualityreview">
                            <button>Referability</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['refer_ability']) !!}
                            </div>
                            <button>{{ $review['refer_ability'] }}</button>
                        </div>
                    </div>
                    <p class="text-right"><a href="#">Read Full Review</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="container-fluid categories-section">
    <div class="container">
        <h3 class="text-center">Browse Providers by Category</h3>
        <p class="text-center">Explore service providers in just a click</p>
        <div class="row explorebox">
            @foreach($categories as $category)
                @if($category->subcategory->isNotEmpty())
                <div class="exploreinner ">        
                <div class="col-md-12 ">
                    <h4>{{ $category->category }}</h4>
                    <ul>
                        @foreach($category->subcategory->take(5) as $subcategory)
                        <li><a href="{{ url('companies/'.$category->slug.'/'.$subcategory->slug) }}">{{ $subcategory->subcategory }}</a></li>
                        @endforeach
                    </ul>
                </div>
                </div>
                @endif
            @endforeach
        </div>
        <p class="text-right"><a href="{{ url('categories') }}">Browse All Providers</a></p>
    </div>

    <section class="container-fluid skills-section">
        <div class="container">
            <h3 class="text-center">Browse Providers by Skills</h3>
            <p class="text-center">Explore service providers with specific skills in a click</p>
            <div class="row">
                @foreach($subcategories as $subcategory)
                    @if($subcategory->subcat_child->isNotEmpty())
                    <div class="skill-box">
                    <div class="col-md-12">
                        <h4>{{ $subcategory->subcategory }}</h4>
                        <ul>
                            @foreach($subcategory->subcat_child->take(5) as $child)
                            <li><a href="{{ url('companies/'.$subcategory->category->slug.'/'.$subcategory->slug.'/'.$child->slug) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <p class="text-right"><a href="{{ url('skills') }}">Browse All Skills</a></p>
        </div>
    </section>

@endsection

@section('script')



<section class="container-fluid movers-section">
        <div class="container">
            <h3 class="text-center">Movers & Shakers - Popular Skills</h3>
            <p class="text-center">Explore businesses from some of the most popular service categories</p>
            <div class="row   ">
                <div class="moversbox">
                        <div class="col-md-12 moverscol1">
                            
                            <div class="ptitle mb-2 mb-lg-0"><button>Menu 1</button></div>
                            <div class="ptitle mb-2 mb-lg-0"><button class="btn">Menu 2</button></div>
                        </div>
                        </div>


<!-- col2 -->
<div class="col2box">
<div class="col-md-12 ">
                            <h3> List of Digital Marketing Agencies </h3>
                           
                                <div class="row">
                                
                                    <div class="col-md-3">
                                    <div> <img src="https://theytrust-us.developmentserver.info/front_components/images/car.png" alt="" class="img-fluid">
                                    </div>
                                    </div>
                                    <div class="col-md-7">
                                      <div class="user-name text-center text-md-left">
                                       
                                       
                                        <h2>Company Name</h2>
                                        <div class="text-center text-md-left">
                                      <span class="fa fa-star checked"></span>
                                       <span class="fa fa-star checked"></span>
                                      <span class="fa fa-star checked"></span>
                                      <span class="fa fa-star"></span>
                                      <span class="fa fa-star"></span>
                                      </div>
                                        <p>9999 review</p>
                                     </div>
                                     </div>
                                     <div class="col-md-3">
                                     <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png" alt="" class="img-fluid">
                                     </div>
                                 </div>
                            
                         
                          
                        </div>
</div>



<!-- col3 -->
<div class="">
<div class="col-md-4 ">
</div>
</div>
<!-- col3 end -->
                        
                    </div>
           
            </div>
            </section>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('front_components/js/select2.min.js')}}"></script>
<script>
    var setAction;
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        jQuery('#subcategories').on('change', function () {
            var subcategory_id = jQuery(this).val();
            jQuery.ajax({
                url: "{{ url('get-location') }}",
                method: "POST",
                data: { subcategory_id: subcategory_id },
                success: function (res) {
                    jQuery('#locations').empty().append(res);
                }
            });
        });

        jQuery('#subcategories').trigger('change');

        setAction = function () {
            var service = $("#subcategories").find(':selected').data('name');
            var location = $("#locations").find(':selected').attr('data-name');
            if (location == undefined || location == '') {
                $('#searchForm').attr("action", "{{url('directory')}}/" + service);
            } else {
                $('#searchForm').attr("action", "{{url('directory')}}/" + service + '/' + location);
            }
            $('#searchForm').submit();
        }
    });

    $(document).ready(function () {
        $('#subcategories').select2();
    });
</script>
@endsection
