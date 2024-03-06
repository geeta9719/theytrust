@extends('layouts.home-master')
@section('content')


    <style>
        .verified-sec .veri {
            margin: auto;
            padding-top: 10px;
        }

        .alert-success {

            width: 36% !important;
            margin: auto auto 10px 23% !important;
            text-align: center;
        }

        .select2-container--default .select2-selection--multiple {
            width: 229px;
            margin-left: 2px;
        }

        .directory-blade .verified-sec a {
            display: flex;
        }

        .directory-blade .verified-sec a::after {
            content: url('https://theytrust-us.developmentserver.info/front_components/images/min-arrow.png');
            max-width: 30px;
            margin-left: 10px;
        }

        .emp p {
            margin-right: 10px;
            font-size: 16px;
            font-weight: 600;
        }

        .reviews-sec h3 {
            font-size: 20px;
            text-transform: capitalize;
            font-weight: bold;
        }

        .reviews-sec p {
            font-size: 1rem;
        }

        .scroll-content p b {
            color: #388cff;
        }

        .location-sec iframe {
            width: 100%;
            height: 100%;
            border-radius: 5px;
        }

        .location-sec p {
            font-size: 15px;
            margin: 0;
        }

        .scroll-content {
            display: inline-block;
            white-space: normal;
        }

        .scroll-container {
            width: 100%;
            white-space: nowrap;
            overflow-x: auto;
            height: 250px;
            padding-right: 15px;
        }



        .reviews-row {
            display: flex;
            justify-content: end;
        }

        .reviews-row .fa {
            font-size: 20px;
        }

        .bluestar {
            color: #388cff;
        }

        .reviews-row h3 {
            font-size: 16px;
        }

        .gray-bg {
            background-color: #f9f9fc;

        }

        .my-heading {
            font-size: 20px;
            text-transform: capitalize;
            font-weight: bold;
            margin: 0;
            padding: 8px 20px;
            background-color: #95c7ef;
            color: #fff;
            width: 100%;
            border-radius: 3px;
        }

        .target-sec h2.area {
            border-radius: 3px 0 0 3px;
        }

        .target-sec h2.industries {
            border-radius: 0 3px 3px 0;
        }

        .target-sec h3 {
            font-size: 14px;
            font-weight: bold;
            margin-top: 12px;
            margin-bottom: 0;

        }

        .reviews-row2 h3 {
            font-size: 1.75rem !important;
        }

        .btn-target {
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            border-radius: 0 0 5px 5px;
            text-decoration: none !important;
            display: block;
            color: #0087f2 !important;
            border-top: 0;
            font-weight: bold;
            transition: all .3s;

        }

        .btn-target:hover {
            color: #fff;
            text-decoration: none;
            background-color: #95c7ef;

        }

        .percentbox img {
            width: 42% !important;
        }

        .agency-sec p {
            font-size: 1rem;
        }

        .agency-sec a:hover {
            color: #007bff !important;
            text-decoration: underline !important;
            font-weight: 600 !important;
        }

        .agency-sec a {
            color: #007bff !important;
            text-decoration: underline !important;
            font-weight: 600 !important;
        }

        .faq p {
            font-size: 1rem;
        }

        .case-box .border {
            border: 1px solid #dee2e6 !important;
        }

        .review-by h3 {
            font-size: 15px;
        }

        .review-by p {
            font-size: 14px;
        }

        @media (max-width: 650px) {
            .alert-success {
                font-size: 13px;
                width: 100% !important;
                margin: auto auto 10px auto !important;
            }

        }
    </style>

    <!-- listing section start -->
    <section class="container-fluid list-top">
        <div class=" container">
            <a href="">Home | Company Profile</a>
            {{-- <h2>TheyTrustUsLogin</h2> --}}
        </div>
    </section>
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <section class="container-fluid mt-5 mb-5 list-box">
        <div class=" container">
            <div class="row">
                <div class="col-lg-12 col-md-7 firm-sec p-3 mt-4 mt-md-0 shadow directory-blade" id="addCompanyList">
                    <div class="row">
                        <div class="col-md-7">
                                <img src="{{ asset( $company->logo ) }}" alt="" class="img-fluid ">
                        </div>
                        <div class="col-md-5 text-right">
                            <div class="reviews-row">
                                <h3>{{ number_format((float)$rate_review->rating, 1) }}</h3>
                                <div class="px-3">
                                    @php
                                        $full_stars = floor($rate_review->rating);
                                        $half_star = ceil($rate_review->rating - $full_stars);
                                        $empty_stars = 5 - ($full_stars + $half_star);
                                    @endphp
                                    
                                    @for ($i = 0; $i < $full_stars; $i++)
                                        <i class="fa fa-star bluestar"></i>
                                    @endfor
                                    
                                    @if ($half_star)
                                        <i class="fa fa-star-half-o bluestar"></i>
                                    @endif
                                    
                                    @for ($i = 0; $i < $empty_stars; $i++)
                                        <i class="fa fa-star-o bluestar"></i>
                                    @endfor
                                </div>
                                <a href="https://theytrust-us.developmentserver.info/profile/102#reviewsec" target="_blank">
                                    <h3>1 REVIEWS</h3>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-5 target-sec">
                        <div class="col-md-8 pr-md-1">
                            <h2 class="area my-heading"> Target Services Area</h2>
                            <hr class="mt-2">
                            <div class="row mx-0 percentbox">
                                @foreach ($add_industry as $item)
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <h3>{{ $item->industry->name }}</h3>
                                            <div id="piechart_{{ str_replace('-', '_', Str::slug($item->industry->name))}}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                            <h2 class="industries my-heading">Target Industries</h2>
                            <hr class="mt-2 mb-4">
                            @foreach ($service_lines as $service_line)
                                <a href="#" class="btn-target">{{ $service_line->subcategory->subcategory }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="container mt-5 agency-sec">
                        <h2 class="my-heading"> Agency Profile</h2>
                        <hr>
                        <p>{{ $company->short_description}}</p>
                        <p><a href=""><u>Read More ></u></a></p>
                    </div>
                    <div class="container mt-5">
                        <h2 class="my-heading"> Locations</h2>
                        <hr>
                        <div class="row location-sec">
                            <div class="col-md-4">
                                <div class="scroll-container">
                                    <div class="scroll-content">
                                        @foreach($addresses as $address)
                                            <p class="address"><b>{{ $address->city }}</b></p>
                                            <p class="autocomplete">{{ $address->autocomplete }}</p>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="map" style="width: 100%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-5 reviews-sec">
                        <h2 class="my-heading"> Reviews
                        </h2>
                        <hr>
                        <div class="row align-items-end">
                            <div class="col-md-4 ">
                                <h3>Review Title </h3>
                                <p>dummy text of the printing and typesetting inddummdummy text of the printing and
                                    typesetting inddummdummy text of the printing and typesetting inddumm</p>
                            </div>
                            <div class="col-md-5 review-by">
                                <h3>Review By</h3>
                                <p>dummy text of the printing and typesetting
                                  dummy text of the printing and typesetting
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class=" row quality-sec ">
                            <div class="reviews-row2 d-flex align-items-center col-md-12 mt-2 ">
                                <div class="pl-0 pr-2">
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star-half-o bluestar"></i>
                                    <i class="fa fa-star-o bluestar"></i>
                                </div>
                                <h3>3.5 </h3>
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                        </div>
                    </div>
                    <div class="container my-5 faq">
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the
                                printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the
                                printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the
                                printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the
                                printing text of</p>
                        </div>
                    </div>
                    <div class="container mt-5 reviews-sec">
                        <h2 class="my-heading"> Portfolio / Case Studies
                        </h2>
                        <hr>
                        <div class="row align-items-end case-box">
                            @foreach($projects as $project)
                            <div class="col-md-4 mb-3">
                                <div class="border p-2 mb-2">
                                    <img src="{{ asset('storage/' . $project->thumbnail_image) }}" class="w-100">
                                    {{-- <img src="{{ $project->image_url }}" alt="" class="w-100" onerror="this.src='{{ asset('path/to/blank_image.jpg') }}';"> --}}
                                    <h3 class="mt-3 mb-2">{{ $project->title }}</h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        var showHideReview;
        var showHideAdd;
        $(document).ready(function() {
            showHideAdd = function(idd, idd1) {
                $("#" + idd).hide();
                $("#" + idd1).show();
            }
        });
        $(document).ready(function() {
            showHideReview = function(idd, idd1, idd2) {
                $("." + idd2).toggle();
                $("." + idd).hide();
                $("." + idd1).show();
            }
        });
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
    @foreach ($add_industry as $item)
        var containerId = "piechart_{{ str_replace('-', '_', Str::slug($item->industry->name)) }}";
        var containerElement = document.getElementById(containerId);
        if (containerElement) {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Percentage'],
                ['{{ $item->industry->name }}', {{$item->percent}}],
                ['', {{ 100 - $item->percent }}]
            ]);

            var options = {
                'title': '{{ $item->industry->name }}',
                'width': 150,
                'height': 100,
                'slices': {
                    0: { color: 'blue' },
                    1: { color: 'white' }
                }
            };
            var chart = new google.visualization.PieChart(containerElement);
            chart.draw(data, options);
        } else {
            console.error("Container element not found: " + containerId);
        }
    @endforeach
}

</script>

<script>
//    <script>
    function initMap() {
        var firstAddress = document.querySelector('.scroll-content .address');
        var city = firstAddress.querySelector('b').innerText;
        var autocomplete = firstAddress.nextElementSibling.innerText;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': autocomplete }, function (results, status) {
            if (status === 'OK' && results && results.length > 0) {
                var location = results[0].geometry.location;
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: location,
                    zoom: 8
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
        var addresses = document.querySelectorAll('.scroll-content .address');
        addresses.forEach(function(address) {
            address.addEventListener('click', function() {
                var city = this.querySelector('b').innerText;
                var autocomplete = this.nextElementSibling.innerText;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': autocomplete }, function (results, status) {
                    if (status === 'OK' && results && results.length > 0) {
                        var location = results[0].geometry.location;
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: location,
                            zoom: 8
                        });
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        });
    });
</script>
{{-- </script> --}}


<!-- Include Google Maps JavaScript API with your API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy836GvKy71SW3C0NQ3FdGkuNjlce_fOA&callback=initMap" async defer></script>

@endsection
