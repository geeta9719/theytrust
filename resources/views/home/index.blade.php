@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />
<style>
    /* Updated CSS styles */
    .hero-section {
        padding: 50px 0;
        background-color: #f5f5f5;
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
    }

    .hero-section img {
        max-width: 100%;
        height: auto;
    }

    /* Styles for the Provider Search Section */
    .provider-sec {
        background-color: #ffffff;
        padding: 50px 0;
        border-bottom: 1px solid #ddd;
    }

    .provider-sec .inner {
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
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
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
    }

    /* Styles for the Recent Reviews Section */
    .recent-reviews {
        padding: 50px 0;
        background-color: #f9f9f9;
    }

    .recent-reviews h3 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .recent-reviews p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .reviewby {
        margin-bottom: 30px;
    }

    .reviewby .greybox {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    .reviewby h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .reviewby .userbox {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
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

    .reviewby .qualityreview button {
        display: block;
        background: none;
        border: none;
        color: #007bff;
        font-size: 18px;
        cursor: pointer;
        margin-bottom: 5px;
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
        background: none;
        border: none;
        color: #333;
        font-weight: bold;
    }

    /* Utility Classes */
    .text-center {
        text-align: center;
    }

    .text-md-left {
        text-align: left;
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
        padding: 50px 0;
    }

    .categories-section h3 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .categories-section p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .categories-section h4 {
        font-size: 24px;
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
<section class="container-fluid banner animatedParent hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7  animated fast go fadeInLeft ">
                {{-- <div class="whitebox"> --}}
                    <h3>Enabling Decision Making for <span>B2B Customers</span></h3>
                    <h4><span>Discover Real Businesses with Real Reviews</span> to Choose Your Next Service Provider</h4>
                    <p>They Trust Us is instrumental in helping millions of <span>B2B</span> firms establish their trust and visibility for prospective customers</p>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>

<!-- Provider Search Section -->
<section class="container-fluid">
    <div class="provider-sec container">
        <form action="{{ url('companies') }}" method="POST" id="searchForm">
            @csrf
            <div class="inner">
                <p>I am looking for</p>
                <select class="form-control dropdown1 address" id="subcategories" name="services[]">
                    @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}" data-name="{{strtolower(str_replace(' ','-',$subcategory->subcategory))}}">{{$subcategory->subcategory}}</option>
                    @endforeach
                </select>
                <div class="d-flex align-items-center location">
                    <img src="{{asset('front_components/images/map1.png')}}" alt="" class="img-fluid mapcss">
                    <select class="form-control address location dropdown2" id="locations" name="location"></select>
                </div>
                <button class="btn btn-secondary" onclick="setAction()">Find Provider</button>
            </div>
        </form>
    </div>
</section>

<!-- Recent Reviews Section -->
<section class="container-fluid recent-reviews">
    <div class="container">
        <h3 class="text-center">Recent Reviews</h3>
        <p class="text-center">They Cared to Share their Experiences.</p>
        <div class="row">
            @foreach($reviews as $review)
            <div class="col-md-4 reviewby">
                <div class="greybox">
                    <div class="d-lg-flex userbox">
                        <div class="d-lg-flex user-img">
                            <img src="{{ $review['user_image'] ?? asset('img/black-image.png') }}" alt=""
                                class="img-fluid d-md-inline d-table mx-auto">
                            <div class="user-name text-center text-md-left">
                                <h2>{{ $review->fullname }}</h2>
                                <p>{{ $review->position_title }} | {{ $review->company_name }} | {{ $review->country }}</p>
                            </div>
                        </div>
                        <div class="text-center text-md-left">
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
                        <div class="pt-4 qualityreview">
                            <button>Expertise</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['expertise']) !!}
                            </div>
                            <button>{{ $review['expertise'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Communication</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['communication']) !!}
                            </div>
                            <button>{{ $review['communication'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Ease of Working</button>
                            <div class="star d-flex">
                                {!! generateStarChecked($review['ease_of_working']) !!}
                            </div>
                            <button>{{ $review['ease_of_working'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
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
        <div class="row">
            @foreach($categories as $category)
                @if($category->subcategory->isNotEmpty())
                <div class="col-md-3">
                    <h4>{{ $category->category }}</h4>
                    <ul>
                        @foreach($category->subcategory->take(5) as $subcategory)
                        <li><a href="{{ url('listing/'.$category->slug.'/'.$subcategory->slug) }}">{{ $subcategory->subcategory }}</a></li>
                        @endforeach
                    </ul>
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
                    <div class="col-md-3">
                        <h4>{{ $subcategory->subcategory }}</h4>
                        <ul>
                            @foreach($subcategory->subcat_child->take(5) as $child)
                            <li><a href="{{ url('listing/'.$subcategory->category->slug.'/'.$subcategory->slug.'/'.$child->slug) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                @endforeach
            </div>
            <p class="text-right"><a href="{{ url('skills') }}">Browse All Skills</a></p>
        </div>
    </section>

@endsection

@section('script')
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
