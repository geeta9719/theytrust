@extends('layouts.home-master')
@section('content')
    <head>
        <title>Portfolio Listing</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/font-awesome.min.css') }}" />
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/style1.css') }}"> -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://theytrust-us.developmentserver.info/front_components/css/custom.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
        <script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
        <script src="{{ asset('portfolioimage/js/tab.js') }}"></script>

        <style>
            .row.button-section {
                margin: auto !important;
            }
            .next-btn:hover {
                color: #000;
            }
            .portfolio .reviews-row h3{
                background-color: #006d7c;
    padding: 11px;
    border-radius: 63%;
    color: #fff !important;
            }
            .sidebar-review-box .qualitybox {
                display: none;
                flex-wrap: wrap;
                gap: 0;
                margin-top: 20px;
            }
            .portfolio .sidebar-review-box .col-md-4{
                padding:0;
            }
            .next-btn {
                color: #fff;
                background-color: #00bdd6;
                border-color: #00bdd6;
                border-radius: 5px;
                padding: 5px 24px 6px 23px;
                font-size: 13px;
                margin-left: 12px;
            }
            .portfolio .topsec p {
    margin-top: 20px;
    margin-right: 20px!important;
}
            .portfolio .topsec h3 {
                font-family: Epilogue!important;
                font-size: 20px!important;
                font-weight: 700 !important;
                color: #171A1FFF !important;
                margin:0;
               
            }
            .portfolio .reviewrate {
                align-items: center !important;
            }
            .blue-write-review {
                width: auto !important;
            }

            .blue-write-review a {
                color: #00bdd6 !important;
                text-decoration: underline;
                display: block;
                font-size: 14px;
                font-weight: 400;
                font-family: 'Inter', sans-serif;
            }
            .fa{          margin-right: 4px;}
  
            .bluestar {
                color: #00bdd6;
  font-size: 24px; /* Adjust size as needed */
}
.portfolio-top .topsec h2 {
    font-size: 41px !important;
    font-family: Epilogue; /* Heading */
}



            .portfolio .topsec .ratio{
            font-size: 14px !important;
    font-weight: 500 !important;
    color: #fff !important;
    background-color: #006d7c;
    padding: 10px 7px 7px 7px;
    border-radius: 35px;}


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
.info-box h2{
    color: #000;
    font-size:35px;
}
  
.info-box h4{
    color: #000;
    font-size:20px;
}
.short-description.expanded {
                -webkit-line-clamp: unset;
                max-height: none;
            }
            .readmore a {
                color: #000 !important;
            }
            .breadcrumb li a {
                color: #00bdd6 !important;
                text-decoration:none;
                font-size:15px;
            }
            .breadcrumb {
                color: #00bdd6 !important;
                background-color: #ffffff;
  
                  } 
            .breadcrumb-item+.breadcrumb-item::before
            {  content: ">";
            }
            .portfolio-top ul#tabs-nav li:hover, .portfolio-top ul#tabs-nav li.active {
             background-color: #0095a9;
             }
             .portfolio-top{
                padding:0;
             }
            .portfolio-top ul#tabs-nav li{
                background-color: #00BDD6FF;
                padding: 7px 33px;
             }

            

