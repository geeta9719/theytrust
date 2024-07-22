@extends('layouts.home-master')
@section('content')

<head>
    <title>Portfolio Listing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
    <script src="{{ asset('portfolioimage/js/tab.js') }}"></script>
    <style>
        .short-description {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            line-height: 1.5;
            /* Adjust based on your text line height */
            max-height: 3em;
            /* line-height * number of lines */
            position: relative;
        }

        .short-description.expanded {
            -webkit-line-clamp: unset;
            max-height: none;
        }
    </style>
</head>

<body>
    <div class="container portfolio">
        <div class="row">
            <div class="col-lg-12 shadow bg-white py-3">
                <div class="row topsec">
                    <div class="col-md-7">
                        <div class="row text-center text-md-left">
                            <div class="col-md-3 ">
                                <img src="{{ asset($company->logo)  }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-8 mt-2 mt-md-0">
                                <h2>{{ $company->name }}</h2>
                                <h3>{{ $company->tagline }}</h3>
                                <p>
                                    <span>{{ $company->rate }}</span>
                                    <span>{{ $company->size }} Employees</span>
                                    <span>{{ $company->budget }}</span>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right">
                        <div class="reviews-row text-center">
                            <h3>{{ number_format($rate_review->rating, 1) }}</h3>
                            <div class="px-3">
                                {!! generateStarRating($rate_review->rating) !!}
                            </div>
                            <a href="{{ url('review/' . $company->id ) }}" target="_blank" class="">

                                <h3>{{ $rate_review->review }} REVIEWS</h3>
                            </a>
                        </div>
                        <div class="write-review mt-3">
                            <a href="{{ url('company/' . $company->id.'/getReview' ) }}" class="btn btn-primary" target="_blank">
                              Write a Review
                            </a>
                          </div>  
                    </div>
                </div>
                <div class="row mt-5 target-sec">
                    <div class="col-md-8 pr-md-1">
                        <h2 class="area my-heading greybox"> Target Services Area</h2>
                        <div class="row mx-0 target-service">
                            @foreach ($service_lines as $service)
                            <div class="col-md-6 pb-2 text-center mb-2 mb-lg-0">
                                <div class="d-flex align-items-center">
                                    <canvas class="progress-circle" data-percentage="{{ $service->percent }}"></canvas>
                                    <h3>{{ $service->category->category }}</h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                        <h2 class="industries my-heading indusbox"> Target Industries</h2>
                        @foreach ($add_industry as $industry)
                        <a href="#" class="btn-target mt-lg-4 mt-0 pt-4 pt-lg-4">{{ $industry->industry->name }}</a>
                        @endforeach
                    </div>
                </div>



                <div class="container mt-5 greybox agency">
                    <h2 class="my-heading">Agency Profile</h2>
                    <p class="short-description">{{ $company->short_description }}</p>
                    <p class="text-md-right text-center mr-md-5 readmore">
                        <a href="javascript:void(0);" id="read-more-btn">READ MORE</a>
                    </p>
                </div>
                <div class="container mt-5 greybox locations">
                    <h2 class="my-heading">Locations</h2>
                    <div class="row location-sec">
                        <div class="col-md-4">
                            <div class="scroll-container">
                                <div class="scroll-content">
                                    @foreach ($addresses as $address)
                                        <p class="address">
                                            <b>{{ $address->city }}</b>
                                        </p>
                                        <p>{{ $address->autocomplete }}</p>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 mt-md-0 mt-4">
                            <div id="map" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
                
                
                <div class="container mt-5 reviews-sec greybox">
                    <h2 class="my-heading"> Reviews </h2>
                    @foreach ($reviews as $review)
                        <x-review :review="$review" />
                    @endforeach
                </div>
                <div class="container mt-5 reviews-sec greybox">
                    <h2 class="my-heading"> Portfolio / Case Studies </h2>
                    @foreach ($caseStudies as $caseStudy)
                        <x-portfolio :portfolio="$caseStudy" />
                    @endforeach
                </div>
            
        </div>
    </div>
    </div>
</body>

