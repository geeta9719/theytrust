@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
    $userid=  auth()->user()->id;
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
                <div class="col-lg-6 col-12">
                    <h2 class="sec-heading mb-3 mb-lg-0">Upgrade your plan</h2>
                </div>
                <div class="col-lg-6 col-12 text-center  ">
                    <div class="btn-box">
                        <div class="d-sm-flex justify-content-center">
                            <!-- <button class="monthly btn">Monthly</button>
                            <button class="annual btn">Annual Commitment</button>
                            <button class="yearly btn">Yearly</button> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  monthly btn active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Monthly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link annual btn" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                       <span class="before-txt">
                                      <img src="https://theytrust-us.developmentserver.info/front_components/images/saving.png" alt="">
                                        Save 50% 
                                       </span>
                                    
                                    Annual Commitment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link yearly btn" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                                    <span class="before-txt">
                                      <img src="https://theytrust-us.developmentserver.info/front_components/images/fire.png" alt="">
                                        50% + 20%
                                       </span>yearly

                                    </a>
                                   
                                    
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

                <h2>$199 
                    <!-- <span>$199</span> -->
                 </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <!-- <span>* billed monthly
                        with annual commitment</span> -->
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn choose-plan" 
                                data-plan-id="2" 
                                data-url="/dashboard" 
                                data-uid="{{ $userid }}">
                                Get Premium Localssss
                 </button>
                </div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Manage and respond to reviews</li>
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
                <h3>Premium Regional</h3>
                <span>Everything in Premium Local plus ...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$598 
                    <!-- <span>$199</span> -->
                 </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <!-- <span>* billed monthly
                        with annual commitment</span> -->
                </div>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn choose-plan" 
                data-plan-id="3" 
                data-url="/dashboard" 
                data-uid="{{ $userid }}">Get Premium Regional</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Get listed above "Premium local" profiles
                    in your city and state</li>
                    <li>Ability to bid on leads. Access to leads 
                    panel includes 199 credits</li>
                    <li>Create Bundles</li>
                    <li>24 x 7 general email support plus a 
                    dedicated account representative</li>
                            </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Large Business</h3>
                <span>Everything in Premium Regional plus</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2 style="transform: translateX(00px);">Contact Us</h2>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Large Business</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Get listed above "Premium regional"
                    profiles in your city and state</li>
                    <li>Ability to bid on leads. Unlimited credits**</li>
                    <li>24 x 7 dedicated phone support</li>
                   
                </ul>
                <div class="mt-md-5 humming">
                                <p>** Fair use policy appplies</p>
                            </div>
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

                            <h2>$99 <span>$199</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">
                            <button class="text-center purple-btn btn choose-plan" 
                            data-plan-id="5" 
                            data-url="/dashboard" 
                            data-uid="{{ $userid }}">
                            Get Premium Local
             </button>


            </div>
                            {{-- <button class="text-center purple-btn btn">Get Premium Local</button></div> --}}
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
                            <h3>Premium Regional</h3>
                            <span>Everything in Premium Local plus ...</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <h2>$299 <span>$598</span> </h2>

                            <div class="small-text text-left">
                                <h3>per Month </h3>
                                <span>* billed monthly
                                    with annual commitment</span>
                            </div>

                        </div>
                        <div class="text-center mt-3">

                            <button class="text-center purple-btn btn choose-plan" 
                            data-plan-id="6" 
                            data-url="/dashboard" 
                            data-uid="{{ $userid }}">
                            Get Premium Regional
             </button>

                        </div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Get listed above "Premium local" profiles
                                in your city and state</li>
                                <li>Ability to bid on leads. Access to leads 
                                panel includes 199 credits</li>
                                <li>Collaborate through focussed groups</li>
                                <li>Create referral network</li>
                                <li>Create Unlimited Bundles</li>
                                <li>24 x 7 general email support plus a 
                                dedicated account representative</li>
                                <li class="purpletxt">1 FREE sponsored listing for 3 months. 
                                Limited Time Offer**</li>
                                
                            </ul>
                            <div class="mt-md-5 humming">
                                <p>** The Hummingbird</p>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
                    <div class="agenciesbox">
                        <!-- <img src="images/icons.png" alt=""> -->
                        <div class="heading-box">
                            <h3>Large Business</h3>
                            <span>Everything in Premium Regional plus</span>
                        </div>

                        <div class="dollertxt container mt-5 text-center position-relative">

                            <!-- <h2 style="transform: translateX(00px);">Contact Us</h2> -->

                        </div>
                        <div class="text-center  pt-md-4 large">
                            <button class="text-center purple-btn btn mt-md-5">Get Large Business</button></div>
                        <div class="features"></div>
                        <div class="features px-2 mt-3">
                            <h4>Features</h4>
                            <ul>
                                <li>Get listed above "Premium regional"
                                profiles in your city and state</li>
                                <li>Ability to bid on leads. Unlimited credits**</li>
                                <li>24 x 7 dedicated phone support</li>
                           
                            </ul>
                            <div class="mt-md-5 humming">
                                <p>** Fair use policy appplies</p>
                            </div>
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

                <h2>$950 
                    <!-- <span>$199</span> -->
                 </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <!-- <span>* billed monthly
                        with annual commitment</span> -->
                </div>

            </div>
            <div class="text-center mt-3">

                <button class="text-center purple-btn btn choose-plan" 
                data-plan-id="8" 
                data-url="/dashboard" 
                data-uid="{{ $userid }}">
                Get Premium 9
 </button>


                {{-- <button class="text-center purple-btn btn">Get Premium Local</button> --}}
            </div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Collect unlimited reviews</li>
                    <li>Add unlimited Portfolio items</li>
                    <li>Manage and respond to reviews</li>
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
                <h3>Premium Regional</h3>
                <span>Everything in Premium Local plus ...</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2>$2870 
                    <!-- <span>$199</span> -->
                 </h2>

                <div class="small-text text-left">
                    <h3>per Month </h3>
                    <!-- <span>* billed monthly
                        with annual commitment</span> -->
                </div>

            </div>
            <div class="text-center mt-3">
                {{-- <button class="text-center purple-btn btn">Get Premium Regional</button></div> --}}


                <button class="text-center purple-btn btn choose-plan" 
                data-plan-id="9" 
                data-url="/dashboard" 
                data-uid="{{ $userid }}">
                Get Premium Regional
 </button>
