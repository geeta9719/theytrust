@extends('layouts.home-master')

@section('content')
<link rel="stylesheet" href="css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .first-sec {
        background-color: #45a2ef;
        border-radius: 4px 4px 0 0;
    }

    .first-sec h2 {
        color: #fff;
        margin: 0;
        font-size: 22px;
        font-weight: 400;
        text-align: center;
    }

    .first-sec .row-2 {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        text-align: center;
        padding: 8px;
        margin-bottom: 5px;
    }

    .first-sec .row-2 p {
        margin: 0;
    }

    .first-sec .row-3 {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;

    }

    .top-box {
        background-color: #45a2ef;
        padding: 6px 0px 0px 0;
        border-radius: 4px 4px 0 0;
        box-sizing: border-box;
        border: 5px solid #45a2ef;
    }

    .top-box h2 {
        color: #fff;
        padding: 0px 20px;
        font-size: 22px;
        font-weight: 400;
        text-align: center;
    }

    .box {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        padding: 0;
        margin: 0;
    }

    .box1 {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        padding: 0;
        margin: 0;
    }

    .second-box p {
        color: #45a2ef;
        font-weight: bold;
        text-align: center;
        font-size: 12px;
        margin: 0;
        padding: 9px;
    }

    .logo-box {
        background-color: #fff;
        margin-top: 4px;
        padding: 20px 12px;
        border-radius: 4px;
        min-height: 84%;
        border-bottom: 5px solid #45a2ef;
    }

    .logo-inner {
        vertical-align: middle;
        align-items: center;
    }
    .logo-inner p {
        margin-left: 10px;
    }

    .third-box p {
        display: block;
    }

    .third-box h3 {
        font-weight: bold;
        font-size: 18px;
        display: block;
    }
    .bottom {
        border-radius: 44px;
        background-color: #45a2ef;
        font-weight: 600;
        font-size: 20px;
        padding: 15px 60px;
        margin-top: 20px;
        margin-left: 15px;
        color: #fff;
    }

    .review .btn {
        margin: 0;
    }

    .btn {
        color: #fff;
        background-color: #00bdd6 !important;
        border-color: #00bdd6 !important;
        /* padding: 3px 0 !important; */
        /* margin-left: 20px; */
        border-radius: 5px;
        padding: 3px 8px 7px 8px;
        font-size: 13px;
    }

    .greybox {
        background-color: #ccc;
    }

    .greybox p {
        font-size: 14px;
    }
    .category-group, .subcategory-group, .skills-group, .deep-skills-group{
        text-align:left;
    }