<script>


        $(document).ready(function() {
            $('.tabs-nav a').on('click', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $tabs = $this.closest('.tabs');
                var $tabsContent = $tabs.find('.tabs-content');

                $tabs.find('.tabs-nav a').removeClass('active');
                $this.addClass('active');

                $tabsContent.find('.tab-content').hide();
                $($this.attr('href')).show();
            });

            $('.tabs').each(function() {
                $(this).find('.tabs-nav a:first').click();
            });
        });
    $(document).ready(function() {
    $('.progress-circle').each(function() {
        var canvas = this;
        var context = canvas.getContext('2d');
        var percentage = $(canvas).data('percentage');

        canvas.width = 100;
        canvas.height = 100;

        var startAngle = -0.5 * Math.PI; // Start from the top
        var endAngle = (percentage / 100) * 2 * Math.PI - 0.5 * Math.PI;
        var counterClockwise = false;

        context.lineWidth = 10;
        context.strokeStyle = '#00f'; // Color of the progress circle

        // Draw the background circle
        context.beginPath();
        context.arc(50, 50, 40, 0, 2 * Math.PI, counterClockwise);
        context.strokeStyle = '#eee';
        context.stroke();

        // Draw the progress circle
        context.beginPath();
        context.arc(50, 50, 40, startAngle, endAngle, counterClockwise);
        context.strokeStyle = '#00f';
        context.stroke();

        // Draw the percentage text
        context.font = '16px Arial';
        context.fillStyle = '#000';
        context.textAlign = 'center';
        context.textBaseline = 'middle';
        context.fillText(percentage + '%', 50, 50);
    });
    
});
document.addEventListener("DOMContentLoaded", function() {
    var readMoreBtn = document.getElementById("read-more-btn");
    var shortDescription = document.querySelector(".short-description");

    readMoreBtn.addEventListener("click", function() {
        shortDescription.classList.toggle("expanded");
        if (shortDescription.classList.contains("expanded")) {
            readMoreBtn.textContent = "READ LESS";
        } else {
            readMoreBtn.textContent = "READ MORE";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
        // Show the first tab by default
        document.querySelector('#tabs-nav li:first-child a').click();

        // Handle tab clicks
        document.querySelectorAll('#tabs-nav a').forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('#tabs-nav a').forEach(function(link) {
                    link.classList.remove('active');
                });
                tab.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(function(content) {
                    content.style.display = 'none';
                });
                document.querySelector(tab.getAttribute('href')).style.display = 'block';
            });
        });
    });

$(document).ready(function() {
    $('#tabs-nav li a').click(function(e) {
        e.preventDefault();
        
        // Get the target tab id from href attribute
        var tabId = $(this).attr('href');
        
        // Hide all tab contents
        $('.tab-content').hide();
        
        // Show the clicked tab content
        $(tabId).show();
    });
});
      
    
// function initMap() {
//         var firstAddress = document.querySelector('.scroll-content .address');
//         if (firstAddress) {
//             var city = firstAddress.querySelector('b').innerText;
//             var autocomplete = firstAddress.nextElementSibling.innerText;
//             geocodeAddress(autocomplete, function(location) {
//                 createMap(location);
//             });
//         }

//         var addresses = document.querySelectorAll('.scroll-content .address');
//         addresses.forEach(function(address) {
//             address.addEventListener('click', function() {
//                 var city = this.querySelector('b').innerText;
//                 var autocomplete = this.nextElementSibling.innerText;
//                 geocodeAddress(autocomplete, function(location) {
//                     createMap(location);
//                 });
//             });
//         });
//     }

//     function geocodeAddress(address, callback) {
//         var geocoder = new google.maps.Geocoder();
//         geocoder.geocode({'address': address}, function(results, status) {
//             if (status === 'OK' && results && results.length > 0) {
//                 callback(results[0].geometry.location);
//             } else {
//                 alert('Geocode was not successful for the following reason: ' + status);
//             }
//         });
//     }

//     function createMap(location) {
//         var map = new google.maps.Map(document.getElementById('map'), {
//             center: location,
//             zoom: 8
//         });
//         new google.maps.Marker({
//             position: location,
//             map: map
//         });
//     }

    document.addEventListener("DOMContentLoaded", function() {
        // initMap();
    });
    

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9YeE5IDfcAUalQ8G26_crBmKoHYvoN5I&callback=initMap"
async defer></script>
@endsection