.portfolio-top #tabs-nav li a {
    text-decoration: none;
    color: #FFF;
    font-size:15px;
}
.portfolio-top ul#tabs-nav {
    list-style: none;
    margin: 0;
    padding: 0px;
    overflow: auto;
    background-color: #fff;
    display: flex;
    justify-content: space-between;
}
.purple{
background-color:#b9a8e4!important;
}
.portfolio .reviewrate {
float: none; 
margin-top: 2px;
}
.review-box{
display:flex;
align-items: center;
}
.write-txt{
    color:#00bdd6;
}
.reviews-row a{
  font-family: Inter; 
  font-size: 14px; 
  font-weight: 400; 
  color: #00BDD6FF; 
margin-left:0px;
text-decoration:none;
}
.working-hr-box{
    display:flex;
}
.working-hr{
    font-size: 14px !important;
    margin-top: 11px;
    margin-left: 4px;
    margin-bottom: 36px;
}
.scroll-content p{
    font-weight: 400;
    font-size: 16px;
    margin: 0;
}
.my-heading {
  font-family: Epilogue; /* Heading */
  font-size: 28px; 
  line-height: 58px; 
  font-weight: 700; 
  color: #171A1FFF; /* neutral-900 */
  background: #00BDD6FF; /* primary-500 */
  border-radius: 0px; 
  padding:10px;
}
.portfolio .topsec h3 {
    font-family: Epilogue !important;
    font-size: 29px !important;
    font-weight: 700 !important;
    color: #171A1FFF !important;
}
.portfolio .topsec h4 {
    font-family: Epilogue !important;
    font-size: 21px !important;
    color: #171A1FFF !important;
}
.scroll-content p{
    font-weight:400px;
}
.write-txt{
    margin-left:10px!important;
    text-decoration:underline;
}
.working-hr span{
    font-size: 12px !important;
    font-weight: 400;
    margin-right: 0px;
    font-size: 1rem;
    background: #00bdd6;
    padding: 6px 6px;
    border-radius: 17px;
    color: #fff;
    margin-left: 9px;
}
.review-box h5 {
    color: #000;
    font-size: 18px;
    font-weight:700;
}
.details p{
    font-size: 15px!important;
}
@media (max-width: 767px) {
    .breadcrumb {
    
    font-size: 10px;
}
.portfolio .sidebar-review-box .userbox {
    justify-content: center;
    margin: 3px 44px;
}
    .short-description{
        margin-left: 25px;   
    }
    .tab-content p{
        margin: 0 25px; 
    }
    .user-col p{
        margin: 0 25px; 
    }
    .portfolio .scroll-content {
   
    margin-left: 25px;
}
    .working-hr {

margin-bottom: 14px;
}
    .portfolio .topsec h4 {
    margin-bottom: 36px;
}
.portfolio .topsec .ratio {
    font-size: 14px !important;
        font-weight: 500 !important;
        color: #fff !important;
        background-color: #006d7c;
        padding: 6px;
        border-radius: 62%;
        width: 25%;
}
.portfolio .reviews-row .fa {
    font-size: 14px;
    margin-left: 0px;
}
    .review-box{display:flex;
        align-items: center;
        justify-content: center;
    }
    .working-hr-box{
    display:block;
}
    .target-sec a {
    
    margin: 0 20px;
}
.write-review {
float: none !important;
}
.portfolio-top ul#tabs-nav{
    display:block;
}
.portfolio ul#tabs-nav li {
        width: 100%;
        border: 0;
    }
}
@media (max-width: 991px) {
    .portfolio ul#tabs-nav {
        display: block;
    }
}
        </style>
    </head>

    <body>
    <div class="container portfolio-top">
    <nav aria-label="Breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/category">Category</a></li>
    <li class="breadcrumb-item"><a href="/category/subcategory">Subcategory</a></li>
    <li class="breadcrumb-item active" aria-current="page">Current Page</li>
  </ol>
</nav>
     <ul id="tabs-nav"  class="tabs">
         <li class="active tab-btn" onclick="showTab(event, 'tab1')"><a href="#tab1"><i style="font-size:17px" class="fa"></i> PROFILE</a></li>
         <li class="tab-btn" onclick="showTab(event, 'tab2')"><a href="#tab2"><i style="font-size:17px" class="fa"></i> REVIEWS
                 </a></li>
         <li><a href="#tab3"><i style="font-size:17px" class="fa"></i> PORTFOLIO
                 </a></li>
         <li><a href="#tab4"><i style="font-size:17px" class="fa"></i>BUNDLES</a></li>
         <li><a href="#tab4"><i style="font-size:17px" class="fa"></i>PROJECTS</a></li>
         <li class="purple"><a href="#tab4"><i style="font-size:17px" class="fa"></i>REQUEST A QUOTE</a></li>
         <li class="purple"><a href="#tab4"><i style="font-size:17px" class="fa"></i>WWW</a></li>
     </ul>
 </div>








 <div class="tab-content" id="tab1">

        <div class="container shadow portfolio portfolio-top py-3 mb-5">
            <div class="row">
                <div class="col-lg-12 bg-white py-md-3 p-0">
                    <div class="row top-sec">
                        <div class="col-md-8">
                            <div class="row text-center text-md-left">
                                <div class="col-md-3">
                                    <img src="{{ asset($company->logo) }}" alt="" class="border img-fluid" />
                                </div>
                                <div class="col-md-9 mt-2 mt-md-0 info-box">
                                    <h2>{{ $company->name }}</h2>
                                    <h4 class="mt-2 mt-md-0 mb-md-2 mb-4">{{ $company->tagline }}</h4>
                                    <div class="review-box mt-md-5">
                                    <div class="reviews-row text-center reviewrate">
                               <div class="review-box writereview">
                               
                                    <h3 class="ratio">{{ number_format($rate_review->rating, 1) }}</h3>
                                <div class="pl-md-3 pr-md-2">
                                    {!! generateStarRating($rate_review->rating) !!}
                                </div>
                                </div>
                                <div class="review-box">
                                @if ($reviews_count > 0)
                                    <a href="{{ url('review/' . $company->id) }}" target="_blank" class="reviewstxt">
                                        <h5>{{ $reviews_count }} REVIEWS</h5>
                                    </a>
                                @else
                                    <p class="mb-0">No Reviews</p>
                                @endif
