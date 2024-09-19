@php
use Carbon\Carbon;
$user = auth()->user();
// dd($user);
$userCompanyIds = $user && $user->companies ? $user->companies->pluck('id')->toArray() : [];
@endphp

{{-- <div class="container  mt-3 mt-md-2 p-0 reviews-sec greybox"> --}}
{{-- <h2 class="my-heading"> Reviews </h2> --}}
<h4 class="headingtxt">{{ $review->project_type }}</h4>
@if(in_array($review->company_id, $userCompanyIds))
<!-- <div class="mt-2">
    <button type="button" class="btn btn-respond" data-toggle="modal" data-target="#respondModal">
        Respond to Review
    </button>
</div> -->
@endif
<link rel="stylesheet" type="text/css"
    href="https://theytrust-us.developmentserver.info/front_components/css/custom.css">
<div class="row p-md-4 p-0 sidebar-review-box">
    <div class="col-md-4 greybox ">
        <h3 class="sidebar"><i style="font-size:24px" class="fa">&#xf27b;</i> Reviewed By</h3>
        <div class="d-lg-flex userbox">
            <div class="d-lg-flex user-img">
                @php
                $avatarUrl = $review->user->avatar ??
                "https://theytrust-us.developmentserver.info/front_components/images/logo.png";
                if (!Str::startsWith($avatarUrl, ['http://', 'https://'])) {
                $avatarUrl = url($avatarUrl);
                }

                @endphp
                <img src={{ $avatarUrl }} alt="" class="img-fluid d-md-inline d-table mx-auto">
                <div class="user-name sidebarheading userboxes text-center text-md-left">
                    <h3>{{ $review->fullname }}</h3>
                    <h3>Aman</h3>
                    <h5 class="sideh4">{{ $review->position_title }} | {{ $review->company_name }} |
                        {{ $review->country }}</h5>

                </div>
            </div>
            <div class="text-center text-md-left reviewrate">
                <br> {!! generateStarRating($review['overall_rating']) !!}
            </div>
        </div>
        <div class="user-col">
            <div class="d-lg-flex reviewby pt-2">
                <div class="ptitle mb-2 mb-lg-0"><button>Project Type</button></div>
                <div>
                    <p>{{ $review['project_type'] }}</p>
                </div>
            </div>
            <div class="d-lg-flex reviewby pt-1">
                <div class="ptitle mb-2 mb-lg-0"><button>Services Provided</button></div>
                <div>
                    <p>{{  $review->how_effective }}</p>
                </div>
            </div>
            <div class="d-lg-flex reviewby pt-1">
                <div class="ptitle mb-2 mb-lg-0"><button>Project Value</button></div>
                <div>
                    <p>{{ $review['cost_range'] }}</p>
                </div>
            </div>
            <div class="d-lg-flex reviewby pt-1">
                <div class="ptitle mb-2 mb-lg-0"><button>Project Duration</button></div>
                <div>
                    <p>{{ Carbon::parse($review['project_start_date'])->format('F Y') }} - {{
                            Carbon::parse($review['project_end_date'])->format('F Y') }}</p>
                </div>
            </div>
            <div class="d-lg-flex reviewby pt-1">
                <div class="ptitle mb-2 mb-lg-0"><button>Client Size</button></div>
                <div>
                    <p>{{ $review['company_size'] }}</p>
                </div>
            </div>
            <div class="d-lg-flex reviewby pt-1 pb-2">
                <div class="ptitle mb-2 mb-lg-0"><button>Client Industry</button></div>
                <div>
                    <p>{{ $review['client_industry'] }}</p>
                </div>
            </div>
        </div>
        <!-- <p class="dotted"></p> -->
        <div class="d-flex reviewby">
            <div class="ptitle"><button>Project Title</button></div>
        </div>
        <div class="qualitybox row">
            <div class="pt-4 qualityreview">
                <button>Quality</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['quality']) !!}
                </div>
                <button>{{ $review['quality'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Timeliness</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['timeliness']) !!}
                </div>
                <button>{{ $review['timeliness'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Cost</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['cost']) !!}
                </div>
                <button>{{ $review['cost'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Expertise</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['expertise']) !!}
                </div>
                <button>{{ $review['expertise'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Communication</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['communication']) !!}
                </div>
                <button>{{ $review['communication'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Ease of Working</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['ease_of_working']) !!}
                </div>
                <button>{{ $review['ease_of_working'] }}</button>
            </div>
            <div class="pt-4 qualityreview">
                <button>Referability</button>
                <div class="star d-flex">
                    {!! generateStarChecked($review['refer_ability']) !!}
                </div>
                <button>{{ $review['refer_ability'] }}</button>
            </div>
        </div>
    </div>
    <div class="col-md-8 tab-box">
        <div class="tabs">
            <ul class="tabs-nav">
                <li><a href="#tab1-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Company
                        Information</a></li>
                <li><a href="#tab2-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Problem
                        Statement</a></li>
                <li><a href="#tab3-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Engagement
                        Details</a></li>
                <li><a href="#tab4-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Success
                        Story</a></li>
            </ul>
            <div class="tabs-content">
                <div id="tab1-{{ $review->id }}" class="tab-content">
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>Please tell us about your business and
                            what is your role</b></p>
                    <p>{{ $review->company_position }}</p>
                </div>
                <div id="tab2-{{ $review->id }}" class="tab-content">
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>What specific challenges were you
                            facing before working with {{ $review->company->name }}</b></p>
                    <p>{{ $review->for_what_project }}</p>
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>What were your main concerns or pain
                            points related to your project?</b></p>
                    <p>{{ $review->area_of_improvements }}</p>
                </div>
                <div id="tab3-{{ $review->id }}" class="tab-content">
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>Tell us about the project in
                            detail</b></p>
                    <p>{{ $review->scope_of_work }}</p>
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>What services did you receive from {{
                                $review->company->name }}? For example, Digital Marketing, Web design, Mobile App
                            development.</b></p>
                    <p>{{ $review->how_select }}</p>
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>What factors led to the selection of
                            the vendor</b></p>
                    <p>{{ $review->team_composition }}</p>
                </div>
                <div id="tab4-{{ $review->id }}" class="tab-content">
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>Talk about how the vendor made this
                            project a success</b></p>
                    <p>{{ $review->any_outcome }}</p>
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>In what ways have the services
                            positively impacted your business? (e.g., increased sales, improved brand awareness,
                            enhanced user engagement)</b></p>
                    <p>{{ $review->how_effective }}</p>
                    <p><i style="font-size:24px" class="fa">&#xf29c;</i> <b>What were the top 3 things that
                            impressed you the most about the vendor (e.g., communication, expertise, creativity,
                            process etc)? Is there anything else you would like to share about your experience?</b>
                    </p>
                    <p>{{ $review->most_impressive }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="respondModal" tabindex="-1" aria-labelledby="respondModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="respondModalLabel">Respond to Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('submit.response') }}" method="POST">
                    @csrf
                    <input type="hidden" name="review_id" value="{{ $review->id }}">

                    <div class="form-group">
                        <label for="reviewComment">Your Comment</label>
                        <textarea class="form-control" id="reviewComment" name="comment"
                            rows="3">{{ old('comment', $review->comment) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('styles')
<style>
    .timecss {
        background-color: #000;
    }

    .case p {
        font-size: 1rem;
    }

    .short-description {
        font-size: 1rem;
    }

    /* .portfolio .reviews-sec h3 {
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;
    } */

    /* .portfolio .scroll-content p b {
            color: #388cff;
        } */
       .sidebar-review-box .sidebar{
            margin-left:1px!important;
        }
    .portfolio .location-sec iframe {
        width: 100%;
        /* height: 100%; */
        border-radius: 5px;
    }

    .portfolio .location-sec p {
        font-size: 15px;
        margin: 0;
    }

    .portfolio .scroll-content {
        display: inline-block;
        white-space: normal;
    }

    .portfolio .scroll-container {
        width: 100%;
        white-space: nowrap;
        overflow-x: auto;
        height: 250px;
        padding-right: 15px;
    }

    .portfolio .reviews-row {
        display: flex;
        justify-content: end;
    }

    .portfolio .reviews-row .fa {
        font-size: 20px;
    }

    /* .portfolio .bluestar {
            color: #388cff;
        } */

    .portfolio .reviews-row h3 {
        font-size: 16px;
    }

    .portfolio .gray-bg {
        background-color: #f9f9fc;
    }

    .portfolio .my-heading {
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;
        margin: 0;
        color: #000;
    }

    .portfolio .target-sec h2.area {
        border-radius: 3px 0 0 3px;
    }

    .portfolio .target-sec h2.industries {
        border-radius: 0 3px 3px 0;
    }

    .portfolio .target-sec h3 {
        font-size: 20px;
        font-weight: bold;

        margin-bottom: 0;
    }

    .portfolio .btn-target {

        padding: 10px 15px;
        border-radius: 0 0 5px 5px;
        text-decoration: none;
        display: block;
        color: #000;
        border-top: 0;
        font-weight: bold;
        transition: all .3s;
    }

    /* .portfolio .btn-target:hover {
            color: #fff;
            text-decoration: none;
            background-color: #95c7ef;
        } */
    .portfolio .topsec h2 {
        font-size: 28px;
        font-weight: 700;
    }

    .portfolio .topsec h3 {
        font-size: 20px;
        font-weight: 400;
    }

    .portfolio .topsec p {
        margin-top: 20px;
    }

    .portfolio .topsec p span {
        margin-right: 23px;
    }

    .portfolio .target-sec .greybox {
        background-color: #dde1e5;
        width: fit-content;
        text-align: center;
        padding: 7px 30px 10px 30px;
        margin-bottom: 24px;
    }

    .portfolio .target-sec .indusbox {
        background-color: #dde1e5;
        width: fit-content;
        text-align: center;
        padding: 7px 30px 10px 30px;
    }

    .portfolio .target-service img {
        width: 20%;
    }

    .portfolio .target-service h3 {
        margin-left: 10px;
        text-align: left;
    }

    .portfolio .greybox h2 {
        background-color: #dde1e5;
        padding: 7px 30px 10px 30px;
        width: fit-content;
        margin-bottom: 18px;
    }

    /* .portfolio .greybox h4 {
            background-color: #dde1e5;
    padding: 6px 15px 9px 15px;
    width: fit-content;
    margin-bottom: 18px;
    font-size: 14px;
    text-transform: capitalize;
    font-weight: bold;
    font-family: "Epilogue", sans-serif;
        } */
    .sideh4 {
        background-color: none;
        font-size: 14px;
    font-weight: 700;
    font-family: "Inter", sans-serif;
        margin-left: 11px;
        margin-top: 0;
        color: #2a2e33;
        text-transform: capitalize;
      
    }


    .sidebarheading h3{
     
        font-size: 14px;
    font-weight: 700;
    font-family: "Inter", sans-serif;
     
        color: #77797c;
       
    
    }

    .sidebarheading h5{
     
     font-size: 12px;
 font-weight: 400;
 font-family: "Inter", sans-serif;
  
     color: #2b2e32;
    
 
 }







    h4.sidebar{
        background-color:#dee1e6 !important
    }

    .btn-respond{
        font-weight: bold !important;
    cursor: pointer!important;
    background-color: #9095a0 !important;
    color: #fff !important;
    /* border-radius: 0 !important; */
    margin-bottom: 15px;
 
 /* &:hover{
    background-color: #00bdd6 !important;  
 } */
    }

    .portfolio .reviews-sec h4 {
        background-color: #e7def9;
        padding: 11px 15px 10px 15px;
        font-size: 16px;
    font-weight: 700;
font-family: "Epilogue", sans-serif;
        margin: 0 0 10px 0;
      
    }
.sidebar-review-box .sidebar{
    font-size: 14px;
    font-weight: 700;
font-family: "Epilogue", sans-serif; 
}
    .portfolio .details button {
        color: #fff;
        background-color: #00bdd6 !important;
        border-color: #00bdd6 !important;
        border-radius: 5px;
        padding: 3px 8px 7px 8px;
        font-size: 13px;
        margin-right: 5px;
    }

    .portfolio .ptitle {
        min-width: 143px;
    }

    .portfolio .sidebar-review-box button {
        color: #00bdd6;
        background-color: #00bdd62e !important;
        border-color: #00bdd6 !important;
        border-radius: 5px;
        padding: 3px 8px 7px 8px;
        font-size: 13px;
        margin-right: 5px;
        font-weight: bold;
        border: 0;
        border-radius: 14px;
    }

    .sidebar-review-box .ptitle button
    {
        background-color: #ebfdff !important;
    }

    /* .portfolio .reviewby {
            padding: 0 20px;
        } */

    .portfolio .user-col p {
        font-size: 15px;
    }

    /* .portfolio .reviewby .col-md-4 {

            padding: 0 18px 0 0px;
            border-right: 1px solid #ccc;
            border-top: 1px solid #ccc;
        } */

    .tab-box {
        border-right: 1px solid #ccc;
        padding: 0;
    }

    .portfolio .sidebar-review-box p.dotted {
        border-bottom: 3px dashed #767575;
        padding-top: 22px;
    }

    .portfolio .sidebar-review-box .userbox {
        justify-content: flex-start;
    }

    .portfolio .sidebar-review-box .user-name h2 {
        font-size: 20px;
        font-weight: bold;
        background-color: #fff !important;
        margin: 0;
        padding: 0;
    }

    .portfolio .userbox p {
        font-size: 10px;
    }

    .portfolio .userbox .user-img img {
        width: 31px;
        margin-right: 8px;

    }

    /* .portfolio .qualityreview {
            display: flex;
            flex-direction: column;
            padding: 0 8px;
        } */

    .portfolio .qualitybox {
        display: flex;
        width: 100%;
        justify-content: center;
    }

    .portfolio .sidebar-review-box .qualityreview button {
        color: #000;
        background-color: #f2f3f5 !important;
        border-color: #f2f3f5 !important;
        border-radius: 5px;
        padding: 3px 8px 7px 8px;
        font-size: 13px;
        margin-right: 5px;
        font-weight: bold;
        border: 0;
        border-radius: 14px;
    }

    .checked {
        color: orange;
    }

    .portfolio ul.tabs-nav li.active {
        background-color: #565e6c !important;
    }

    .tabs-nav .active{
        background-color:#565e6b
    }

    .tabs-nav .active{
        background-color:#565e6b
    }


    /* .portfolio .bluestar {
            color: orange !important;
        } */

    .star {
        padding: 11px 0;
    }

    /* tab */
    /* Tabs */
    .portfolio .tabs {
        width: 100%;
        border-radius: 5px 5px 5px 5px;
        padding: 0 0px 0 28px;
    }

    .tabs-nav {
        background-color: #9095a0;
    }

    .portfolio ul.tabs-nav {
        list-style: none;
        margin: 0;
        padding: 0px;
        overflow: auto;
        background-color: #9095a0 !important;
        display: flex;
        justify-content: space-between;

    }

    .sidebar-review-box .qualitybox {
        display: flex;
        flex-wrap: wrap;
        gap: 39px;
        margin-top: 20px;
        margin-left: -2px;
    }






    .headingtxt {
        font-size: 18px !important;
        font-weight: 700;
        margin-bottom: 5px;
        margin-left: 11px;
        color: #171a1f !important;
        text-transform: capitalize;
        font-family: "Epilogue", sans-serif;
    }






    .portfolio ul.tabs-nav li {
        float: left;
        font-weight: bold;
        /* margin-right: 2px;
        padding: 7px 13px; */
        border-right: 1px solid #fff;
        line-height: 18px;
        cursor: pointer;
        background-color: #9095a0;
        text-align:left;
        width: 100%;
    }

    .portfolio ul.tabs-nav i{
        margin-right:6px
    }



    .portfolio ul.tabs-nav li:last-child {
        border: 0;
    }

    .portfolio .reviewby .user-name h2 {
        font-size: 20px;
        font-weight: bold;
        background-color: #fff !important;
        margin: 0;
        padding: 0;
        color: #000 !important;
    }

    .portfolio ul.tabs-nav li.active {
        background-color: #565e6c;

    }

    .portfolio .tabs-nav li a {
        text-decoration: none;
    color: #FFF;
 
    padding: 7px 5px;
    width: 100%;
    display: flex;
    cursor: pointer;
    align-items: center;
    cursor: pointer;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
font-family: "Epilogue", sans-serif;

    }

    .portfolio ul.tabs-nav li:hover,
    .portfolio ul.tabs-nav li.active {
        background-color: #565e6c;
    }

    .portfolio .tab-content {
        padding: 10px;
        /* border: 5px solid #09F; */
        background-color: #FFF;
    }

    .portfolio .tab-content p {
        display: flex;
        vertical-align: middle;
        text-align: left;
        font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;

    }

    .portfolio .tab-content p b {
        margin-left: 15px;

    }

    .portfolio-details .headingbox {
        background-color: #dde1e5;
    }


    .portfolio-details h2 {
        background-color: #dde1e5;
        padding: 7px 30px 10px 30px;
        width: fit-content;
        margin-bottom: 18px;
        margin-left: 17px;
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;

        color: #000;
    }


    /* tab */

    .readmore a {
        font-size: 13px;
        font-weight: bold;
        color: #000;
        word-spacing: -2px;
    }


    .casestudies h2 {
        background-color: #dde1e5;
        padding: 7px 30px 10px 30px;
        width: fit-content;
        /* margin-bottom: 18px; */
        /* margin-left: 17px; */
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;
        color: #000;

    }

    /* .table-bordered{
    text-align: center;
} */


.sidebar-review-box {
    margin-bottom: 0px;
}
.sidebar-review-box .greybox {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    border: 2px dashed #ddd;
}
.sidebar-review-box h3 {
    font-size: 14px;
    font-weight: 700!important;
    margin-bottom: 5px;
    /* margin-left: 11px; */
    color: #171a1f ;
    text-transform: capitalize;
    font-family: "Epilogue", sans-serif;
}
.userboxes h3 {
    font-size: 14px !important;
    font-weight: 700;
    margin-bottom: 5px;
    margin-left: 11px;
    color: #171a1f !important;
    text-transform: capitalize;
    font-family: "Epilogue", sans-serif;
}
.sidebar-review-box .userbox {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
   
}
.cmpbox {
    border-bottom: 2px solid #ccc;
}
.sidebar-review-box .userbox img {
    width: 46px;
    height: 46px;
    border-radius: 50%;
}
.sidebar-review-box .user-name {
    flex: 1;
}
.sidebar-review-box .user-name h2 {
    font-size: 20px;
    margin: 0;
}
.sidebar-review-box .user-name p {
    margin: 0;
    color: #666;
}
.sidebar-review-box .qualitybox {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
}
.sidebar-review-box .qualityreview {
    flex: 1;
    text-align: center;
}

.checked {
    color: #3ed1f2;
}
.star {
    padding: 11px 0;
}
.ptitle {
    min-width: 121px;
}
.sidebar-review-box .qualityreview .star {
    display: flex;
    justify-content: center;
    gap: 2px;
    font-size: 12px;
}
.sidebar-review-box .qualityreview .star i {
    color: #3ed1f2;
}
.sidebar-review-box .dotted {
    border-top: 2px solid #ddd;
    margin: 20px 0;
}
.recent-reviews .sidebar-review-box .greybox {
    margin-bottom: 20px;
}
.recent-reviews .sidebar-review-box .sidebar-review-box button {
    color: #00bdd6;
    background-color: #00bdd62e !important;
    border-color: #00bdd6 !important;
    border-radius: 5px;
    padding: 5px 7px 7px 7px;
    font-size: 11px;
    margin-right: 5px;
    font-weight: bold;
    border: 0;
    border-radius: 14px;
    font-family: "Epilogue", sans-serif;
}










    @media (max-width: 1199px) {


        .portfolio .reviews-sec h3 {
            font-size: 18px;

        }

        .portfolio .target-sec h3 {
            font-size: 16px;

        }

        .portfolio ul#tabs-nav li {

            padding: 4px 12px;

        }

        .portfolio #tabs-nav li a {

            font-size: 12px;
        }
    }

    @media (max-width: 991px) {

        .portfolio ul.tabs-nav {
  
  display: block;
  
 
}

.portfolio ul.tabs-nav li a {
 
  padding: 11px 13px;
  border-right: 0px solid #fff;

  border-bottom: 1px solid #fff;
}



        .portfolio ul#tabs-nav li {
            padding: 4px 12px;
            width: 49%;
        }

        .portfolio ul#tabs-nav {

            display: block;

        }

        .portfolio ul#tabs-nav li:nth-child(2) {
            border: 0;
        }



    }




    @media (max-width: 767px) {
        .table-responsive {
            padding: 0 0 0 11px;
        }

        .portfolio .scroll-container {

            height: auto;

        }






        .casestudies h2 {

            width: 96%;
            margin: 6px 21px 6px 8px;
        }

        .pdf img {
            min-width: 60%;
            width: 65%;
        }

        .portfolio .my-heading {
            font-size: 17px;
        }

        .portfolio .target-sec h3 {
            font-size: 16px;
        }

        .agency {
            padding: 0;
        }

        .locations {
            padding: 0;
        }

        .reviews-sec {
            padding: 0;
        }

        .portfolio .sidebar-review-box .ptitle {
            width: auto;
            margin: auto;
            text-align: center;
        }

        .case p {
            padding: 0;
            margin: 4px 0 0 0;
        }


        .portfolio .reviews-sec h4 {

            font-size: 19px;
            text-align: center;
        }

        .portfolio ul#tabs-nav li {
            width: 100%;
            border: 0;
        }

        .portfolio .sidebar-review-box .col-md-4 {

            border-right: 0;
            border-top: 0;
            padding-left: 17px;
            margin-bottom: 32px;

        }

        .portfolio .greybox h2 {
            margin-bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .portfolio .greybox h3 {
            width: 100%;
            text-align: center;
            font-size: 17px;
        }

        .tab-box {
            border-right: 0;
            padding: 0;
        }

        .portfolio .sidebar-review-box {
            padding: 0;
            text-align: center;
        }

        .portfolio .details button {

            width: 100%;
        }

        .portfolio .sidebar-review-box button {

            width: 100%;
        }

        .portfolio .tabs {
            width: 100%;

            padding: 0;
        }

        .portfolio .reviews-row {

            justify-content: center;
        }

        .portfolio .target-sec .indusbox {
            width: 100%;
        }

        .portfolio .target-sec .greybox {
            width: 100%;
        }
    }




    @media (max-width: 600px) {
 


    }










</style>

@endpush