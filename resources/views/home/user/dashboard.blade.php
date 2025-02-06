@extends('layouts.home-master')

@section('content')
{{-- <link rel="stylesheet" href="css/style.css"> --}}


@if(Session::has('message'))
<div class="alert alert-success" style="text-align:center;font-weight: bolder;">{{ Session::get('message') }}</div>
@endif

<section class="text-center mt-3">
    <h2>Dashboard</h2>
</section>

<section class="container  mt-3 ">
    <div class="top-box">
        <div class="row third-box mx-0">
            <div class="col-lg-4 p-0 m-0">
                <h2>Profile</h2>
                <div class="box second-box">
                    <p> Last updated: {{ date('M d, Y', strtotime($company->updated_at)) }}</p>
                </div>
                <div class="logo-box">
                    <div>
                        <div class="d-flex logo-inner logoimg align-items-center">
                            <img src='{{ url("storage/$company->logo") }}' alt="Company Logo" class="img-fluid"
                                style="width: 50px; height: 50px;">
                            <p class="ml-2" style=" color:#9e7155;"><strong>{{ ucfirst($company->name) }}</strong></p>
                        </div>
                        <p class="pt-2"> {{ ucfirst($company->tagline) }}</p>
                        <p>
                            <strong>Profile Status:</strong>
                            @if ($company->status == 1)
                            <span style="color: green;">Active</span>
                            @else
                            <span style="color: red;">Inactive</span>
                            @endif
                        </p>
                        <div class="d-flex align-items-center">
                            @if (isset($currentSubscription[0]))
                                <p class="m-0">{{ $currentSubscription[0]->plan->name }}</p>
                                <a href="{{ url('/membership-plans') }}" class="btn  ml-2" style="background-color:#00bdd6!important;">Upgrade Now</a>
                            @else
                                <p class="m-0">No current subscription</p>
                                <a href="{{ url('/membership-plans') }}" class="btn  ml-2" style="background-color:#00bdd6!important;">Subscribe Now</a>
                            @endif
                        </div>

                        <div class="d-flex align-items-center my-2">
                            <img src="/img/tag.png" alt="Tag Icon" class="img-fluid" style="width: 20px; height: 20px;">
                            <a href="{{ $company->website }}" class="ml-2 website-txt">{{ $company->website }}</a>
                        </div>
                        <p><a href="mailto:{{ $company->email }}" class="website-txt">{{ $company->email }}</a></p>
                        <div class="d-flex align-items-center">
                            <img src="/img/user.png" alt="User Icon" class="img-fluid"
                                style="width: 20px; height: 20px;">
                            <p class="ml-2 m-0">Service Lines: {{ $serviceLineCount }}</p>
                        </div>
                        <div class="d-flex justify-content-between btnbox mt-3">
                            <a href="{{ route('profile', ['company' => $company->id]) }}"
                                class="btn btn-secondary w-100 mr-1">View Profile</a>


                            <a href="{{ route('user.basicInfo', ['user' => auth()->user()->id]) }}"
                                class="btn btn-secondary w-100 ml-1">Edit / Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pt-3 pt-md-0 pl-0 pr-0 m-0 ">
                <h2>Reviews</h2>
                <div class="box second-box ">
                    <p>Add at least three reviews to your profile to increase visibility</p>
                </div>
                <div class="logo-box   greybox">
                    <div>
                        <p class="pt-2 ">The Basic / Free profile has a limit of 3 reviews. Go ahead and try it.</p>
                        <p> Send a message to your customers to leave a review for you over here. We verify all
                            reviews by contacting customers for the genuineness. If we are not able to get in touch
                            with your customer after reasonable attempts, the review will not be published.</p>
                        <p> Only 1st 3 reviews will be published in the free tier. To publish more reviews.
                            <a href="{{ url('/membership-plans') }}"
                                style="background-color:#00bdd6!important;    font-size: 13px!important;">Upgrade your
                                plan now</a>
                        </p>
                    </div>
                    <div class="container mt-5 p-0">
                        <div class="row mt-1 justify-content-between">
                            <div class="col-xl-6 mb-xl-0 mb-2">
                                <a href="{{ route('reviews.listView') }}" class="btn w-100">Manage Reviews</a>
                                <div class="reviewcount">You have {{ $reviewCount }} reviews</div>

                            </div>
                            <div class="col-xl-6 text-xl-right">
                                <a href="{{ route('comapany.reviews.request.index') }}" class="btn w-100">Request A
                                    Review</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pt-4 pt-md-0 pl-0 pr-0 m-0">
                <h2>Portfolio</h2>
                <div class="box second-box">
                    <p> 0 Reviews Requested</p>
                </div>
                <div class="logo-box review">
                    <div>
                        <div class="d-flex logo-inner tagimg">
                            <a href="{{ route('portfolio.create') }}" class="btn">Add Photos</a>
                            <p class="p-0">Only jpg and png allowed</p>
                        </div>
                        <div class="d-flex logo-inner tagimg mt-4 mb-4">
                            <a href="{{ route('portfolio.create') }}" class="btn">Add Videos</a>
                            <p class="p-0">Only youtube files allowed</p>
                        </div>
                        <div class="d-flex logo-inner mb-4 mb-md-0 tagimg">
                            <a href="{{ route('portfolio.create') }}" class="btn">Add White Papers</a>
                            <p class="p-0">Only pdf allowed</p>
                        </div>
                        <a href="{{ route('portfolio_items.tableView') }}" class="btn editupdate">Edit / Update Portfolio</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="container  mt-3">
    <div class="row mx-0">
        <div class="col-md-4 p-0 m-0 ">
            <div class="border">
                <div class="address p-3">
                    <h3>Your Addresses</h3>
                    @foreach($addresses as $index => $address)
                    <h4 class="{{ $index == 0 ? 'mt-4' : 'mt-5 pt-2' }} {{ $index > 1 ? 'additional-address' : '' }}" {{
                        $index> 1 ? 'style=display:none;' : '' }}">
                        {{ $index == 0 ? 'HeadQuarters' : 'Location ' . ($index + 1) }}
                    </h4>
                    <div class="row justify-content-between mb-3 {{ $index > 1 ? 'additional-address' : '' }}" {{
                        $index> 1 ? 'style=display:none;' : '' }}>
                        <div class="col-lg-9 d-lg-flex align-items-center text-center text-lg-left">
                            <img src="/img/a1.png" alt="Location Image" class="img-fluid mr-2"
                                style="width: 50px; height: 50px;">
                            <div class="my-2 my-lg-0">
                                <p class="mb-1">{{ $address->autocomplete }}</p>

                            </div>
                        </div>
                        <div class="col-lg-3 text-center text-lg-right">
                            <img src="/img/arrow-img.png" alt="Arrow" class="img-fluid arrow"
                                style="width: 20px; height: 20px;">
                        </div>
                    </div>
                    @endforeach

                    @if(count($addresses) > 2)
                    <div class="row justify-content-center mt-4">
                        <button id="show-more-btn" class="btn btn-primary" onclick="toggleAdditionalAddresses()">Show
                            More</button>
                    </div>
                    @endif


                    <!-- Location 2 end-->
                    <!-- Your Industries 1-->
                    <h3 class="mt-5 pt-2">Your Industries</h3>
                    @foreach($industries as $index => $industry)
                    <div class="row mt-3 {{ $index >= 3 ? 'additional-industry' : '' }}"
                        style="{{ $index >= 3 ? 'display:none;' : '' }}">
                        <div class="col-lg-6 mb-2 mb-lg-0">
                            <p>{{ $industry->industry->name }}</p>
                        </div>
                        <div class="col-lg-6 text-center text-lg-left">
                            <input type="text" value="{{ $industry->percent }}">
                        </div>
                    </div>
                    @endforeach

                    @if(count($industries) > 3)
                    <div class="row d-flex mt-3">
                        <div class="col-6">
                            <a href="#" id="show-more-btn" onclick="toggleAdditionalIndustries()">Show More</a>
                        </div>
                        <div class="col-6 m-0 p-0 text-right">
                            <a href="{{ route('company.industry', ['company_id' => $company->id]) }}">Edit
                                Industries</a>
                        </div>
                    </div>
                    @endif
                    <h3 class="mt-5">Your Client Size</h3>
                    @foreach($clientSizes as $index => $clientSize)
                    <div class="row mt-3 {{ $index >= 3 ? 'additional-client-size' : '' }}"
                        style="{{ $index >= 3 ? 'display:none;' : '' }}">
                        <div class="col-lg-6 mb-2 mb-lg-0">
                            <p>{{ $clientSize->client_size->name }}</p>
                        </div>
                        <div class="col-lg-6 text-center text-lg-left">
                            <input type="text" value="{{ $clientSize->percent }}">
                        </div>
                    </div>
                    @endforeach

                    @if(count($clientSizes) > 3)
                    <div class="row d-flex mt-3">
                        <div class="col-md-12 text-center">
                            <a href="#" id="show-more-client-size-btn" onclick="toggleAdditionalClientSizes()">Show
                                More</a>
                        </div>
                    </div>
                    @endif

                    <div class="row d-flex mt-3">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('company.industry', ['company_id' => $company->id]) }}">Edit Client
                                Size</a>
                        </div>
                    </div>


                    <!-- btn -->
                </div>
            </div>
            <div class="text-center"> <button class="leads">Leads / Opportunities</button></div>
        </div>
        <div class="col-md-8 p-0 m-0 service">
            <!-- 1st row -->
            <div class="border border mt-5 mt-md-0 ml-3 p-3">
                <h3 class="mb-4">Your Service Areas</h3>
                @foreach($serviceLines as $index => $serviceLine)
                <div class="service-line mb-5 {{ $index > 1 ? 'd-none additional-service-line' : '' }}">
                    <!-- Increased margin-bottom for better separation -->
                    <div class="category-group ">
                        <p class="field-name"><b>Primary Category</b></p>
                        <div class="cate-box ">
                            <p>{{ $serviceLine['category_name'] }}</p>
                            <input type="text" value="{{ $serviceLine['inputValue'] }}" class="percentage-input">
                        </div>
                    </div>

                    <div class="subcategory-section">
                        <div class="subcategory-group mb-3">
                            <p class="field-name"><b>Sub Category</b></p>
                            <div class="subcategoybox">
                                @foreach($serviceLine['subcategories'] as $subcategory)

                                <div class="cate-box mt-2 mt-lg-0">
                                    <p>{{ $subcategory['subcategory_name'] }}</p>
                                    <input type="text" value="{{ $subcategory['value'] }}" class="percentage-input">

                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="skills-group mb-3">
                            <p class="field-name mb-2"><b>Skills</b></p>
                            <div class="skill-tags">
                                @foreach($serviceLine['subcategories'] as $subcategory)
                                @foreach($subcategory['skills'] as $skill)
                                <a href="#" class="skill-tag">{{ $skill['skill_name'] }}</a>
                                @endforeach
                                @endforeach
                            </div>
                        </div>

                        <div class="deep-skills-group mb-3">
                            <p class="field-name mb-2"><b>Deep Skills</b></p>
                            <div class="deep-skill-tags">
                                @foreach($serviceLine['subcategories'] as $subcategory)
                                @foreach($subcategory['skills'] as $skill)
                                @foreach($skill['subskills'] as $subskill)
                                <a href="#" class="deep-skill-tag">{{ $subskill['subskill_name'] }}</a>
                                @endforeach
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @if(count($serviceLines) > 2)
                <div class="row mt-4 mb-3 area">
                    <div class="col-5 col-md-4">
                        <a href="#" id="show-more-btn" onclick="toggleAdditionalServiceLines(event)">Show More</a>
                    </div>
                    <div class="col-7 col-md-8 text-right">
                        {{-- <a href="{{ route('company.service-areas.edit', ['company_id' => $company->id]) }}">Edit
                            Service Areas</a> --}}
                    </div>
                </div>
                @endif
            </div>
            <img src="/img/placeholder.png" alt="" class="img-fluid p-2 ml-2">
            <div class="row mb-3 ml-2 area mb-5">
                <div class="col-4 ">
                <div class="d-flex ppack">
                 <img src="/img/package.png" alt="" class="img-fluid p-2 ml-2 ">   <a href="#">Packages</a>
                </div>
                </div>
                <div class="col-8 text-right pl-5 ">
                    <div class="d-flex pack">
                  <a href="#">Visibility Opportunity</a><img src="/img/arrowss.png" alt="" class="img-fluid p-2 ml-2 ">
                  </div>
                </div>
            </div>
        </div>



    </div>
    </div>
