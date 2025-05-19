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
            #portfolio,
            #reviews {
                display: none;
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
        <div class="container portfolio-top">
            <ul id="tabs-nav">
                <li><a href="#profile"><i class="fa" style="font-size: 17px"></i> PROFILE</a></li>
                <li><a href="#reviews"><i class="fa" style="font-size: 17px"></i> REVIEWS</a></li>
                <li><a href="#portfolio"><i class="fa" style="font-size: 17px"></i> PORTFOLIO</a></li>
                <li><a href="#bundles"><i class="fa" style="font-size: 17px"></i> BUNDLES</a></li>
                <li><a href="#projects"><i class="fa" style="font-size: 17px"></i> PROJECTS</a></li>
                <li><a href="#quote" class="purple"><i class="fa" style="font-size: 17px"></i> REQUEST A QUOTE</a></li>
                <li><a href="#www" class="purple"><i class="fa" style="font-size: 17px"></i> WWW</a></li>
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
       
        document.addEventListener('DOMContentLoaded', function () {
            var readMoreBtn = document.getElementById('read-more-btn')
            var shortDescription = document.querySelector(
                '.short-description',
            )

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
            document
                .querySelector('#tabs-nav li:first-child a')
                .click()

            // Handle tab clicks
            document
                .querySelectorAll('#tabs-nav a')
                .forEach(function (tab) {
                    tab.addEventListener('click', function (e) {
                        e.preventDefault()
                        document
                            .querySelectorAll('#tabs-nav a')
                            .forEach(function (link) {
                                link.classList.remove('active')
                            })
                        tab.classList.add('active')
                        document
                            .querySelectorAll('.tab-content')
                            .forEach(function (content) {
                                content.style.display = 'none'
                            })
                        document.querySelector(
                            tab.getAttribute('href'),
                        ).style.display = 'block'
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


    
        function activateTab(tabId) {
        const validTabs = ['#profile', '#reviews', '#portfolio', '#bundles', '#projects', '#quote', '#www'];

        // Hide all
        validTabs.forEach(id => {
            const el = document.querySelector(id);
            if (el) el.style.display = 'none';
        });

        // Show selected
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
@endsection
