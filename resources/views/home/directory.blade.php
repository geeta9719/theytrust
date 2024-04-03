@extends('layouts.home-master')
@section('content')
    <?php
    $reviews = [1, 3, 5, 10, 15, 20];
    $ratings = [1, 2, 3, 4, 5];
    if (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) {
        $loc = $_REQUEST['location'];
        $place = strtolower($loc);
    } else {
        $loc = '';
        $place = '';
    }
    if (isset($_REQUEST['services']) && is_array($_REQUEST['services']) && !($_REQUEST['services'][0] === '')) {
        $subcat = $_REQUEST['services'];
        $slug = strtolower(str_replace(' ', '-', $subcategories[$subcat[0]]));
    } else {
        $subcat = [];
        $slug = '';
    }
    $bud = isset($_REQUEST['budget']) ? $_REQUEST['budget'] : '';
    $rev = isset($_REQUEST['reviews']) ? $_REQUEST['reviews'] : '';
    $rat = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '';
    $rates = isset($_REQUEST['rates']) ? $_REQUEST['rates'] : [];
    $ind = isset($_REQUEST['industry']) ? $_REQUEST['industry'] : [];
    ?>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* .graph-sec .col-xl-5:last-child {
                                    z-index: -1;
                                    position: relative;

                                } */

        /* .graph-sec .col-xl-5:last-child {
                                    left: -66px;
                                } */

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
            border: 1px solid #dee2e6 !important;
            padding: 7px 15px;
            border-radius: 0 0 5px 5px;
            text-decoration: none !important;
            display: block;
            color: #0087f2 !important;
            border-top: 0;
            font-weight: bold;
            transition: all .3s;
            font-size: 14px;
            margin-bottom: 8px;
        }

        /* .btn-target:hover {
                                    color: #fff;
                                    text-decoration: none;
                                    background-color: #95c7ef;

                                } */

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

        .porfile-sec a {

border: 0;

background-color: #388cff;

padding: 5px 28px;

border-right: 1px solid #ccc;

color: #fff;

border-radius: 0;

margin-right: 0px;

font-size: 12px;

font-weight: bold;

text-decoration: none;

}

        .logo-wrapper {
            display: flex;
        }

        .logo-wrapper img {
            width: 158px;
            margin-right: 20px;
        }

        .logo-wrapper h2 {
            font-size: 17px;
            font-weight: 600;
        }

        .logo-wrapper a h2::after {
            content: url('https://theytrust-us.developmentserver.info/front_components/images/min-arrow.png');
            max-width: 30px;
            margin-left: 10px;
        }

        .logo-wrapper p {
            font-size: 18px;
            color: #191b1f;
            margin: 3px;
        }

        .recordbox p {
            font-weight: bold;
            font-size: 15px;
            margin-right: 17px;

        }
        .profile{
            margin-left: -11px;
        }

        .recordbox {
            border: 0;
        }

        .reviews-row a h3::after {
            content: url('https://theytrust-us.developmentserver.info/front_components/images/min-arrow.png');
            max-width: 30px;
            margin-left: 10px;
        }

        /* read0more */
        .expandable-text {

            margin: 0 auto;
        }

        .hidden-text {
            display: none;
        }

        .read-more-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }


        .read-more-btn {
            color: #007bff !important;
            text-decoration: underline !important;
            font-weight: 600 !important;
            float: right;
            border: 0 !important;
            font-size: 13px;
        }


        /* read0more */



        @media (max-width: 650px) {
            .logo-wrapper {
                display: block;
                text-align: center;
            }

            .logo-wrapper h2 {

                margin: 14px 0;
            }

            .porfile-sec a {
                margin-right: 0;
                margin-bottom: 4px;
                margin-left: 15px;
            }
        }



        @media (max-width: 650px) {
            .alert-success {
                font-size: 13px;
                width: 100% !important;
                margin: auto auto 10px auto !important;
            }



        }
    </style>

    <!--  section start -->
    <section class="container-fluid list-top">
        <div class=" container">
            <a href="">Home | Directory</a>
            <h2>Top <?php if (!empty($_REQUEST['services'][0])) {
                echo $subcategories[$subcat[0]];
            } ?> Companies</h2>
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
                <div class="col-lg-3 col-md-5  pr-md-5 side-bar">
                    <div class="inner bg-white p-4 shadow">
                        <a href="#" id="clearAllFilters">Clear All</a>


                        <form id="form2" action="{{ url('directory', [$slug, $place]) }}" method="POST">
                            @csrf
                            <input type="hidden" id="sub" name="services[]" value="<?php if (!empty($_REQUEST['services'][0])) {
                                echo $subcat[0];
                            } ?>">
                            <input type="hidden" id="loc" name="location" value="<?php if (!empty($_REQUEST['location'])) {
                                echo $loc;
                            } ?>">
                        </form>

                        <form class="filter-directory" id="form1">

                            <div class="filter-box mt-2">
                                <div class="dropbox">

                                    <div class="dropinner">
                                        <select id="location" class="location-filter form-control" name="location"
                                            onchange="searchCompany()">
                                            <option value="">Select Location</option>
                                            {{-- @foreach ($loc_dropdown as $loc_drp)
                                                @if (!empty($loc_drp->city))
                                                    <option value="{{ $loc_drp->city }}">{{ $loc_drp->city }}</option>
                                                @endif
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="dropinner servicestxt">
                                        <select id="services" name="services[]" multiple="multiple"
                                            onchange="searchCompany()">
                                            <option value="">Select Services</option>
                                            @foreach ($subcategories as $key => $subcategoy)
                                                @if (in_array($key, $subcat))
                                                    <option <?php if (isset($subcat) && in_array($key, $subcat)) {
                                                        echo 'selected';
                                                    } ?> value="{{ $key }}">
                                                        {{ $subcategoy }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="dropinner">
                                        <select class="form-control dropdown1" id="chk_budget" name="budget"
                                            onchange="searchCompany()">
                                            <option value="">Client Budget</option>
                                            @foreach ($budget as $b)
                                                <?php
                                                $bb = explode('-', $b['budget']);
                                                $budd = $bb[0] . ' - ' . $bb[1];
                                                ?>
                                                <option <?php if (isset($bud) && $bud == $b['budget']) {
                                                    echo 'selected';
                                                } ?> value="{{ $b['budget'] }}"> {{ $budd }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="dropinner">
                                        <select class="form-control dropdown1" id="rates" name="rates[]"
                                            onchange="searchCompany()">
                                            <option value="">Hourly Rate</option>
                                            @foreach ($rate as $b)
                                                <?php
                                                $bb = explode('-', $b['rate']);
                                                $rr = $bb[0] . ' - ' . $bb[1];
                                                ?>
                                                <option <?php if (isset($rates) && in_array($b['rate'], $rates)) {
                                                    echo 'checked';
                                                } ?> value="{{ $b['rate'] }}"> {{ $rr }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="dropinner">
                                        <select class="form-control dropdown1" id="industry" multiple="multiple"
                                            name="industry[]" onchange="searchCompany()">
                                            <option value="">Industry</option>
                                            @foreach ($industry as $key => $indust)
                                                <option <?php if (isset($ind) && in_array($key, $ind)) {
                                                    echo 'checked';
                                                } ?> value="{{ $key }}">
                                                    {{ $indust }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="dropinner">
                                        <select class="form-control dropdown1" id="reviews" name="reviews"
                                            onchange="searchCompany()">
                                            <option value="">Reviews</option>
                                            @foreach ($reviews as $key => $review)
                                                <option <?php if (isset($rev) && $rev == $review) {
                                                    echo 'checked';
                                                } ?> value="{{ $review }}">
                                                    {{ $review }}+ </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="dropinner">
                                        <select class="form-control dropdown1" id="ratings" name="rating"
                                            onchange="searchCompany()">
                                            <option value="">Ratings</option>

                                            @foreach ($ratings as $key => $rating)
                                                <option <?php if (isset($rat) && $rat == $rating) {
                                                    echo 'checked';
                                                } ?> value="{{ $rating }}">
                                                    {{ $rating }}
                                                    <span
                                                        style="color:#ff3b00f2;font-size:35px;font-weight:bolder;padding-top:2px;">
                                                        <img src="{{ asset('front_components/images/red.png') }}"
                                                            width="15px;" /> </span>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="col-lg-9 col-md-7 firm-sec p-3 mt-4 mt-md-0 shadow  " id="addCompanyList">

                    <div class="firm-box d-lg-flex ">
                        <p class="mr-5">
                            @if ($company)
                                {{ $totalRecord }}
                            @else
                                {{ 0 }}
                            @endif Firms
                        </p>
                        <p>List of the Best @if (isset($subcat[0]) && isset($subcategories[$subcat[0]]))
                                {{ $subcategories[$subcat[0]] }}
                            @endif Firms</p>
                    </div>

                    @if ($company)
                        @foreach ($company as $key => $cmp)
                            <div class="col-lg-12 col-md-12 firm-sec p-3 pb-5 mt-4 mt-md-0 shadow directory-blade"
                                id="addCompanyList">
                                <!-- Card Start -->
                                <div class="card-start">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="logo-wrapper">
                                                <div> <img src="{{ asset($cmp->logo) }}" alt="" class="img-fluid ">
                                                </div>
                                                <div>
                                                    <a href="/profile/{{ $cmp->id }}">
                                                        <h2>{{ $cmp->name }}</h2>
                                                    </a>
                                                    <p>{{ $cmp->tagline }}</p>
                                                    <!-- <div class="d-flex recordbox"><p>$50-$100</p> <p>50-200 Employees</p> <p>$1000</p></div>  -->
                                                </div>
                                                <!-- <img src="https://theytrust-us.developmentserver.info/front_components/images/logoimg.jpg" alt="" class="img-fluid"> -->
                                            </div>
                                        </div>
                                        @if (isset($rate_review[$cmp->id]))
                                            <div class="col-md-5 text-right">
                                                <div class="reviews-row">
                                                    <h3>{{ number_format((float) $rate_review[$cmp->id]->rating, 1, '.', '') ?? '' }}
                                                    </h3>
                                                    <div class="px">
                                                        @php
                                                            $rating = $rate_review[$cmp->id]->rating;
                                                            $fullStars = floor($rating);
                                                            $halfStar = ceil($rating) != $fullStars;
                                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                                        @endphp

                                                        @for ($i = 1; $i <= $fullStars; $i++)
                                                            <i class="fa fa-star bluestar"></i>
                                                        @endfor

                                                        @if ($halfStar)
                                                            <i class="fa fa-star-half-o bluestar"></i>
                                                        @endif

                                                        @for ($i = 1; $i <= $emptyStars; $i++)
                                                            <i class="fa fa-star-o bluestar"></i>
                                                        @endfor
                                                    </div>

                                                    @isset($cmp->id)
                                                        <a href="{{ url('profile/' . $cmp->id) }}#reviewsec" target="_blank">
                                                            <h3>{{ $rate_review[$cmp->id]->review }} REVIEWS</h3>
                                                        </a>
                                                    @endisset
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row mt-2 porfile-sec">
                                        <div class="col-md-8 pr-md-1">

                                        </div>
                                        <div class="col-md-4 pr-md-1 profile">
                                            <div class=""> <a href="{{ $cmp->website }}">View Porfile</a>
                                                <a
                                                    href="">Request
                                                    Quote</a> 
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1 target-sec">
                                        <div class="col-md-8 pr-md-1">

                                            <h2 class="area my-heading"> Target Services Area</h2>
                                            <hr class="mt-2">

                                            <div class="row mx-0 percentbox">
                                                @foreach ($cmp->industries ?? [] as $items)
                                                    <div class="col-md-4 text-center mb-2 p-2">
                                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                                            <h3>{{ $items->name }}</h3>
                                                            <div
                                                                id="piechart_{{ str_replace('-', '_', Str::slug($items->name)) }}_{{ $cmp->id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-md-1">

                                            <h2 class="industries my-heading"> Target Industries</h2>
                                            @foreach ($service_lines[$cmp->id] as $service_line)
                                                @if ($service_line->subcategory_id)
                                                    <a href="#" class="btn-target">
                                                        {{ App\Models\Subcategory::find($service_line->subcategory_id)->subcategory ?? '' }}
                                                @endif

                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- <div class="container mt-5 agency-sec">
                                        <h2 class="my-heading"> Agency Profile</h2>
                                        <hr>
                                        <p class="expandable-text">{{ $cmp->short_description }}
                                            <span class="hidden-text">
                                                It was
                                                popularised in the 1960s with the release of Letraset sheets containing
                                                Lorem Ipsum
                                                passages,
                                                and more recently with desktop publishing software like Aldus PageMaker
                                                including
                                                versions of
                                                Lorem Ipsum.
                                            </span>
                                        </p>
                                        <button class="read-more-btn" onclick="toggleReadMore()">Read More ></button>
                                    </div> --}}
                                    <div class="container mt-5 agency-sec">
                                        <h2 class="my-heading">Agency Profile</h2>
                                        <hr>
                                        <p class="expandable-text" id="short-description">
                                            {{ \Illuminate\Support\Str::limit($cmp->short_description, 100) }} <!-- Display only the first 100 characters -->
                                            <span class="hidden-text" style="display: none;"> <!-- Initially hidden -->
                                                {{ $cmp->short_description }} <!-- Full description -->
                                            </span>
                                        </p>
                                        <button class="read-more-btn" onclick="toggleReadMore()">Read More ></button>
                                    </div>
                                </div>
                                <!-- Card End -->
                            </div>
                        @endforeach

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">

                                <?php
                                
                                $links = '';
                                $blankLast = '';
                                $blankFirst = '';
                                
                                $request_uri = url()->current();
                                $query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'default_value';
                                
                                $query_str = '';
                                $prev_url = url($request_uri . '?page=' . ($currentPage - 1));
                                $next_url = url($request_uri . '?page=' . ($currentPage + 1));
                                
                                if (!empty($query_string)) {
                                    $query_string = explode('&', $query_string);
                                    $del_val = 'page=' . $currentPage . '';
                                    $query_string = array_diff($query_string, [$del_val]);
                                
                                    if (!empty($query_string)) {
                                        $query_str = '&' . implode('&', $query_string);
                                        $prev_url = url($request_uri . '?page=' . ($currentPage - 1) . $query_str);
                                        $next_url = url($request_uri . '?page=' . ($currentPage + 1) . $query_str);
                                    }
                                }
                                
                                if ($currentPage == 1) {
                                    $tabindex = ' tabindex="-1" ';
                                    $aria_disabled = ' aria-disabled="true" ';
                                    $disabled = 'disabled';
                                } else {
                                    $tabindex = '';
                                    $aria_disabled = '';
                                    $disabled = '';
                                }
                                
                                $links .= '<li class="page-item ' . $disabled . '"><a class="page-link" href="' . $prev_url . '" ' . $tabindex . ' ' . $aria_disabled . '>Previous</a></li>';
                                ?>

                                <?php
                                
                                for ($i = 1; $i <= $totalPage; $i++) {
                                    if ($i == $currentPage) {
                                        $active = ' active ';
                                        $aria_current = ' aria-current="page" ';
                                
                                        if ($i == $lastPage) {
                                            $tabindex = ' tabindex="-1" ';
                                            $aria_disabled = ' aria-disabled="true" ';
                                            $disabled = 'disabled';
                                        }
                                
                                        $links .= '<li class="page-item ' . $active . '" ' . $aria_current . '><a class="page-link" href="' . url($request_uri . '?page=' . $i . $query_str) . '">' . $i . '</a></li>';
                                    } else {
                                        $active = '';
                                        $aria_current = '';
                                        $tabindex = '';
                                        $aria_disabled = '';
                                        $disabled = '';
                                
                                        if ($i >= $currentPage - $beforeOrAfterCurrentPage || $i == 1) {
                                            if ($i <= $currentPage + $beforeOrAfterCurrentPage || $i == $lastPage) {
                                                $links .= '<li class="page-item ' . $active . '" ' . $aria_current . '><a class="page-link" href="' . url($request_uri . '?page=' . $i . $query_str) . '">' . $i . '</a></li>';
                                            } else {
                                                if ($blankFirst == '') {
                                                    $blankFirst = '...';
                                                    $links .= '...';
                                                }
                                            }
                                        } else {
                                            if ($blankLast == '') {
                                                $blankLast = '...';
                                                $links .= '...';
                                            }
                                        }
                                    }
                                }
                                
                                $links .= '<li class="page-item ' . $disabled . '"><a class="page-link" href="' . $next_url . '" ' . $tabindex . ' ' . $aria_disabled . '>Next</a></li>';
                                ?>

                                <?php echo $links; ?>
                            </ul>
                        </nav>
                    @else
                        <div class="row">
                            <div style="margin: 0 auto;">No Match Found</div>
                        </div>
                    @endif

                </div>
            </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $('#services').select2({
            placeholder: 'Services'
        });
    </script>
    <script type="text/javascript">
        $('#industry').select2({
            placeholder: 'Industries'
        });
    </script>
    <script type="text/javascript">
    function toggleReadMore() {
        var shortDesc = document.getElementById('short-description');
        var hiddenText = shortDesc.querySelector('.hidden-text');

        if (hiddenText.style.display === 'none') {
            hiddenText.style.display = 'inline'; // Display full description
            shortDesc.querySelector('.read-more-btn').textContent = 'Read Less <'; // Change button text
        } else {
            hiddenText.style.display = 'none'; // Hide full description
            shortDesc.querySelector('.read-more-btn').textContent = 'Read More >'; // Change button text
        }
    }
// });

        $('.location-filter').select2({
            minimumInputLength: 3,
            placeholder: 'Location',
            allowClear: true,
            ajax: {
                url: '{{ route('select2-cities') }}',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        _token: '{{ csrf_token() }}'
                    }
                    return query;
                },
                processResults: function(res) {
                    return {
                        results: res.results
                    };
                }
            }
        });
    </script>

    <script>
        var searchCompany;
        var clearAll;
        $(document).ready(function() {

            searchCompany = function() {
                var t = "<?= $main_slug ?>";
                //alert(t);
                var ser = $("#form1").serialize();
                var loc = $('.location-filter').val();

                loc = loc ? loc.toLowerCase() : loc;

                jQuery.ajax({
                    url: "{{ url('get-company-list') }}",
                    type: "GET",
                    data: ser,
                    //dataType : 'json',
                    success: function(result) {
                        $("#addCompanyList").html(result);
                        window.history.replaceState("", "", "{{ url('directory') }}/" + t + "/" +
                            loc + "?page=1&" + ser);
                    }
                });
            }
            clearAll = function() {
                $(".location-filter").select2("val", "");
                $("input").val('');
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add an event listener to the "Clear All" link
            document.getElementById("clearAllFilters").addEventListener("click", function(event) {
                event.preventDefault();

                // Clear the values of the filters
                $(".location-filter").val(null).trigger("change"); // Clear Select2 location filter
                $("#services, #chk_budget, #rates, #industry, #reviews, #ratings").val("").trigger(
                    "change"); // Clear other filters

                // Trigger the searchCompany function to update the company list
                searchCompany();
            });
        });
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {

            @foreach ($company as $cmp)
                @foreach ($cmp->industries as $item)
                    var containerId = "piechart_{{ str_replace('-', '_', Str::slug($item->name)) }}_{{ $cmp->id }}";
                    var containerElement = document.getElementById(containerId);
                    if (containerElement) {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Percentage'],
                            ['{{ $item->name }}', {{ 30 }}],
                            ['', {{ 100 - 30 }}]
                        ]);

                        var options = {
                            'title': '{{ $item->name }}',
                            'width': 150,
                            'height': 100,
                            'slices': {
                                0: {
                                    color: 'blue'
                                },
                                1: {
                                    color: 'white'
                                }
                            }
                        };
                        var chart = new google.visualization.PieChart(containerElement);
                        chart.draw(data, options);
                    } else {
                        console.error("Container element not found: " + containerId);
                    }
                @endforeach
            @endforeach
        }
    </script>
@endsection
