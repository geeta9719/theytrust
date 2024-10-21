@extends('layouts.home-master')
@section('content')

<head>
    <title>Portfolio Listing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/font-awesome.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/style1.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="https://theytrust-us.developmentserver.info/front_components/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
    <script src="{{ asset('portfolioimage/js/tab.js') }}"></script>
    




    
    <style>
        .portfolio .topsec h3 {
    font-size: 14px !important;
    font-weight: 500!important;
    color: #000000!important;}
    .portfolio .reviewrate {
    
    align-items: center!important;}
    .blue-write-review 
        {
width: auto!important;}
    
        .blue-write-review a
        {

            color: #379ae6 !important;
    text-decoration: underline;
    display: block;
    font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
        }
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
        .readmore a {
   
    color: #00bdd6 !important;
   
}


        @media (max-width: 767px) {

.write-review{
    float:none!important;
}


        }



    </style>
</head>

<body>
    <div class="container shadow portfolio py-3">
        <div class="row">
            <div class="col-lg-12  bg-white py-3">
                <div class="row topsec">
                    <div class="col-md-7">
                        <div class="row text-center text-md-left">
                            <div class="col-md-3 ">
                                <img src="{{ asset($company->logo)  }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-9 mt-2 mt-md-0">
                                <h2>{{ $company->name }}</h2>
                                <h3 class="mt-2 mt-md-0">{{ $company->tagline }}</h3>
                                <p>
                                    <span>{{ $company->rate }}</span>
                                    <span>{{ $company->size }} Employees</span>
                                    <span>{{ $company->budget }}</span>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right text-center pt-md-5 pt-2">
                        <div class="reviews-row text-center reviewrate">
                            <h3>{{ number_format($rate_review->rating, 1) }}</h3>
                            <div class="px-3 ">
                                {!! generateStarRating($rate_review->rating) !!}
                            </div>
                            <a href="{{ url('review/' . $company->id ) }}" target="_blank" class="reviewstxt">

                                <h3>{{ $reviews_count }} REVIEWS</h3>
                            </a>
                        </div>
                        {{-- <div class="write-review blue-write-review">
                            @if ($user && $plan && $review_limit > $reviews_count)
                                <a href="{{ url('company/' . $company->id . '/getReview') }}" class="btn btn-primary" target="_blank">
                                    Write a Review
                                </a>
                            @else
                                <p>You have reached the maximum number of reviews allowed by your plan.</p>
                            @endif
                        </div> --}}
                        <div class="write-review blue-write-review">
                            {{-- @if ($can_write_review) --}}
                                <a href="{{ url('company/' . $company->id . '/getReview') }}" class="btn btn-primary" target="_blank">
                                    Write a Review
                                </a>
                            {{-- @else --}}
                                {{-- <p>You have reached the maximum number of reviews allowed by your plan.</p> --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mt-md-2 target-sec">
                    <div class="col-md-8 pr-md-1">
                        <h2 class="area my-heading greybox mb-3"> Target Services Area</h2>
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
                    <div class="col-md-4 pl-md-1 ">
                        <h2 class="industries my-heading indusbox greybox mb-3"> Target Industries</h2>
                        @foreach ($add_industry as $industry)
                        <a href="#" class="btn-target ">{{ $industry->industry->name }}</a>
                        @endforeach
                    </div>
                </div>

              

                <div class="container mt-3 mt-md-2 greybox agency">
                    <h2 class="my-heading">Agency Profile</h2>
                    <p class="short-description">{{ $company->short_description }}</p>
                    <p class="text-md-right text-center mr-md-5 readmore">
                        <a href="javascript:void(0);" id="read-more-btn">READ MORE</a>
                    </p>
                </div>
                <div class="container mt-3 mt-md-2 greybox locations">
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
                                       
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 mt-md-0 mt-4">
                            <div id="map" >

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3265.698617944585!2d-80.71237452423959!3d35.064273372792705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x885425c5285ababf%3A0x6980335b83dbd955!2s1003%20Sultana%20Ln%2C%20Matthews%2C%20NC%2028104%2C%20USA!5e0!3m2!1sen!2sin!4v1722940683978!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>


           
                
                
                <div class="container  mt-3 mt-md-2 reviews-sec greybox">
                    <h2 class="my-heading"> Reviews </h2>
                    @foreach ($reviews as $review)
                        <x-review :review="$review" />
                    @endforeach
                </div>

                <div class="container mt-3 mx-3 mt-md-5 reviews-sec greybox">
                    <h2 class="my-heading"> Portfolio / Case Studies </h2>
                    @foreach ($caseStudies as $caseStudy)
                        <x-portfolio :portfolio="$caseStudy" />
                    @endforeach
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('portfolio', ['company' => $company->id]) }}" class="btn btn-primary">View All</a>
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

<script src="{{ asset('front_components/js/jquery.js') }}"> </script>
<script src="{{ asset('front_components/js/tab.js') }}"> </script>
@endsection