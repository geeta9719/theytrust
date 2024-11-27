@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')
@section('content')

@section('content')
    <script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
    <link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet" />
    <link href="https://theytrust-us.developmentserver.info/front_components/css/subscription-style.css" rel="stylesheet" />
    <link href="https://theytrust-us.developmentserver.info/front_components/css/subscription.css" rel="stylesheet" />
    
    <section class="container-fluid agencies   " style="background: #fff;  ">
        <div class="container  ">
            <div class="row upgrade">
                <div class="col-lg-6 ">
                    <h2 class="sec-heading mb-3 mb-lg-0">Upgrade your plan</h2>
                </div>
                <div class="col-lg-6 text-center  ">
                    <div class="btn-box">
                        <div class="d-sm-flex justify-content-center">
                            <!-- <button class="monthly btn">Monthly</button>
                            <button class="annual btn">Annual Commitment</button>
                            <button class="yearly btn">Yearly</button> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link  annual btn" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link annual btn" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Annual Commitment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link annual btn" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Yearly</a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="mt-1">Billed monthly with annual commitment</h2>
                    </div>

                </div>
                <div class="col-lg-12 currently mt-4">

                    <p>You are currently subscribed to the basic plan which is a FREE FOREVER plan and includes the
                        following</p>
                    <div class="row">

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before points">Collect upto 3 reviews</h2>
                            <h2 class="image-before points"> Post projects</h2>
                        </div>

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before points">Add upto 3 portfolio items</h2>
                            <h2 class="image-before points">Manage and respond to reviews</h2>
                        </div>

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before">Create upto 3 Bundles</h2>
                            <h2 class="image-before">Unlimited business locations</h2>
                        </div>

                    </div>

                </div>
            </div>


 <!-- Tabs Navigation start-->
 <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
</ul> -->

 <!-- Tabs Navigation end-->
       <!-- Tab Content -->
       <div class="tab-content" id="myTabContent">
<!-- Monthly start -->
<div class="row pt-5 mt-4 equal tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-lg-4 col-md-6 px-3 mb-5 mb-lg-0 ">
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2>$99 <span>$199</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 px-3   mb-5 mb-lg-0 regional">
                    <div href="#" class="recommended-btn">Recommended</div>
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2>$99 <span>$199</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2 style="transform: translateX(00px);">Contact Us</h2>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>
</div>
<!-- Monthly end -->
 <!-- Annual start -->
 <div class="row pt-5 mt-4 equal tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-4 col-md-6 px-3 mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$199 <span>$199</span> </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <span>* billed monthly
                        with annual commitment</span>
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 px-3   mb-5 mb-lg-0 regional">
        <div href="#" class="recommended-btn">Recommended</div>
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$99 <span>$199</span> </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <span>* billed monthly
                        with annual commitment</span>
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2 style="transform: translateX(00px);">Contact Us</h2>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Annual end -->
 <!-- Yearly start -->
 <div class="row pt-5 mt-4 equal tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-4 col-md-6 px-3 mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$299 <span>$199</span> </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <span>* billed monthly
                        with annual commitment</span>
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 px-3   mb-5 mb-lg-0 regional">
        <div href="#" class="recommended-btn">Recommended</div>
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$99 <span>$199</span> </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <span>* billed monthly
                        with annual commitment</span>
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Premium Local</h3>
                <span>Everything in Basic plus...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2 style="transform: translateX(00px);">Contact Us</h2>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Premium Local</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Create upto 10 bundles</li>
                    <li>Receive direct leads and website visits</li>
                    <li>Get listed above "Basic / Free" profiles in
                        your city</li>
                    <li>Ability to bid on leads. Access to leads
                        panel includes 99 credits</li>
                    <li>Reach analytics and statistics</li>
                    <li>24 x 7 general email support</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Yearly end -->
       <!-- Tab Content -->
