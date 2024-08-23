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
        .starbox{
            margin-top:-8px;
        }
        .topsec h3{
            margin-top:-2px;
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
        .reviewuppercase{
            color:#000;
        }
        .writereview{
            align-items: baseline;
        }
        .write{
            text-decoration:underline;
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
                                <img src="https://theytrust-us.developmentserver.info/storage/images/logo/JPs1fNEQ5UCGh1xu2NqD54a4QIlN4BIErWAy9NF0.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-8 mt-2 mt-md-0">
                                <h2>{{ $reviews[0]->company->name }}</h2>
                                <div class="d-flex mt-3 writereview">
                            <h3>3.5 </h3>
                            <div class="px-3 starbox"><i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star-half-o bluestar"></i>
                                <i class="fa fa-star-o bluestar"></i>
                            </div>
                            <a href="https://theytrust-us.developmentserver.info/profile/102#reviewsec" target="_blank" class="mr-2 reviewuppercase">
                                {{  $reviews->count() }} REVIEWS
                            </a>
                            <a href="/company/{{ $reviews[0]->company->id }}/getReview" target="_blank" class="write">
                                Write a Review
                            </a>
                            
                        </div>
        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right">
                        <div class="reviews-row text-center ">
                            <!-- <h3>3.5 </h3>
                            <div class="px-3"><i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star-half-o bluestar"></i>
                                <i class="fa fa-star-o bluestar"></i>
                            </div>
                            <a href="https://theytrust-us.developmentserver.info/profile/102#reviewsec" target="_blank" class="">
                                <h3>1 REVIEWS</h3>
                            </a> -->
                            <img src="https://theytrust-us.developmentserver.info/front_components/images/score.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="container mt-1 reviews-sec greybox">
                    <h2 class="my-heading"> Reviews </h2>
                    @foreach ($reviews as $review)
                        <x-review :review="$review" />
                    @endforeach
                    
                    <!-- Pagination links -->
                    <div class="d-flex justify-content-center">
                        {{ $reviews->links() }}
                    </div>
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9YeE5IDfcAUalQ8G26_crBmKoHYvoN5I&callback=initMap"
async defer></script>
@endsection
