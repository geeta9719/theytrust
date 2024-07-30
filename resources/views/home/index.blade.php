@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://theytrust-us.developmentserver.info/front_components/css/custom.css">













<!-- Hero Section -->
<section class="container-fluid banner animatedParent hero-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12  animated fast go fadeInLeft text-center">
                {{-- <div class="whitebox"> --}}
                <h3>Enabling Decision Making for <span>B2B Customers</span></h3>
                <!-- <h4><span>Discover Real Businesses with Real Reviews</span> to Choose Your Next Service Provider</h4> -->
                <p>Discover <span>Real Businesses</span> with <span>Real Reviews<span> to Choose Your Next <span>Service
                                Provider<span></p>
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
                    <option value="{{$subcategory->id}}"
                        data-name="{{strtolower(str_replace(' ','-',$subcategory->subcategory))}}">
                        {{$subcategory->subcategory}}</option>
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
            <div class="col-md-6 col-lg-4 reviewby recent mx-auto">
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
                        </div>
                    </div>
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
                                {!! generateStarRating($review['quality']) !!}
                            </div>
                            <button>{{ $review['quality'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Timeliness</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['timeliness']) !!}
                            </div>
                            <button>{{ $review['timeliness'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Cost</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['cost']) !!}
                            </div>
                            <button>{{ $review['cost'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Expertise</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['expertise']) !!}
                            </div>
                            <button>{{ $review['expertise'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Communication</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['communication']) !!}
                            </div>
                            <button>{{ $review['communication'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Ease of Working</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['ease_of_working']) !!}
                            </div>
                            <button>{{ $review['ease_of_working'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Referability</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['refer_ability']) !!}
                            </div>
                            <button>{{ $review['refer_ability'] }}</button>
                        </div>
                    </div>
                    <p class="text-right"><a href="{{ url('/review/' . $review->company_id) }}">Read Full Review</a></p>
                    <!-- <p class="text-right"><a href="#">Read Full Review</a></p> -->
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
        <div class="row explorebox justify-content-center">
            @foreach($categories as $category)
            @if($category->subcategory->isNotEmpty())
            <div class="exploreinner ">
                <div class="col-md-12 ">
                    <h4>{{ $category->category }}</h4>
                    <ul>
                        @foreach($category->subcategory->take(5) as $subcategory)
                        <li><a
                                href="{{ url('listing/'.$category->slug.'/'.$subcategory->slug) }}">{{ $subcategory->subcategory }}</a>
                        </li>
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
            <div class="row justify-content-center">
                @foreach($subcategories as $subcategory)
                @if($subcategory->subcat_child->isNotEmpty())
                <div class="skill-box">
                    <div class="col-md-12">
                        <h4>{{ $subcategory->subcategory }}</h4>
                        <ul>
                            @foreach($subcategory->subcat_child->take(5) as $child)
                            <li><a
                                    href="{{ url('listing/'.$subcategory->category->slug.'/'.$subcategory->slug.'/'.$child->slug) }}">{{ $child->name }}</a>
                            </li>
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
            <div class="row  mt-5  ">
                <div class="col-lg-3 col-md-6">
                    <div class="moversbox">
                        <div class="col-md-12 moverscol1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Menu 1</button></div>
                            <div class="ptitle mb-2 mb-lg-0"><button class="btn">Menu 2</button></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6">
                    <h3> List of Digital Marketing Agencies </h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col2box">
                                <div class="col-md-12 ">

                                    <div class="listboxinner">
                                        <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="col2box">
                                <div class="col-md-12 ">

                                    <div class="listboxinner">
                                    <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-3 p-0">
                                                <div> <img
                                                        src="https://theytrust-us.developmentserver.info/front_components/images/car.png"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-7 listbox">
                                                <div>
                                                    <h2>Company Name</h2>
                                                    <div>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <a href="">9999 review</a>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="https://theytrust-us.developmentserver.info/front_components/images/heart.png"
                                                    alt="" class="img-fluid">
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
                    data: {
                        subcategory_id: subcategory_id
                    },
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