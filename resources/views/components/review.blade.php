@php
use Carbon\Carbon;
@endphp
{{-- <div class="container mt-5 reviews-sec greybox"> --}}
    {{-- <h2 class="my-heading"> Reviews </h2> --}}
    <h4>{{ $review->project_type }}</h4>
    <div class="row reviewby">
        <div class="col-md-4 greybox">
            <h3><i style="font-size:24px" class="fa">&#xf27b;</i> Reviewed By</h3>
            <div class="d-lg-flex userbox">
                <div class="d-lg-flex user-img">
                    <img src="{{ $review['user_image'] ?? asset('img/black-image.png') }}" alt="" class="img-fluid d-md-inline d-table mx-auto">
                    <div class="user-name text-center text-md-left">
                        <h2>{{ $review->fullname }}</h2>
                        <p>{{ $review->position_title }} | {{ $review->company_name }} | {{ $review->country }}</p>
                    </div>
                </div>
                <div class="text-center text-md-left">
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
                        <p>{{ $review['services_provided'] }}</p>
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
                        <p>{{ Carbon::parse($review['project_start_date'])->format('F Y') }} - {{ Carbon::parse($review['project_end_date'])->format('F Y') }}</p>
                    </div>
                </div>
                <div class="d-lg-flex reviewby pt-1">
                    <div class="ptitle mb-2 mb-lg-0"><button>Client Size</button></div>
                    <div>
                        <p>{{ $review['company_size'] }}</p>
                    </div>
                </div>
                <div class="d-lg-flex reviewby pt-1">
                    <div class="ptitle mb-2 mb-lg-0"><button>Client Industry</button></div>
                    <div>
                        <p>{{ $review['client_industry'] }}</p>
                    </div>
                </div>
            </div>
            <p class="dotted"></p>
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
                    <li><a href="#tab1-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Company Information</a></li>
                    <li><a href="#tab2-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Problem Statement</a></li>
                    <li><a href="#tab3-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Engagement Details</a></li>
                    <li><a href="#tab4-{{ $review->id }}"><i style="font-size:17px" class="fa">&#xf097;</i> Success Story</a></li>
                </ul>
                <div class="tabs-content">
                    <div id="tab1-{{ $review->id }}" class="tab-content">
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>Please tell us about your business and what is your role</b></p>
                        <p>{{ $review->company_position }}</p>
                    </div>
                    <div id="tab2-{{ $review->id }}" class="tab-content">
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>What specific challenges were you facing before working with {{ $review->company->name }}</b></p>
                        <p>{{ $review->for_what_project }}</p>
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>What were your main concerns or pain points related to your project?</b></p>
                        <p>{{ $review->area_of_improvements }}</p>
                    </div>
                    <div id="tab3-{{ $review->id }}" class="tab-content">
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>Tell us about the project in detail</b></p>
                        <p>{{ $review->scope_of_work }}</p>
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>What services did you receive from {{ $review->company->name }}? For example, Digital Marketing, Web design, Mobile App development.</b></p>
                        <p>{{ $review->how_select }}</p>
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>What factors led to the selection of the vendor</b></p>
                        <p>{{ $review->team_composition }}</p>
                    </div>
                    <div id="tab4-{{ $review->id }}" class="tab-content">
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>Talk about how the vendor made this project a success</b></p>
                        <p>{{ $review->any_outcome }}</p>
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>In what ways have the services positively impacted your business? (e.g., increased sales, improved brand awareness, enhanced user engagement)</b></p>
                        <p>{{ $review->how_effective }}</p>
                        <p><i style="font-size:24px" class="fa">&#xf29c;"></i> <b>What were the top 3 things that impressed you the most about the vendor (e.g., communication, expertise, creativity, process etc)? Is there anything else you would like to share about your experience?</b></p>
                        <p>{{ $review->most_impressive }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
