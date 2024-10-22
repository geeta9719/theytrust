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
        /* .btn-group .btng{
            background-color: #00bdd6 !important;
            max-width: 100%;
            width: 100%;
    margin: 0;
    padding: 7px 35px;
    text-align: center;
    border: 1px solid #fff;
    font-size: 14px;
    font-family: "Inter", sans-serif;
    font-weight: 400;
    color:#fff;
        }
        .btn-group .btnp{
            background-color: #b9a8e4 !important;
            max-width: 100%;
            width: 100%;
    margin: 0;
    padding: 7px 12px;
    text-align: center;
    border: 1px solid #fff;
    font-size: 14px;
    font-family: "Inter", sans-serif;
    font-weight: 400;
    color:#fff;
        }
        .btn-group .btndg{
            background-color: #0095a9 !important;
            max-width: 100%;
    width: 100%;
    margin: 0;
    padding: 7px 34px;
    text-align: center;
    border: 1px solid #fff;
    font-size: 14px;
    font-family: "Inter", sans-serif;
    font-weight: 400;
    color:#fff;
        } */
        
        .btn-group .btnbox{
            /* max-width: 100%; */
            width: 100%;
            margin: 0;
            /* padding: 7px 34px; */
            text-align: center;
            border: 1px solid #fff;
            font-size: 13px;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            color:#fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-group .btng{
            background-color: #00bdd6 !important;
        
  
  
    
        }
        .btn-group .btnp{
            background-color: #b9a8e4 !important;

    padding: 7px 12px;

        }
        .btn-group .btndg{
            background-color: #0095a9 !important;
          

    
        }









        .btn-group{
            /* width: 100%; */
            display: flex;
            justify-content: space-between;
        }
        .btn-group .fa{
            font-size:15px;
            color:#fff;
            margin-right: 5px;
        }
       
/* sneha */
.review-portfolio-sec .topsec h2 {
    font-size: 24px !important;
    
}

.review-portfolio-sec .bluestar {
    color: #3ed1f2;
}
.review-portfolio-sec .writereview h3
{
    background-color: #006d7c;
    padding: 11px;
    border-radius: 63%;
    color: #fff !important;
}

.review-portfolio-sec .write{
    color: #3ed1f2 !important;
    font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;

}
.writereview a{
    font-size: 17px;
    font-weight: 700;
font-family: "Epilogue", sans-serif;

}
@media (max-width: 767px) {
    .writereview a{
      
            font-size: 14px;
    }
    .portfolio .reviewrate {
    display: block!important;
    font-size: 15px;
   
    margin-top: -17px!important;}
    .sidebar-review-box .userbox{
        display:block;
    }
    .review-portfolio-sec .write{
        font-size: 12px; 
    }
.btn-group{
    display:block;
}

.btn-group .btnbox {
    padding:7px 12px;
}

}


    </style>
    
</head>

<body>

<div class="col-md-12">
<div class="container mb-5">
        <div class=" btn-group">
            <!-- <div class=" text-center d-md-flex d-block"> -->
            <!-- <div class="col-1 m-0 p-0">  <button type="button" class="btng "><i class="fa fa-user-o" aria-hidden="true"></i> PROFILE</button></div> -->
          <a href=""  class="btng btnbox"><i class="fa fa-user-o" aria-hidden="true"></i> PROFILE</a>
            <a href="" class="btndg btnbox"><i class="fa fa-star-o" aria-hidden="true"></i> REVIEWS</a>
            <a href="" class="btng btnbox"><i class="fa fa-briefcase" aria-hidden="true"></i> PORTFOLIO</a>
            <a href="" class="btng btnbox"><i class="fa fa-gift" aria-hidden="true"></i>BUNDLES</a>
            <a href=""class="btng btnbox"><i class="fa fa-laptop" aria-hidden="true"></i> PROJECTS</a>
            <a href="" class="btnp btnbox"><i class="fa fa-usd" aria-hidden="true"></i> REQUEST A QUOTE</a>
            <a href="" class="btnp btnbox"><i class="fa fa-globe" aria-hidden="true"></i> WWW</a>
             
            <!-- </div> -->
            <!-- <div class="col text-center">
                <button type="button" class="btn btn-primary">Button 7</button>
            </div> -->
        </div>
    </div>

</div>
</div>


    <div class="container portfolio review-portfolio-sec">
        <div class="row">
            
            <div class="col-lg-12 shadow bg-white py-3">
            <div class="row topsec mb-3">



                    <div class="col-md-7">
                        <div class="row text-center text-md-left">
                            <div class="col-md-3 ">
                                <img src="https://theytrust-us.developmentserver.info/storage/images/logo/JPs1fNEQ5UCGh1xu2NqD54a4QIlN4BIErWAy9NF0.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-8 mt-2 mt-md-0">
                                <h2>{{ $reviews[0]->company->name }}</h2>
                                <div class="d-flex mt-3 writereview">
                            <h3 style="color:#fff;!important">3.5 </h3>
                            <div class="px-3 starbox"><i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star bluestar"></i>
                                <i class="fa fa-star-half-o bluestar"></i>
                                <i class="fa fa-star-o bluestar"></i>
                            </div>
                            <a href="https://theytrust-us.developmentserver.info/profile/102#reviewsec" target="_blank" class="mr-2 reviewuppercase">
                                {{  $reviews->count() }} Reviews  With Limit
                            </a> 
                            <a href="/company/{{ $reviews[0]->company->id }}/getReview" target="_blank" class="write">
                                Write a Review
                            </a>
                            <!-- <img src="https://theytrust-us.developmentserver.info/front_components/images/filter.png" class="img-fluid" alt="">
                        -->
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
                    <!-- <h2 class="my-heading"> Reviews </h2> -->
                    @foreach ($reviews as $review)
                        <x-review :review="$review" />
                    @endforeach
                    
                    <!-- Pagination links -->
                    @if ($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="d-flex justify-content-center">
                        {{ $reviews->links() }}
                    </div>
                @endif
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
