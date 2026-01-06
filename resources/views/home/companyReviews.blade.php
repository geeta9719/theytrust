@extends('layouts.home-master')
@section('content')
<head>
    <title>{{ $company->name }} Reviews - TheyTrust</title>
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
            -webkit-box-orient: vertical;
            line-height: 1.5;
            max-height: 3em;
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
        .btn-group .btnbox{
            width: 100%;
            margin: 0;
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
            display: flex;
            justify-content: space-between;
        }
        .btn-group .fa{
            font-size:15px;
            color:#fff;
            margin-right: 5px;
        }
        .review-portfolio-sec .topsec h2 {
            font-size: 24px !important;
        }
        .review-portfolio-sec .bluestar {
            color: #3ed1f2;
        }
        .review-portfolio-sec .writereview h3 {
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
        
        /* Filter Section */
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
        }
        .filter-section select {
            margin-right: 15px;
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        /* No Reviews Section */
        .no-reviews-container {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            margin: 40px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .no-reviews-container i {
            font-size: 80px;
            color: #e0e0e0;
            margin-bottom: 20px;
        }
        .no-reviews-container h3 {
            font-size: 28px;
            color: #666;
            margin-bottom: 15px;
        }
        .no-reviews-container p {
            font-size: 16px;
            color: #888;
            margin-bottom: 30px;
        }
        .clear-filters-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
        }
        
        @media (max-width: 767px) {
            .writereview a{
                font-size: 14px;
            }
            .portfolio .reviewrate {
                display: block!important;
                font-size: 15px;
                margin-top: -17px!important;
            }
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
            <div class="btn-group">
                <a href="{{ route('profile', $company->slug ?? $company->id) }}" class="btng btnbox">
                    <i class="fa fa-user-o" aria-hidden="true"></i> PROFILE
                </a>
                <a href="{{ route('company.reviews', $company->slug ?? $company->id) }}" class="btndg btnbox">
                    <i class="fa fa-star-o" aria-hidden="true"></i> REVIEWS
                </a>
                <a href="{{ route('profile', $company->slug ?? $company->id) }}#portfolio" class="btng btnbox">
                    <i class="fa fa-briefcase" aria-hidden="true"></i> PORTFOLIO
                </a>
                <a href="{{ route('profile', $company->slug ?? $company->id) }}#bundles" class="btng btnbox">
                    <i class="fa fa-gift" aria-hidden="true"></i> BUNDLES
                </a>
                <a href="{{ route('profile', $company->slug ?? $company->id) }}#projects" class="btng btnbox">
                    <i class="fa fa-laptop" aria-hidden="true"></i> PROJECTS
                </a>
                <a href="{{ route('profile', $company->slug ?? $company->id) }}#quote" class="btnp btnbox">
                    <i class="fa fa-usd" aria-hidden="true"></i> REQUEST A QUOTE
                </a>
                <a href="{{ route('profile', $company->slug ?? $company->id) }}#www" class="btnp btnbox">
                    <i class="fa fa-globe" aria-hidden="true"></i> WWW
                </a>
            </div>
        </div>
    </div>

    <div class="container portfolio review-portfolio-sec">
        <div class="row">
            <div class="col-lg-12 shadow bg-white py-3">
                <div class="row topsec mb-3">
                    <div class="col-md-7">
                        <div class="row text-center text-md-left">
                            <div class="col-md-3">
                                @if($company->logo)
                                    <img src="{{ $company->getLogoUrl() }}" alt="{{ $company->name }}" class="img-fluid">
                                @else
                                    <div style="width: 100px; height: 100px; background: #FF6B35; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; border-radius: 10px; margin: auto;">
                                        {{ strtoupper(substr($company->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8 mt-2 mt-md-0">
                                <h2>{{ $company->name }}</h2>
                                <div class="d-flex mt-3 writereview">
                                    <h3 style="color:#fff;!important">{{ number_format($avg_rating, 1) }}</h3>
                                    <div class="px-3 starbox">
                                        {!! generateStarRating($avg_rating) !!}
                                    </div>
                                    <a href="{{ route('company.reviews', $company->slug ?? $company->id) }}" target="_blank" class="mr-2 reviewuppercase">
                                        {{ $total_reviews }} Reviews
                                    </a>
                                    <a href="/company/{{ $company->id }}/getReview" target="_blank" class="write">
                                        Write a Review
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right">
                        <div class="reviews-row text-center">
                            <img src="https://theytrust.us/front_components/images/score.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sortSelect">Sort by:</label>
                            <select id="sortSelect" class="form-control" onchange="applyFilters()">
                                <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="highest" {{ $sortBy == 'highest' ? 'selected' : '' }}>Highest Rated</option>
                                <option value="lowest" {{ $sortBy == 'lowest' ? 'selected' : '' }}>Lowest Rated</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="minRatingSelect">Min Rating:</label>
                            <select id="minRatingSelect" class="form-control" onchange="applyFilters()">
                                <option value="">All Ratings</option>
                                <option value="5" {{ $minRating == '5' ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ $minRating == '4' ? 'selected' : '' }}>4+ Stars</option>
                                <option value="3" {{ $minRating == '3' ? 'selected' : '' }}>3+ Stars</option>
                                <option value="2" {{ $minRating == '2' ? 'selected' : '' }}>2+ Stars</option>
                                <option value="1" {{ $minRating == '1' ? 'selected' : '' }}>1+ Stars</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="industrySelect">Industry:</label>
                            <select id="industrySelect" class="form-control" onchange="applyFilters()">
                                <option value="">All Industries</option>
                                @if(isset($industries))
                                    @foreach($industries as $industry)
                                        <option value="{{ $industry->id }}" {{ $industryId == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->category }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="serviceSelect">Service:</label>
                            <select id="serviceSelect" class="form-control" onchange="applyFilters()">
                                <option value="">All Services</option>
                                @if(isset($service_categories))
                                    @foreach($service_categories as $service)
                                        <option value="{{ $service->id }}" {{ $serviceLineId == $service->id ? 'selected' : '' }}>
                                            {{ $service->subcategory }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="container mt-1 reviews-sec greybox">
                    @forelse($reviews as $review)
                        <x-review :review="$review" />
                    @empty
                        <!-- No Reviews Found -->
                        <div class="no-reviews-container">
                            <i class="fa fa-star-o"></i>
                            <h3>No Reviews Found</h3>
                            <p>{{ $company->name }} doesn't have any reviews yet.</p>
                            <button class="clear-filters-btn" onclick="clearAllFilters()">
                                <i class="fa fa-filter"></i> Clear Filters
                            </button>
                        </div>
                    @endforelse

                    <!-- Upgrade Prompt for Plan Restricted Users -->
                    @if(isset($show_upgrade_banner) && $show_upgrade_banner)
                        <div class="text-center py-5">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">
                                        <i class="fa fa-star"></i> Want to See More Reviews for {{ $company->name }}?
                                    </h4>
                                    <p class="card-text">
                                        You're currently on a limited plan and can view up to <strong>{{ $review_limit }}</strong> reviews.
                                        <br>
                                        Upgrade to a premium plan to access all <strong>{{ $total_reviews }}</strong> verified reviews for {{ $company->name }}.
                                    </p>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle text-success"></i> Unlimited Review Access
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle text-success"></i> Advanced Filtering
                                        </div>
                                        <div class="col-md-4">
                                            <i class="fa fa-check-circle text-success"></i> Priority Support
                                        </div>
                                    </div>
                                    @auth
                                        <a href="{{ route('user.choice') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-rocket"></i> Upgrade to Premium
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-sign-in"></i> Login to Upgrade
                                        </a>
                                    @endauth
                                    <div class="mt-2">
                                        <small class="text-muted">Starting from just $9.99/month</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if(isset($reviews) && $reviews instanceof \Illuminate\Pagination\LengthAwarePaginator && $reviews->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            const currentUrl = new URL(window.location);
            const sortBy = document.getElementById('sortSelect').value;
            const minRating = document.getElementById('minRatingSelect').value;
            const industryId = document.getElementById('industrySelect').value;
            const serviceLineId = document.getElementById('serviceSelect').value;

            currentUrl.searchParams.set('sort', sortBy);
            
            if (minRating) {
                currentUrl.searchParams.set('min_rating', minRating);
            } else {
                currentUrl.searchParams.delete('min_rating');
            }
            
            if (industryId) {
                currentUrl.searchParams.set('industry_id', industryId);
            } else {
                currentUrl.searchParams.delete('industry_id');
            }
            
            if (serviceLineId) {
                currentUrl.searchParams.set('service_line_id', serviceLineId);
            } else {
                currentUrl.searchParams.delete('service_line_id');
            }

            window.location.href = currentUrl.toString();
        }

        function clearAllFilters() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.delete('sort');
            currentUrl.searchParams.delete('min_rating');
            currentUrl.searchParams.delete('industry_id');
            currentUrl.searchParams.delete('service_line_id');
            window.location.href = currentUrl.toString();
        }

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
    </script>
</body>
@endsection