</div>
</div>
     
    </section>

    <!-- 2nd row -->
    <section class="container-fluid  sponsor  animatedParent">
        <div class="container ">
            <div class="row upgrade">
                <div class="col-md-8 ">
                    <h2 class="sec-heading">Become A Sponsor</h2>
                </div>
                <div class="col-md-4 text-center ">
                    <a class=" sales btn">Contact Sales</a>

                </div>
                <div class="col-md-12 currently">

                    <p>You can get higher visibility by taking a sponsorship. Sponsored listings are ranked higher than
                        regular listings. Sponsorship can be purchased for any combination of keyword and location.
                        Choose from below options:</p>

                </div>


                <div class="w-100">
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </section>
        <div class="container  ">
            <div class="row upgrade">
                <div class="col-lg-6 ">
                    <h2 class="sec-heading mb-3 mb-lg-0">Upgrade your plan</h2>
                </div>
                <div class="col-lg-6 text-center  ">
                    <div class="btn-box">
                        <div class="d-sm-flex justify-content-between">
                            <button class="monthly btn">Monthly</button>
                            <button class="annual btn">Annual Commitment</button>
                            <button class="yearly btn">Yearly</button>
                        </div>
                        <h2 class="mt-1">Billed monthly with annual commitment</h2>
                    </div>

                </div>
                <div class="col-lg-12 currently mt-4">

                    <p>You are currently subscribed to the basic plan which is a FREE FOREVER plan and includes the
                        following</p>
                    <div class="row">

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before points">Collect upto 3 reviews</h2>
                            <h2 class="image-before points"> Post projects</h2>
                        </div>

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before points">Add upto 3 portfolio items</h2>
                            <h2 class="image-before points">Manage and respond to reviews</h2>
                        </div>

                        <div class="col-lg-4 p-reviews">
                            <h2 class="image-before">Create upto 3 Bundles</h2>
                            <h2 class="image-before">Unlimited business locations</h2>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row pt-5 mt-4 equal">
                <div class="col-lg-4 col-md-6 px-3 mb-5 mb-lg-0 ">
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2>$99 <span>$199</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 px-3   mb-5 mb-lg-0 regional">
                    <div href="#" class="recommended-btn">Recommended</div>
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2>$99 <span>$199</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Premium Local</h3>
                            <span>Everything in Basic plus...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2 style="transform: translateX(00px);">Contact Us</h2>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn">Get Premium Local</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Collect unlimited reviews</li>
                                <li>Add unlimited Portfolio items</li>
                                <li>Create upto 10 bundles</li>
                                <li>Receive direct leads and website visits</li>
                                <li>Get listed above "Basic / Free" profiles in
                                    your city</li>
                                <li>Ability to bid on leads. Access to leads
                                    panel includes 99 credits</li>
                                <li>Reach analytics and statistics</li>
                                <li>24 x 7 general email support</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container trust-row animatedParent">
            <div class="row">
                <div class="col-lg-6 pr-md-5 animated fadeInLeft slower">
                    <img src="images/imgleft.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6   text-left pt-lg-5 mt-5 animated fadeInRight slower">
                    <h3 class="mb-4">They Trust.us Story So Far...</h3>
                    <p class="mb-lg-5">Hear the idea that got us started, the experiences that shape our path, and the
                        values that
                        influence our approach.</p>
                    <button class="btn btn-primary">They Trust.us <span style="margin-left: 3px; font-weight: 900;">></span></button>
                </div>
            </div>
        </div> -->
    </section>

    <!-- 2nd row -->
    <section class="container-fluid  sponsor mb-5  animatedParent">
        <div class="container ">
            <div class="row upgrade">
                <div class="col-md-8 ">
                    <h2 class="sec-heading">Become A Sponsor</h2>
                </div>
                <div class="col-md-4 text-center ">
                    <a class=" sales btn">Contact Sales</a>

                </div>
                <div class="col-md-12 currently">

                    <p>You can get higher visibility by taking a sponsorship. Sponsored listings are ranked higher than
                        regular listings. Sponsorship can be purchased for any combination of keyword and location.
                        Choose from below options:</p>

                </div>


                <div class="w-100">
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 price-row">

                        <div class="row mx-0 py-3">
                            <div class="col-md-2 col-lg-1">
                                <img src="images/bird.png" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>The Hummingbird</h3>
                                    </div>
                                    <div class="col-lg-6 text-lg-right pr-lg-5">
                                        <h4><span>Starts at</span> $250 per Month</h4>
                                    </div>
                                </div>
                                <p>Tiny but with a big impact, perfect for small businesses just starting out. They're
                                    known
                                    for their energy and ability to hover - great for small companies focusing on
                                    specific
                                    niches.</p>
                            </div>
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </section>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
@endsection