</section>
<script>
    document.getElementById('show-more-service-areas').addEventListener('click', function () {
        const content = document.getElementById('service-areas-content');
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            this.innerText = 'Show Less';
        } else {
            content.style.display = 'none';
            this.innerText = 'Show More';
        }
    });
    // <script>
function toggleAdditionalAddresses() {
    var additionalAddresses = document.querySelectorAll('.additional-address');
    var showMoreBtn = document.getElementById('show-more-btn');
    additionalAddresses.forEach(function(address) {
        if (address.style.display === 'none') {
            address.style.display = 'flex';
            showMoreBtn.textContent = 'Show Less';
        } else {
            address.style.display = 'none';
            showMoreBtn.textContent = 'Show More';
        }
    });
}

function toggleAdditionalIndustries() {
    var additionalIndustries = document.querySelectorAll('.additional-industry');
    var showMoreBtn = document.getElementById('show-more-btn');
    additionalIndustries.forEach(function(industry) {
        if (industry.style.display === 'none') {
            industry.style.display = 'flex';
        } else {
            industry.style.display = 'none';
        }
    });
    showMoreBtn.textContent = showMoreBtn.textContent === 'Show More' ? 'Show Less' : 'Show More';
}

            function toggleAdditionalServiceLines(event) {
                event.preventDefault();
                const additionalServiceLines = document.querySelectorAll('.additional-service-line');
                additionalServiceLines.forEach(serviceLine => {
                    serviceLine.classList.toggle('d-none');
                });
                const showMoreBtn = document.getElementById('show-more-btn');
                showMoreBtn.innerText = showMoreBtn.innerText === 'Show More' ? 'Show Less' : 'Show More';
            }
</script>
@endsection