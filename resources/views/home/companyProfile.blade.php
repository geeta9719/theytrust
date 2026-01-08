@extends('layouts.home-master')
@section('content')
    <head>
        
        <title>Portfolio Listing</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('portfolioimage/css/bootstrap.min.css') }}"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('portfolioimage/css/font-awesome.min.css') }}"
        />
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/style1.css') }}"> -->
        <link
            rel="stylesheet"
            type="text/css"
            href="/front_components/css/custom.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
        <script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
        <script src="{{ asset('portfolioimage/js/tab.js') }}"></script>

        <style>
            .tab-content {
                display: none;
            }
            .tab-content:first-of-type {
                display: block;
            }
            .p-img img{
                max-height:194px;
            }
            .p-img{
                max-height: 100%;
    border: 1px solid #f0efef !important;
    padding: 0;
    width: 100%;
    height: 129px;
            }
            #tabs-nav li {
                cursor: pointer;
            }
            .scroll{
                padding-left:36px;
            }
            .row.button-section {
                margin: auto !important;
            }
            .next-btn:hover {
                color: #000;
            }
            .portfolio .reviews-row h3 {
                background-color: #006d7c;
                padding: 11px;
                border-radius: 63%;
                color: #fff !important;
                font-size: 15px !important;
            }
            .sidebar-review-box .qualitybox {
                display: none;
                flex-wrap: wrap;
                gap: 0;
                margin-top: 20px;
            }
            .portfolio .sidebar-review-box .col-md-4 {
                padding: 0;
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
                margin-right: 20px !important;
            }
            .portfolio .topsec h3 {
                font-family: Epilogue !important;
                font-size: 20px !important;
                font-weight: 700 !important;
                color: #171a1fff !important;
                margin: 0;
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
            .fa {
                margin-right: 4px;
            }
            .target-indus{
                border-left:1px solid #ccc;
            }
            .bluestar {
                color: #00bdd6;
                font-size: 17px; /* Adjust size as needed */
            }
            .portfolio-top .topsec h2 {
                font-size: 41px !important;
                font-family: Epilogue; /* Heading */
            }
            .user-img{    padding-left: 8px;}
            .portfolio .topsec .ratio {
                font-size: 14px !important;
                font-weight: 500 !important;
                color: #fff !important;
                background-color: #006d7c;
                padding: 10px 7px 7px 7px;
                border-radius: 35px;
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
                padding-left:19px;
            }
            .info-box h2 {
                color: #000;
                font-size: 35px;
                
            }

            .info-box h4 {
                color: #000;
                font-size: 20px;
            }
            .short-description.expanded {
                -webkit-line-clamp: unset;
                max-height: none;
            }
            .ttu-score-text {
                text-align: center;
                display:flex;
                justify-content:space-between;            }
            .ttu-score-widget {
                width: 217px;
                margin: auto;
            }
            .ttu-score-range {
                text-align: center;
            }
            .readmore a {
                font-family: Inter;
    font-size: 14px;
    font-weight: 400;
    color: #00bdd6ff;
    margin-left: 0px;
    text-decoration: underline;
    background-color: transparent !important;
            }
            .breadcrumb li a {
                color: #00bdd6 !important;
                text-decoration: none;
                font-size: 15px;
            }
            .breadcrumb {
                color: #00bdd6 !important;
                background-color: #ffffff;
            }
            .breadcrumb-item + .breadcrumb-item::before {
                content: '>';
            }
            .portfolio .reviews-sec h4 {
                background-color: #00bdd6ff;
            }
            .portfolio-top ul#tabs-nav li:hover,
            .portfolio-top ul#tabs-nav li.active {
                background-color: #0095a9;
            }
            .portfolio-top {
                padding: 0;
            }
            .portfolio-top ul#tabs-nav li {
                background-color: #00bdd6ff;
                padding: 7px 30px;
            }

            .portfolio-top #tabs-nav li a {
                text-decoration: none;
                color: #85878b;
                font-size: 15px;
            }
              .portfolio-top #tabs-nav li .purple {
                text-decoration: none;
                color: #fff;
                font-size: 15px;
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
            .purple {
                background-color: #b9a8e4 !important;
            }
            .portfolio .reviewrate {
                float: none;
                margin-top: 2px;
            }
            .review-box {
                display: flex;
                align-items: center;
                margin-top:17px;
            }
            .write-txt {
                color: #00bdd6;
            }
            .reviews-row a {
                font-family: Inter;
                font-size: 14px;
                font-weight: 400;
                color: #00bdd6ff;
                margin-left: 0px;
                text-decoration: none;
            }
            .working-hr-box {
                display: flex;
            }
            .working-hr {
                font-size: 14px !important;
                margin-top: 11px;
                margin-left: 0px;
                margin-bottom: 36px;
                display: flex;
                align-items: center;
                margin-right: 12px;
            }
            .scroll-content p {
                font-weight: 400;
                font-size: 16px;
                margin: 0;
            }
            .my-heading {
                font-family: Epilogue; /* Heading */
                font-size: 28px;
                line-height: 58px;
                font-weight: 700;
                color: #171a1fff; /* neutral-900 */
                background: #00bdd6ff; /* primary-500 */
                border-radius: 0px;
                padding: 10px;
            }
            .portfolio .topsec h3 {
                font-family: Epilogue !important;
                font-size: 29px !important;
                font-weight: 700 !important;
                color: #171a1fff !important;
            }
            .portfolio .topsec h4 {
                font-family: Epilogue !important;
                font-size: 21px !important;
                color: #171a1fff !important;
            }
            .scroll-content p {
                font-weight: 400px;
            }
            .write-txt {
                margin-left: 10px !important;
                text-decoration: underline;
            }
            .working-hr span {
                font-size: 11px !important;
                font-weight: 400;
                margin-right: 0px;
                font-size: 1rem;
                background: #00bdd6;
                padding: 6px 6px;
                border-radius: 17px;
                color: #fff;
                margin-right: 5px;
            }
            .review-box h5 {
                color: #000;
                font-size: 18px;
                font-weight: 700;
            }
            .details p {
                font-size: 15px !important;
            }
            @media (max-width: 767px) {
                .readmore a{
                    margin-left:15px;
                }
                .readmore{
                    margin-left:20px;
                }
                .info-box h2 {

               font-size: 26px;
                 }
                .review-box h5{
                    font-size:13px;
                }
                .info-box{
               
                    margin-top: 71px;
                    padding: 20px;
                }
                .btn-target{margin-left:20px;}
                .breadcrumb {
                    font-size: 10px;
                }
                .portfolio .sidebar-review-box .userbox {
                    justify-content: center;
                    margin: 3px 44px;
                }
                .short-description {
                    margin-left: 17px;
                }
                .tab-content p {
                    margin: 0 25px;
                }
                .user-col p {
                    margin: 0 25px;
                }
                .portfolio .scroll-content {
                    margin-left: 11px;
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
                .review-box {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .portfolio .greybox h2{
                    width: 100%;
                    font-size: 18px;
                    padding: 3px 32px;
                }
                .portfolio .target-sec .greybox{
                    padding: 3px 44px;
                }
                .portfolio .target-sec h2.industries{
                    padding: 3px 44px;
                }
                .working-hr-box {
                    display: block;
                   width: 100%;
                    margin: 0 23px;
                }
                .target-sec a {
                    margin: 0 47px;
                }
                .write-review {
                    float: none !important;
                }
                .portfolio-top ul#tabs-nav {
                    display: block;
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
        <a href="javascript:void(0);" id="backToListing" itemprop="item">
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
        <a href="" itemprop="item">
          <span itemprop="name">{{ $agencyName }}</span>
        </a>
        <meta itemprop="position" content="3">
      </li>
  
      {{-- Profile (current page, no link) --}}
      <li class="breadcrumb-item active"
          aria-current="page"
          itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Profile</span>
        <meta itemprop="position" content="4">
      </li>
    </ol>
  </nav>
  
        <div class="container portfolio-top">
            <ul id="tabs-nav">
                <li><a href="#profile"><i class="fa" style="font-size: 17px"></i> PROFILE</a></li>
                <li><a href="#reviews"><i class="fa" style="font-size: 17px"></i> REVIEWS</a></li>
                <li><a href="#portfolio"><i class="fa" style="font-size: 17px"></i> PORTFOLIO</a></li>
                <li><a href="#bundles"><i class="fa" style="font-size: 17px"></i> BUNDLES</a></li>
                <li><a href="#projects"><i class="fa" style="font-size: 17px"></i> PROJECTS</a></li>
                <li class="purple"><a href="#quote" class="purple"><i class="fa" style="font-size: 17px"></i> REQUEST A QUOTE</a></li>
                <li class="purple"><a href="#www" class="purple"><i class="fa" style="font-size: 17px"></i> WWW</a></li>
            </ul>
        </div>
        

        <div
            class="container shadow portfolio portfolio-top py-3 mb-5"
        >
            <div class="row">
                <div class="col-lg-12 bg-white py-md-3  px-0 px-md-4">
                    <!-- profile start -->
                    <div id="profile" class="tab-content">
                        @include('home.partials.profile')
                    </div>
                    <!-- profile end -->

                    <!-- review start -->
                    <div id="reviews" class="tab-content">
                            <div class="container mt-3 mt-md-3 p-0 reviews-sec greybox border-bottom">
                                <h2 class="my-heading">Reviews</h2>
                                @foreach ($reviews as $review)
                                    <x-review :review="$review" />
                                @endforeach

                        <!-- Pagination links -->
                            @if ($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <div class="d-flex justify-content-center">
                                        {{ $reviews->withQueryString()->fragment('reviews')->links('pagination::bootstrap-4') }}

                                    </div>
                            @endif
                            </div>
                    </div>
                    <!-- review end -->
                    <!-- Portfolio start -->
                    <div id="portfolio" class="tab-content">
                        <div
                            class="container mt-3 mt-md-3 p-0 reviews-sec greybox border-bottom"
                        >
                            <h2 class="my-heading">
                                Portfolio / Case Studies
                            </h2>
                            @foreach ($caseStudies as $caseStudy)
                                <x-portfolio
                                    :portfolio="$caseStudy"
                                />
                            @endforeach

                            @if ($caseStudies instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="d-flex justify-content-center">
                                {{ $caseStudies->withQueryString()->fragment('portfolio')->links('pagination::bootstrap-4') }}

                            </div>
                             @endif
                        </div>
                    </div>
                    <div id="bundles" class="tab-content">Coming Soon</div>
                    <div id="projects" class="tab-content">Coming Soon</div>
                    <div id="quote" class="tab-content">Coming Soon</div>
                    <div id="www" class="tab-content">Coming Soon</div>
                                    
                </div>
            </div>
        </div>
    </body>

    <script>
        // Read More/Less functionality
        document.addEventListener('DOMContentLoaded', function () {
            var readMoreBtn = document.getElementById('read-more-btn')
            var shortDescription = document.querySelector('.short-description')

            if (readMoreBtn && shortDescription) {
                readMoreBtn.addEventListener('click', function () {
                    shortDescription.classList.toggle('expanded')
                    if (shortDescription.classList.contains('expanded')) {
                        readMoreBtn.textContent = 'READ LESS'
                    } else {
                        readMoreBtn.textContent = 'READ MORE'
                    }
                })
            }
            
            // Back to listing navigation
            var backToListingBtn = document.getElementById('backToListing');
            if (backToListingBtn) {
                backToListingBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var referrer = document.referrer;
                    
                    // Check if referrer is from the same domain and contains listing/directory/search pages
                    if (referrer && 
                        (referrer.includes('/directory/') || 
                         referrer.includes('/listing') || 
                         referrer.includes('/companies') ||
                         referrer.includes('/search') ||
                         referrer.includes(window.location.host))) {
                        window.history.back();
                    } else {
                        // Default to global listing page
                        window.location.href = "{{ route('listing.global') }}";
                    }
                });
            }
        })

        // Progress Circle functionality
        $(document).ready(function () {
    $('.progress-circle').each(function () {
        const canvas = this;
        const ctx = canvas.getContext('2d');
        const percent = $(canvas).data('percentage');
        
        canvas.width = 60;
        canvas.height = 60;
        
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        const radius = 25;
        const startAngle = -0.5 * Math.PI;
        const endAngle = startAngle + (percent / 100) * 2 * Math.PI;

        // background circle
        ctx.lineWidth = 6;
        ctx.strokeStyle = '#e6e6e6';
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
        ctx.stroke();

        // progress circle
        ctx.strokeStyle = '#00bdd6';
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, startAngle, endAngle);
        ctx.stroke();

        // text
        ctx.fillStyle = '#333';
        ctx.font = '12px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(percent + '%', centerX, centerY);
    });
});


    // Tab functionality with hash support
        function activateTab(tabId) {
        const validTabs = ['#profile', '#reviews', '#portfolio', '#bundles', '#projects', '#quote', '#www'];

        // Hide all tabs
        validTabs.forEach(id => {
            const el = document.querySelector(id);
            if (el) el.style.display = 'none';
        });

        // Show selected tab
        const activeTab = document.querySelector(tabId);
        if (activeTab) activeTab.style.display = 'block';

        // Update nav
        document.querySelectorAll('#tabs-nav li').forEach(li => li.classList.remove('active'));
        const activeNav = document.querySelector(`#tabs-nav a[href="${tabId}"]`);
        if (activeNav) activeNav.parentElement.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const initialTab = window.location.hash || '#profile';
        activateTab(initialTab);

        // On click
        document.querySelectorAll('#tabs-nav a').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                const tabId = this.getAttribute('href');
                activateTab(tabId);
                history.pushState(null, '', tabId);
            });
        });
    });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9YeE5IDfcAUalQ8G26_crBmKoHYvoN5I&callback=initMap"
        async
        defer
    ></script>

    <script src="{{ asset('front_components/js/jquery.js') }}"></script>
    <script src="{{ asset('front_components/js/tab.js') }}"></script>
    <script></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const companyName = @json($agency->name ?? ($company->name ?? 'Company'));
        
            const title = companyName + ' Reviews - They Trust Us';
            const description =
                'Explore detailed, verified reviews of ' +
                companyName +
                '. Visit the company profile to see what real clients have to say.';
        
            // Title
            document.title = title;
        
            // Meta description
            const metaDesc = document.querySelector('meta[name="description"]');
            if (metaDesc) metaDesc.setAttribute('content', description);
        
            // OG title
            const ogTitle = document.querySelector('meta[property="og:title"]');
            if (ogTitle) ogTitle.setAttribute('content', title);
        
            // OG description
            const ogDesc = document.querySelector('meta[property="og:description"]');
            if (ogDesc) ogDesc.setAttribute('content', description);
        
            // OG URL
            const ogUrl = document.querySelector('meta[property="og:url"]');
            if (ogUrl) ogUrl.setAttribute('content', window.location.href);
        });
        </script>
        
@endsection