</div>

            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Get listed above "Premium local" profiles
                    in your city and state</li>
                    <li>Ability to bid on leads. Access to leads 
                    panel includes 199 credits</li>
                    <li>Create Bundles</li>
                    <li>24 x 7 general email support plus a 
                    dedicated account representative</li>
                            </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 px-3  mb-5 mb-lg-0 ">
        <div class="agenciesbox">
            <!-- <img src="images/icons.png" alt=""> -->
            <div class="heading-box">
                <h3>Large Business</h3>
                <span>Everything in Premium Regional plus</span>
            </div>

            <div class="dollertxt container mt-5 text-center position-relative">

                <h2 style="transform: translateX(00px);">Contact Us</h2>

            </div>
            <div class="text-center mt-3">
                <button class="text-center purple-btn btn">Get Large Business</button></div>
            <div class="features"></div>
            <div class="features px-2 mt-3">
                <h4>Features</h4>
                <ul>
                    <li>Get listed above "Premium regional"
                    profiles in your city and state</li>
                    <li>Ability to bid on leads. Unlimited credits**</li>
                    <li>24 x 7 dedicated phone support</li>
                   
                </ul>
                <div class="mt-md-5 humming">
                                <p>** Fair use policy appplies</p>
                            </div>
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
    <section class="container-fluid  sponsor  animatedParent mb-5">
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
{{-- @endsection --}}
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    const stripe = Stripe('pk_test_51OMTmgSBpRscNHwB4qiyJOy6swL8uwFI7DFbTzrmLZYaPXnKs1qVKLOdwwZz2R1UqL9SgOxc5BZaxFN9Nr9flN6U00duoOXtey');

    $(document).ready(function () {
        // Bind the click event to the buttons with the class 'choose-plan'
        $('.choose-plan').on('click', function () {
            debugger
            // Get plan ID, URL, and user ID from data attributes
            var planId = $(this).data('plan-id'); // Correctly fetch plan ID
            var url = $(this).data('url');
            var userId = $(this).data('uid');
            console.log(planId,url,userId);

            // Check if planId, url, and userId are valid
            if (!planId || !url || !userId) {
                alert('Missing required data for plan selection.');
                return;
            }

            // AJAX request to submit plan selection
            $.ajax({
                url: '{{ url('create-checkout-session') }}', // API endpoint
                type: 'POST', // HTTP method
                data: {
                    plan_id: planId, 
                    user_id: userId,
                    _token: '{{ csrf_token() }}',
                },
                success: function (result) {
            if (result.status === 'success') {
                if (result.is_free) {
                    window.location.href = result.redirect_url;
                } else {
                    stripe.redirectToCheckout({ sessionId: result.sessionId });
                }
            } else {
                alert('Plan selection failed. Please try again.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        },
            });
        });
    });
</script>

@endsection