.subcategoybox{
    display: flex;
    flex-wrap: wrap;
}
    .review p {
        margin: 0 0px 0 20px;
        font-size: 1rem;
    }
    .logo-box p {
        
        font-size: 1rem;
    }
    .address a {
        text-decoration: underline;
    }

    .area a {
        text-decoration: underline;
    }

    .address h3 {
        font-size: 23px;
        font-weight: 700;
    }

    .service h3 {
        font-size: 23px;
        font-weight: 700;
    }

    .address h4 {
        font-size: 16px;
        font-weight: bold;
    }

    .address p {
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }

    .address img {
        width: 50px;
        height: auto;
    }

    .address .arrow {
        width: 23px;
        height: 23px;

    }

    input {
        width: 74px;
        padding: 0;
        margin: 0;
        height: 27px;
        background-color: #ccc;
        border: 1px solid #b0aaaa;
    }

    .service-btn {
        flex-flow: row wrap;
        align-items: center;
    }

    .mobileview {
        flex-flow: row wrap;
        align-items: center;
        margin: 29px 0;
    }

    .service-btn a {
        color: #fff;
        background-color: #858585;
        padding: 5px 20px;
        border-radius: 25px;
        margin-bottom: 11px;
        display: inline-block;
    }

    .service-btn a.white {
        color: #000;
        background-color: #fff;
        padding: 5px 20px;
        border-radius: 25px;
        margin-bottom: 11px;
        display: inline-block;
        border: 1px solid #ccc;
    }

    .leads {
        color: #fff;
        background-color: #00bdd6 !important;
        border-color: #00bdd6 !important;
        border-radius: 12px;
        padding: 3px 52px 4px 52px;
        font-size: 17px;
        margin-top: 20px;
        text-align: center;
        width: 100%;
    }

    .field-name {
        min-width: 170px;
        margin: 0;
        font-size: 1rem;
    }

    .cate-box {
        display: flex;
        width: 190px;
        justify-content: space-between;
        margin-right: 15px;
    }
    .cate-box p{
        font-size: 1rem;
    }
    .cate-box input {
        text-align: center;
    }

    .btn-group {
        justify-content: space-between;
    }

    .cate-box p {
        margin: 0;
    }

    .review .btn {
        min-width: 108px;
    }

    .greybox a {
        color: #fff;
        background-color: #00bdd6 !important;
        border-color: #00bdd6 !important;
        /* padding: 3px 0 !important; */
        /* margin-left: 20px; */
        border-radius: 5px;
        padding: 3px 8px 7px 8px;
        font-size: 13px;
        margin-left: 11px;
    }
    .reviewcount{
        text-align: center;
    color: red;
    margin-top: 11px;
    }

    @media (max-width: 1199px) {

        .greybox a {

            margin-left: 0;
            display: block;
            text-align: center;
            margin-top: 10px;
            width: max-content;
        }

        .box.second-box {
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    @media (max-width: 991px) {
        .logo-box {

            min-height: auto;

        }

        .address h4 {

            text-align: center;
        }

        .address h3 {
            text-align: center;
        }

        .address p {

            text-align: center;
        }
    }

    @media (max-width: 767px) {



        .third-box .col-md-4 {}

        .second-box p {
            font-size: 17px;
        }
    }
    .service-line {
    margin-bottom: 40px; /* Increased margin to create space between primary categories */
}

.category-group,
.subcategory-group,
.skills-group,
.deep-skills-group {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.field-name {
    font-weight: bold;
    margin-right: 10px;
    min-width: 150px; /* Adjusted for better alignment */
}

.cate-box {
    display: flex;
    align-items: center;
    margin-right: 20px;
}

.cate-box p {
    margin: 0;
    margin-right: 10px;
}

.percentage-input {
    width: 60px;
    text-align: center;
    background-color: #e0e0e0;
    border: none;
    padding: 5px;
    margin-left: 10px;
}

.skill-tags,
.deep-skill-tags {
    display: flex;
    flex-wrap: wrap;
}

.skill-tag,
.deep-skill-tag {
    display: inline-block;
    background-color: #ddd;
    padding: 5px 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    border-radius: 15px;
    text-decoration: none;
    color: #333;
}

.skill-tag:hover,
.deep-skill-tag:hover {
    background-color: #ccc;
}

.area a {
    text-decoration: none;
    color: #007bff;
}

.area a:hover {
    text-decoration: underline;
}

</style>

@if(Session::has('message'))
<div class="alert alert-success" style="text-align:center;font-weight: bolder;">{{ Session::get('message') }}</div>
@endif

<section class="text-center mt-3">
<h2>Dashboard</h2>
</section>

<section class="container  mt-3 ">
    <div class="top-box">
        <div class="row third-box mx-0">
            <section class="container-fluid signin-banner animatedParent hero-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="col-md-5 mx-auto">
                                <h2>Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


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
                            <p class="ml-2"><strong>{{ ucfirst($company->name) }}</strong></p>
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
                            <p class="m-0">{{ $currentSubscription[0]->plan->name }}</p>
                            <a href="{{ url('/membership-plans') }}" class="btn btn-primary ml-2" >Upgrade Now</a>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <img src="/img/tag.png" alt="Tag Icon" class="img-fluid" style="width: 20px; height: 20px;">
                            <a href="{{ $company->website }}" class="ml-2">{{ $company->website }}</a>
                        </div>
                        <p><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
                        <div class="d-flex align-items-center">
                            <img src="/img/user.png" alt="User Icon" class="img-fluid"
                                style="width: 20px; height: 20px;">
                            <p class="ml-2 m-0">Service Lines: {{ $serviceLineCount }}</p>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('profile', ['company' => $company->id]) }}" class="btn btn-secondary w-100 mr-1">View Profile</a>


                            <a href="{{ route('user.basicInfo', ['user' => auth()->user()->id]) }}" class="btn btn-secondary w-100 ml-1">Edit / Update Profile</a>
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
                            <a href="{{ url('/membership-plans') }}" >Upgrade your plan now</a>
                        </p>
                    </div>
                    <div class="container mt-5 p-0">
                        <div class="row mt-1 justify-content-between">
                            <div class="col-xl-6 mb-xl-0 mb-2">
                                <a href="{{ route('reviews.listView') }}" class="btn w-100 btn-primary">Manage Reviews</a>
                                <div class="reviewcount">You have {{ $reviewCount }} reviews</div>

                            </div>
                            <div class="col-xl-6 text-xl-right">
                                <a href="{{ route('company.reviews.request.index') }}" class="btn w-100">Request A Review</a>
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
                        <div class="d-flex logo-inner tagimg">
                            <a href="{{ route('portfolio.create') }}" class="btn">Add White Papers</a>
                            <p class="p-0">Only pdf allowed</p>
                        </div>
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
                        <div class="row mt-3 {{ $index >= 3 ? 'additional-industry' : '' }}" style="{{ $index >= 3 ? 'display:none;' : '' }}">
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
                                <a href="{{ route('company.industry', ['company_id' => $company->id]) }}">Edit Industries</a>
                            </div>
                        </div>
                    @endif
                    <h3 class="mt-5">Your Client Size</h3>
                    @foreach($clientSizes as $index => $clientSize)
                        <div class="row mt-3 {{ $index >= 3 ? 'additional-client-size' : '' }}" style="{{ $index >= 3 ? 'display:none;' : '' }}">
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
                                <a href="#" id="show-more-client-size-btn" onclick="toggleAdditionalClientSizes()">Show More</a>
                            </div>
                        </div>
                    @endif
                    
                    <div class="row d-flex mt-3">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('company.industry', ['company_id' => $company->id]) }}">Edit Client Size</a>
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
                    <div class="service-line mb-5 {{ $index > 1 ? 'd-none additional-service-line' : '' }}"> <!-- Increased margin-bottom for better separation -->
                        <div class="category-group mb-3">
                            <p class="field-name"><b>Primary Category</b></p>
                            <div class="cate-box mt-2 mt-lg-0">
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
                            {{-- <a href="{{ route('company.service-areas.edit', ['company_id' => $company->id]) }}">Edit Service Areas</a> --}}
                        </div>
                    </div>
                @endif
            </div>
            <img src="/img/placeholder.png" alt="" class="img-fluid p-2 ml-2">
            <div class="row mb-3 ml-2 area mb-5">
                <div class="col-4">
                    <a href="#">Packages</a>
                </div>
                <div class="col-8 text-right pl-5">
                    <a href="#">Visibility Opportunity</a>
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