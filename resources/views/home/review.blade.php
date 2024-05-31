@extends('layouts.home-master')
@section('content')
    <style>
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
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            border-radius: 0 0 5px 5px;
            text-decoration: none !important;
            display: block;
            color: #0087f2 !important;
            border-top: 0;
            font-weight: bold;
            transition: all .3s;

        }

        .btn-target:hover {
            color: #fff;
            text-decoration: none;
            background-color: #95c7ef;

        }

        .percentbox img {
            width: 10% !important;
        }

        /* CSS for modal image */
        .modal-content img {
            max-width: 30%; /* Adjust the width of the image inside the modal */
            height: auto;
        }

        /* CSS for reducing image size */
        .portfolio-case-study img {
            max-width: 50%; /* Adjust the width of the image */
            height: auto;
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

        @media (max-width: 650px) {
            .alert-success {
                font-size: 13px;
                width: 100% !important;
                margin: auto auto 10px auto !important;
            }

        }

        /* Modal Styles */
            .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 60%; /* Adjust the width as needed */
        max-width: 800px; /* Add a maximum width if desired */
        max-height: 80%; /* Add a maximum height if desired */
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

    </style>

    <!-- listing section start -->
    <section class="container-fluid list-top">
        <div class=" container">
            <a href="">Home | Company Profile</a>
            {{-- <h2>TheyTrustUsLogin</h2> --}}
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
                <div class="col-lg-12 col-md-7 firm-sec p-3 mt-4 mt-md-0 shadow directory-blade" id="addCompanyList">
                    <div class="review-card">
                        <div class="container mt-5 reviews-sec">
                            <h2 class="my-heading"> Reviews </h2>
                        </div>
                    </div>
                    <?php foreach ($review as $rev): ?>
                
                        <div class="review-card">
                            <div class="container mt-5 reviews-sec p-0">
                                <div class="row align-items-end ml-md-4 ml-0">
                                    <div class="col-md-4">
                                        <h3>{{$rev->project_title}} </h3>
                                        <p>{{$rev->for_what_project }}</p>

                                    </div>
                                    <div class="col-md-5 review-by">
                                        <h3>Review By</h3>
                                        <p><?php echo $rev->scope_of_work  ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row quality-sec ml-md-2 ml-0">
                                    <div class="reviews-row2 d-flex align-items-center col-md-12 mt-2">
                                        <div class="pl-0 pr-2">
                                            <?php
                                            $average_rating = $rev->overall_rating;
                                            for ($i = 0; $i < 5; $i++) {
                                                if ($average_rating >= $i + 1) {
                                                    echo '<i class="fa fa-star bluestar"></i>';
                                                } elseif ($average_rating > $i) {
                                                    echo '<i class="fa fa-star-half-o bluestar"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o bluestar"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        {{-- <h3><?php echo number_format($average_rating, 1); ?></h3>
                                             --}}
                                             
                                    </div>
                                  
                                    <div class="col-md-2 ">
                                        Timeliness : {{$rev->timeliness}}
                                    </div>
                                    <div class="col-md-2 ">
                                        Cost {{$rev->cost}}
                                    </div>
                                    <div class="col-md-2 ">
                                        Expertise :{{$rev->expertise}}
                                    </div>
                                    <div class="col-md-2 ">
                                        Quality : {{$rev->quality}}
                                    </div>
                                    <div class="col-md-2 ">
                                        Communication {{$rev->communication}}
                                    </div>
                                    <div class="col-md-2 ">
                                        Refer Ability : {{$rev->refer_ability}}
                                    </div>
                                </div>
                                <div class="container my-5 faq ">
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong> Please tell us about your business and what is your role
                                        </strong> <br>
                                          {{$rev->company_position}}  </p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>What specific challenges were you facing before working with {{$company->name}}
                                        </strong> <br>
                                            {{$rev->for_what_project}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>What were your main concerns or pain points related to your project?

                                        </strong> <br>
                                            {{$rev->area_of_improvements}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>Tell us about the project in detail
                                        </strong> <br>
                                            {{$rev->scope_of_work}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>What services did you receive from <b>{{$company->name}}? </b>  for eg. Digital Marketing, Web design, Mobile App development)
                                        </strong> <br>
                                          {{$rev->how_select}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>What factors led to the selection of the vendor

                                        </strong> <br>
                                            {{$rev->team_composition}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>Talk about how the vendor made this project a success


                                        </strong> <br>
                                          {{$rev->any_outcome}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>In what ways have the services positively impacted your business? (eg. increased sales, improved brand awareness, Enhanced user engagement)


                                        </strong> <br>
                                           {{$rev->how_effective}}</p>
                                    </div>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"> <strong>What were the top 3 things that impressed you the most about the vendor (eg. communication, expertise, creativity, process etc)Is there anything else you would like to share about your experience
                                        </strong> <br>
                                            {{$rev->most_impressive}}</p>
                                    </div>
                                </div>
                            <div class="container my-5 faq">
                                {{-- <?php foreach ($review['faq'] as $faq): ?>
                                    <div class="border p-2 px-3 mb-2 ml-md-2 ml-0">
                                        <p class="mb-0"><strong><?php echo $faq; ?></strong><br>
                                            dummy text of the printingdummy text of the printing text of the printing text of the printing text of the printing text of
                                        </p>
                                    </div>
                                <?php endforeach; ?> --}}
                            </div>
                        </div>
                    <?php endforeach; ?>
                  
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script type="text/javascript">
            var showHideReview;
            var showHideAdd;
            $(document).ready(function() {
                showHideAdd = function(idd, idd1) {
                    $("#" + idd).hide();
                    $("#" + idd1).show();
                }
            });
            $(document).ready(function() {
                showHideReview = function(idd, idd1, idd2) {
                    $("." + idd2).toggle();
                    $("." + idd).hide();
                    $("." + idd1).show();
                }
            });
        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                @foreach ($add_industry as $item)
                    var containerId = "piechart_{{ str_replace('-', '_', Str::slug($item->industry->name)) }}";
                    var containerElement = document.getElementById(containerId);
                    if (containerElement) {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Percentage'],
                            ['{{ $item->industry->name }}', {{ $item->percent }}],
                            ['', {{ 100 - $item->percent }}]
                        ]);

                        var options = {
                            'title': '{{ $item->industry->name }}',
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
            }
        </script>

        <script>
            //    <script>
            function initMap() {
                var firstAddress = document.querySelector('.scroll-content .address');
                var city = firstAddress.querySelector('b').innerText;
                var autocomplete = firstAddress.nextElementSibling.innerText;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': autocomplete
                }, function(results, status) {
                    if (status === 'OK' && results && results.length > 0) {
                        var location = results[0].geometry.location;
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: location,
                            zoom: 8
                        });
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                initMap();
                var addresses = document.querySelectorAll('.scroll-content .address');
                addresses.forEach(function(address) {
                    address.addEventListener('click', function() {
                        var city = this.querySelector('b').innerText;
                        var autocomplete = this.nextElementSibling.innerText;
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({
                            'address': autocomplete
                        }, function(results, status) {
                            if (status === 'OK' && results && results.length > 0) {
                                var location = results[0].geometry.location;
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    center: location,
                                    zoom: 8
                                });
                            } else {
                                alert('Geocode was not successful for the following reason: ' +
                                    status);
                            }
                        });
                    });
                });
            });
        </script>
       







        

        <!-- Include Google Maps JavaScript API with your API key -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy836GvKy71SW3C0NQ3FdGkuNjlce_fOA&callback=initMap" async
            defer></script>
    @endsection
