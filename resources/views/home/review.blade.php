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
       {{-- BREADCRUMB (paste above the tabs container) --}}
<nav aria-label="breadcrumb" class="container mt-2">
  <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    {{-- Home --}}
    <li class="breadcrumb-item"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="{{ route('home') }}" itemprop="item">
        <span itemprop="name">Home</span>
      </a>
      <meta itemprop="position" content="1">
    </li>

    {{-- Listing --}}
    <li class="breadcrumb-item"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a href="{{ route('listing.global') }}" itemprop="item">
        <span itemprop="name">Listing</span>
      </a>
      <meta itemprop="position" content="2">
    </li>

    {{-- Agency Name (linkable) --}}
    @php
      $agencyName = $agency->name ?? ($company->name ?? 'Agency Name');
      $agencySlug = $agency->slug ?? ($company->slug ?? 'agency-slug');
    @endphp
    <li class="breadcrumb-item"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="{{ url('profile/' . $company->slug) }}">
    
          <span itemprop="name">{{ $agencyName }}</span>
      </a>
      <meta itemprop="position" content="3">
    </li>

    <li class="breadcrumb-item active"
        aria-current="page"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <span itemprop="name">Reviews</span>
      <meta itemprop="position" content="4">
    </li>
  </ol>
</nav>
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
        </div>
    </div>

</div>
</div>


    @livewire('compnay-reviews', ['companyId' => $company->id])


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
            debugger;
            console.log($('.progress-circle').length);        // should be > 0
            console.log(window.jQuery && $.fn.jquery);        
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