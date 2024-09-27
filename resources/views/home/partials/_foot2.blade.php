<?php
use App\Models\Company;
$cd = '';
if (Auth::check()) {
    $uid = auth()->user()->id;
    $cd = Company::select('*')
        ->where('user_id', '=', $uid)
        ->first();
}
?>
<!-- footer start -->
<!-- footer start -->
<section class="container-fluid email-sec ">
    <div class="container ">
        <div class="row pt-5">
            <div class="col-md-12 m-0 p-0 ">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                @endif


                @if (session()->has('newsuccess'))
                    <div class="alert alert-success">
                        {{ session()->get('newsuccess') }}
                    </div>
                @endif
                </br>
                <span>To Recieve Our Updates Via E-mail</span>

                <span class="social mobilesec">
                    <img src="{{ asset('front_components/images/s1.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s2.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s3.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s4.png') }}" alt="" class="img-fluid">


                </span>
                <h3>ABOUT US</h3>
                <p>At TheyTrustUs, our goal is to streamline your quest for reputable enterprises and their outstanding offerings through dependable B2B evaluations. Our portal presents an extensive listing of premier businesses spanning diverse sectors. We are committed to equipping you with trustworthy insights and appraisals, empowering you to make At TheyTrustUs, our goal is to streamline your quest for reputable enterprises and their outstanding offerings through dependable B2B evaluations. Our portal presents an extensive listing of premier businesses spanning diverse sectors. We are committed to equipping you with trustworthy insights and appraisals, empowering you to make well-informed choices. Become part of the multitude of content customers who count on us for precise perspectives. Depend on us to link you with the crème de la crème in the industry.
                </p>
            </div>

        </div>
    </div>
</section>

<section class="container-fluid contact ">
    <div class="container ">


        <!-- <div class="row pt-5">
            <div class="col-lg-6 about-box mb-md-0 mb-5">
                <div class="col-lg-10 mx-auto pl-0">
                    <h3>latest posts</h3>
                    <div class="row latestposts latestpostsbrd mx-0">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt=""
                                class="img-fluid"></div>
                        <div class="imgright"> <span>On your mark get set and go now </br><a href="#">April 12,
                                    2023</a></span>
                        </div>
                    </div>
                    <div class="row latestposts latestpostsbrd mx-0">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt=""
                                class="img-fluid"></div>
                        <div class="imgright"> <span>The ship set ground on the shore of this </br><a href="#">May
                                    12,
                                    2023</a></span>
                        </div>
                    </div>
                    <div class="row latestposts latestpostsbrd mx-0 brdnone">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt=""
                                class="img-fluid"></div>
                        <div class="imgright"> <span>This time there's no stopping us from away </br><a
                                    href="#">May
                                    29,
                                    2015</a></span>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-6 about-box  mb-md-0 mb-5">
                <div class="col-lg-12 ml-3 socialbox p-0">
                    <h3>CONTACT INFO</h3>
                    <!-- <p>4111-e Rose Lake Rd #2492, Charlotte,</br>
                        North Carolina 28217</p> -->
                    <!-- <a href="tel:+442081338117" class="mb-2">+44 20 8133 8117</a> -->
                    <a href="mailto:info@theytrust.us">info@theytrust.us</a>
                    <!-- <span class="social desktop-sec">
                        <img src="{{ asset('front_components/images/s1.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s2.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s3.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s4.png') }}" alt="" class="img-fluid">
                    </span> -->
                </div>
            </div>


        </div>
    </div>
</section>
<section class="container-fluid footer ">
    <div class="container  text-center">
    </div>
</section>