<!-- write -->
                                @if (auth()->check() && auth()->user()->id === $company->user_id)
                                    <a href="{{ route('comapany.reviews.request.index') }}" class="btn btn-primary">
                                        Reqest a Review
                                    </a>
                                @else
                                    <a
                                        href="{{ url('company/' . $company->id . '/getReview') }}"
                                        class="write-txt"
                                        target="_blank"
                                    >
                                        Write a Review
                                    </a>
                                @endif
                                </div>
                            </div>
                            <div class="write-review blue-write-review">
                                <!-- @if (auth()->check() && auth()->user()->id === $company->user_id)
                                    <a href="{{ route('comapany.reviews.request.index') }}" class="btn btn-primary">
                                        Reqest a Review
                                    </a>
                                @else
                                    <a
                                        href="{{ url('company/' . $company->id . '/getReview') }}"
                                        class="write-txt"
                                        target="_blank"
                                    >
                                        Write a Review
                                    </a>
                                @endif -->
                            </div>
                           </div> 
                           <div class="working-hr-box">
                            <p class="working-hr">  <span>Hourly Rate</span> {{ $company->rate }} </p>
                            <p class="working-hr">  <span># of Employees</span> {{ $company->size }}  </p>
                            <p class="working-hr">  <span>Min Project Size</span> {{ $company->budget }} </p>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right text-center pt-md-0 pt-2 border-left border-bottom">

                        <img src="https://theytrust-us.developmentserver.info/front_components/images/scores.png" alt=""  class="img-fluid">
                            <!-- <div class="reviews-row text-center reviewrate">
                                <h3>{{ number_format($rate_review->rating, 1) }}</h3>
                                <div class="px-3">
                                    {!! generateStarRating($rate_review->rating) !!}
                                </div>

                                @if ($reviews_count > 0)
                                    <a href="{{ url('review/' . $company->id) }}" target="_blank" class="reviewstxt">
                                        <h3>{{ $reviews_count }} REVIEWS</h3>
                                    </a>
                                @else
                                    <p class="text-muted">No Reviews</p>
                                @endif
                            </div>
                            <div class="write-review blue-write-review">
                                @if (auth()->check() && auth()->user()->id === $company->user_id)
                                    <a href="{{ route('comapany.reviews.request.index') }}" class="btn btn-primary">
                                        Reqest a Review
                                    </a>
                                @else
                                    <a
                                        href="{{ url('company/' . $company->id . '/getReview') }}"
                                        class="btn btn-primary"
                                        target="_blank"
                                    >
                                        Write a Review
                                    </a>
                                @endif
                            </div> -->
                        </div>
                    </div>
                    <div class="row  target-sec border-bottom">
                        <div class="col-md-8 pr-md-1 border-right pr-0">
                            <h2 class="area my-heading greybox mb-3 mt-md-4">Target Services Area</h2>
                            <div class="row mx-0 target-service">
                                @foreach ($service_lines as $service)
                                    <div class="col-md-6 pb-2 text-center mb-2 mb-lg-0">
                                        <div class="d-flex align-items-center">
                                            <canvas
                                                class="progress-circle"
                                                data-percentage="{{ $service->percent }}"
                                            ></canvas>
                                            <h3>{{ $service->category->category }}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 pl-md-3 p-0">
                            <h2 class="industries mt-md-4 my-heading indusbox greybox mb-3">Target Industries</h2>
                            @foreach ($add_industry as $industry)
                                <a href="#" class="btn-target">{{ $industry->industry->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="container mt-3 mt-md-3 p-0 greybox agency border-bottom">
                        <h2 class="my-heading">Agency Profile</h2>
                        <p class="short-description">{{ $company->short_description }}</p>
                        <p class="text-md-right text-center mr-md-5 readmore">
                            <a href="javascript:void(0);" id="read-more-btn">READ MORE</a>
                        </p>
                    </div>
                    <div class="container mt-3 mt-md-5 p-0 greybox locations border-bottom">
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
                                <div id="map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3265.698617944585!2d-80.71237452423959!3d35.064273372792705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x885425c5285ababf%3A0x6980335b83dbd955!2s1003%20Sultana%20Ln%2C%20Matthews%2C%20NC%2028104%2C%20USA!5e0!3m2!1sen!2sin!4v1722940683978!5m2!1sen!2sin"
                                        width="100%"
                                        height="250"
                                        style="border: 0"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<div class="tab-content" id="tab2">
                    <div class="container mt-3 mt-md-3 p-0 reviews-sec greybox border-bottom">
                        <h2 class="my-heading">Reviews</h2>
                        @foreach ($reviews as $review)
                            <x-review :review="$review" />
                        @endforeach
                    </div>
</div>
                    <div class="container mt-3  mt-md-3 p-0 reviews-sec greybox border-bottom">
                        <h2 class="my-heading">Portfolio / Case Studies</h2>
                        @foreach ($caseStudies as $caseStudy)
                            <x-portfolio :portfolio="$caseStudy" />
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('portfolio', ['company' => $company->id]) }}" class="submitbtn next-btn">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(function () {
            $('.tabs-nav a').on('click', function (e) {
                e.preventDefault()
                var $this = $(this)
                var $tabs = $this.closest('.tabs')
                var $tabsContent = $tabs.find('.tabs-content')

                $tabs.find('.tabs-nav a').removeClass('active')
                $this.addClass('active')

                $tabsContent.find('.tab-content').hide()
                $($this.attr('href')).show()
            })

            $('.tabs').each(function () {
                $(this).find('.tabs-nav a:first').click()
            })
        })
        $(document).ready(function () {
            $('.progress-circle').each(function () {
                var canvas = this
                var context = canvas.getContext('2d')
                var percentage = $(canvas).data('percentage')

                canvas.width = 100
                canvas.height = 100

                var startAngle = -0.5 * Math.PI // Start from the top
                var endAngle = (percentage / 100) * 2 * Math.PI - 0.5 * Math.PI
                var counterClockwise = false

                context.lineWidth = 10
                context.strokeStyle = '#00f' // Color of the progress circle

                // Draw the background circle
                context.beginPath()
                context.arc(50, 50, 40, 0, 2 * Math.PI, counterClockwise)
                context.strokeStyle = '#eee'
                context.stroke()

                // Draw the progress circle
                context.beginPath()
                context.arc(50, 50, 40, startAngle, endAngle, counterClockwise)
                context.strokeStyle = '#00f'
                context.stroke()

                // Draw the percentage text
                context.font = '16px Arial'
                context.fillStyle = '#000'
                context.textAlign = 'center'
                context.textBaseline = 'middle'
                context.fillText(percentage + '%', 50, 50)
            })
        })
        document.addEventListener('DOMContentLoaded', function () {
            var readMoreBtn = document.getElementById('read-more-btn')
            var shortDescription = document.querySelector('.short-description')

            readMoreBtn.addEventListener('click', function () {
                shortDescription.classList.toggle('expanded')
                if (shortDescription.classList.contains('expanded')) {
                    readMoreBtn.textContent = 'READ LESS'
                } else {
                    readMoreBtn.textContent = 'READ MORE'
                }
            })
        })

        document.addEventListener('DOMContentLoaded', function () {
            // Show the first tab by default
            document.querySelector('#tabs-nav li:first-child a').click()

            // Handle tab clicks
            document.querySelectorAll('#tabs-nav a').forEach(function (tab) {
                tab.addEventListener('click', function (e) {
                    e.preventDefault()
                    document.querySelectorAll('#tabs-nav a').forEach(function (link) {
                        link.classList.remove('active')
                    })
                    tab.classList.add('active')
                    document.querySelectorAll('.tab-content').forEach(function (content) {
                        content.style.display = 'none'
                    })
                    document.querySelector(tab.getAttribute('href')).style.display = 'block'
                })
            })
        })

        $(document).ready(function () {
            $('#tabs-nav li a').click(function (e) {
                e.preventDefault()

                // Get the target tab id from href attribute
                var tabId = $(this).attr('href')

                // Hide all tab contents
                $('.tab-content').hide()

                // Show the clicked tab content
                $(tabId).show()
            })
        })

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

        document.addEventListener('DOMContentLoaded', function () {
            // initMap();
        })
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9YeE5IDfcAUalQ8G26_crBmKoHYvoN5I&callback=initMap"
        async
        defer
    ></script>
<script>
    function showTab(event, tabId) {
  // Hide all tab contents
  const allTabs = document.querySelectorAll('.tab-contents');
  allTabs.forEach(tab => tab.classList.remove('active'));

  // Show the selected tab
  const activeTab = document.getElementById(tabId);
  activeTab.classList.add('active');
}
</script>
    <script src="{{ asset('front_components/js/jquery.js') }}"></script>
    <script src="{{ asset('front_components/js/tab.js') }}"></script>
@endsection
