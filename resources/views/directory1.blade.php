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
            padding: 5px 19px;
            border-right: 1px solid #ccc;
            color: #fff;
            border-radius: 10px;
            margin-right: 11px;
            font-size: 14px;
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
                                            @foreach ($loc_dropdown as $loc_drp)
                                                @if (!empty($loc_drp->city))
                                                    <option value="{{ $loc_drp->city }}">{{ $loc_drp->city }}</option>
                                                @endif
                                            @endforeach
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







                <!-- right box -->


                <div class="col-lg-9 col-md-7 firm-sec p-3 mt-4 mt-md-0 shadow directory-blade" id="addCompanyList">
                    <!-- Card Start -->
                    <div class="card-start">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="logo-wrapper">


                                    <div><img
                                            src="https://theytrust-us.developmentserver.info/storage/images/logo/0Y5ThoGAKVrJ6eSaDKLKDub4TlwNJitw7t3QAQ3i.png"
                                            alt="" class="img-fluid"></div>
                                    <div><a href="">
                                            <h2>Cheenti New Company</h2>
                                        </a>
                                        <p>The new begining</p>
                                        <!-- <div class="d-flex recordbox"><p>$50-$100</p> <p>50-200 Employees</p> <p>$1000</p></div>  -->




                                    </div>


                                    <!-- <img src="https://theytrust-us.developmentserver.info/front_components/images/logoimg.jpg" alt="" class="img-fluid"> -->
                                </div>


                            </div>
                            <div class="col-md-5 text-right">
                                <div class="reviews-row">
                                    <h3>3.5 </h3>
                                    <div class="px-3"><i class="fa fa-star bluestar"></i>
                                        <i class="fa fa-star bluestar"></i>
                                        <i class="fa fa-star bluestar"></i>
                                        <i class="fa fa-star-half-o bluestar"></i>
                                        <i class="fa fa-star-o bluestar"></i>


                                    </div>
                                    <a href="https://theytrust-us.developmentserver.info/profile/102#reviewsec"
                                        target="_blank" class="">
                                        <h3>1 REVIEWS</h3>
                                    </a>
                                </div>
                            </div>






                        </div>






                        <div class="row mt-2 porfile-sec">
                            <div class="col-md-8 pr-md-1">

                            </div>
                            <div class="col-md-4 pr-md-1">
                                <div class="d-flex"> <a href="">View Porfile</a><a href="">Request
                                        Quote</a> </div>
                            </div>
                        </div>




                        <div class="row mt-1 target-sec">
                            <div class="col-md-8 pr-md-1">

                                <h2 class="area my-heading"> Target Services Area</h2>
                                <hr class="mt-2">
                                <div class="row mx-0 percentbox">
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Content Marketing</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Content Marketing</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-2 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-3 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Content Marketing</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-3 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-3 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center mb-3 p-2">
                                        <div class="border p-3 w-100 rounded shadow-sm h-100">
                                            <img src="https://theytrust-us.developmentserver.info/front_components/images/progress.jpg"
                                                alt="" class="img-fluid">
                                            <h3>Advertising</h3>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4 pl-md-1">

                                <h2 class="industries my-heading"> Target Industries</h2>
                                <hr class="mt-2 mb-4">


                                <p class="btn-target border">Charlotte, NC</p>
                                <p class="btn-target">50-100 employee</p>
                                <p class="btn-target">$50 - $150 / hr</p>
                                <p class="btn-target">$1000</p>



                            </div>
                        </div>


                        <div class="container mt-5 agency-sec">
                            <h2 class="my-heading"> Agency Profile</h2>
                            <hr>

                            <p class="expandable-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been
                                the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley
                                of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries,
                                but also the leap into electronic typesetting, remaining essentially unchanged. It was
                                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages,
                                and more recently with desktop publishing software like Aldus PageMaker including versions
                                of
                                Lorem Ipsum.

                                <span class="hidden-text">

                                    It was
                                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                    passages,
                                    and more recently with desktop publishing software like Aldus PageMaker including
                                    versions of
                                    Lorem Ipsum.
                                </span>

                            </p>
                            <button class="read-more-btn" onclick="toggleReadMore()">Read More ></button>
                            <!-- <p><a href=""><u>Read More ></u></a></p> -->


                        </div>
                        <!--
                    <div class="container mt-5">
                        <h2 class="my-heading"> Locations</h2>
                        <hr>
                        <div class=" row location-sec  ">
                            <div class="col-md-4 ">


                                <div class="scroll-container">
                                    <div class="scroll-content">
                                        <p><b>Headquater</b></p>
                                        <p>dummy text of the printing and typesetting inddummy text of the</p>
                                        <br>
                                        <p><b>Other Location</b></p>
                                        <p>dummy text of the printing and typesetting inddumm</p>
                                        <p><b>Headquater</b></p>
                                        <p>dummy text of the printing and typesetting inddummy text of the</p>
                                        <br>
                                        <p><b>Other Location</b></p>
                                        <p>dummy text of the printing and typesetting inddumm</p>
                                        <p><b>Headquater</b></p>
                                        <p>dummy text of the printing and typesetting inddummy text of the</p>
                                        <br>
                                        <p><b>Other Location</b></p>
                                        <p>dummy text of the printing and typesetting inddumm</p>
                                        <p><b>Headquater</b></p>
                                        <p>dummy text of the printing and typesetting inddummy text of the</p>
                                        <br>
                                        <p><b>Other Location</b></p>
                                        <p>dummy text of the printing and typesetting inddumm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46830151.11795831!2d-119.8093025!3d44.24236485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1709554141215!5m2!1sen!2sin"
                                    style="border:0;    " allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>


                            </div>
                        </div>
                    </div> -->


                        <!-- <div class="container mt-5 reviews-sec">
                        <h2 class="my-heading"> Reviews
                        </h2>
                        <hr>
                        <div class="row align-items-end">
                            <div class="col-md-4 ">
                                <h3>Review Title </h3>
                                <p>dummy text of the printing and typesetting inddummdummy text of the printing and
                                    typesetting inddummdummy text of the printing and typesetting inddumm</p>
                            </div>
                            <div class="col-md-5 review-by">
                                <h3>Review By</h3>
                                <p>dummy text of the printing and typesetting


                                    dummy text of the printing and typesetting


                                </p>
                            </div>
                        </div>
                    </div> -->


                        <!-- <div class="container">
                        <div class=" row quality-sec ">
                            <div class="reviews-row2 d-flex align-items-center col-md-12 mt-2 ">


                                <div class="pl-0 pr-2">
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star bluestar"></i>
                                    <i class="fa fa-star-half-o bluestar"></i>
                                    <i class="fa fa-star-o bluestar"></i>


                                </div>
                                <h3>3.5 </h3>


                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>
                            <div class="col-md-2 ">
                                Quality 5.0
                            </div>


                        </div>
                    </div> -->




                        <!-- <div class="container my-5 faq">
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the printing text of</p>
                        </div>
                        <div class="border p-2 px-3 mb-2">
                            <p class="mb-0"> <strong>What Services Dummy Text Of The Printing ?</strong> <br>
                                dummy text of the printingdummy text of the printing text of the printing text of the printing text of</p>
                        </div>
                     </div> -->


                        <!--
                     <div class="container mt-5 reviews-sec">
                        <h2 class="my-heading"> Portfolio / Case Studies


                        </h2>
                        <hr>
                        <div class="row align-items-end case-box">
                            <div class="col-md-4 mb-3">
                               <div class="border p-2 mb-2">
                                <img src="https://theytrust-us.developmentserver.info/front_components/images/profile-img.jpg" alt="" class="w-100">
                                 <h3 class="mt-3 mb-2">Project Title
                                </h3>
                               </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border p-2 mb-2">
                                 <img src="https://theytrust-us.developmentserver.info/front_components/images/profile-img.jpg" alt="" class="w-100">
                                  <h3 class="mt-3 mb-2">Project Title
                                 </h3>
                                </div>
                             </div>
                             <div class="col-md-4 mb-3">
                                <div class="border p-2 mb-2">
                                 <img src="https://theytrust-us.developmentserver.info/front_components/images/profile-img.jpg" alt="" class="w-100">
                                  <h3 class="mt-3 mb-2">Project Title
                                 </h3>
                                </div>
                             </div>
                           
                        </div>
                    </div> -->


                    </div>
                    <!-- Card End -->
                </div>
                <!-- right box -->
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








    <script>
        function toggleReadMore() {
            var hiddenText = document.querySelector('.hidden-text');
            var buttonText = document.querySelector('.read-more-btn');


            if (hiddenText.style.display === 'none' || hiddenText.style.display === '') {
                hiddenText.style.display = 'inline';
                buttonText.textContent = 'Read Less ^';
            } else {
                hiddenText.style.display = 'none';
                buttonText.textContent = 'Read More';
            }
        }
    </script>
@endsection
