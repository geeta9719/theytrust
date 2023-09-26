<?php
use App\Models\Company;
$cd = '';
if(Auth::check())
{
    $uid = auth()->user()->id;
    $cd = Company::select('*')->where('user_id', '=', $uid)->first();
}
?>
<!-- footer start -->
<!-- footer start -->
<section class="container-fluid email-sec ">
        <div class="container ">
            <div class="row pt-5">
                <div class="col-md-12 m-0 p-0 ">


                @if($errors->any())
                    <div class="alert alert-danger">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                @endif
                

                @if(session()->has('newsuccess'))
                    <div class="alert alert-success">
                        {{ session()->get('newsuccess') }}
                    </div>
                @endif

                    <form method="post" class="d-flex" action="{{ route('subscribe') }}">
                        @csrf
                        <input type="email" class="form-control email emailbrd" id="email" name="email" placeholder="Email Address">
                        <button type="submit" class="submit" name="submit_news" value="submit-newsletter">Subscribe</button>
                     
                    </form></br>
                    <span  >To Recieve Our Updates Via E-mail</span>
                    <!-- <form action="/action_page.php" class="emailbox">
                        <input type="email" id="email" name="email" placeholder="Enter Address">
                        <input type="submit" class="submit">
                    </form> -->
                    
                    <span class="social mobilesec">
                        <img src="{{asset('front_components/images/s1.png')}}" alt="" class="img-fluid">
                        <img src="{{asset('front_components/images/s2.png')}}" alt="" class="img-fluid">
                        <img src="{{asset('front_components/images/s3.png')}}" alt="" class="img-fluid">
                        <img src="{{asset('front_components/images/s4.png')}}" alt="" class="img-fluid">

                     


                    </span>
                    <h3>ABOUT US</h3>
                    <p>At <a href="">TheyTrustUs</a>, we aim to simplify your search for trusted companies and their
                        exceptional services with reliable B2B reviews. Our platform provides a comprehensive directory
                        of top-notch businesses across various industries. We strive to empower you with reliable
                        information and reviews, enabling you to make informed decisions. Join millions of satisfied
                        users who rely on us for accurate insights. Trust us to connect you with the best in the
                        business.
                    </p>
                </div>

            </div>
        </div>
    </section>

<section class="container-fluid contact ">
        <div class="container ">
          

            <div class="row pt-5">
                <div class="col-lg-6 about-box mb-md-0 mb-5">
                    <div class="col-lg-10 mx-auto pl-0">
                        <h3>latest posts</h3>
                        <div class="row latestposts latestpostsbrd mx-0">
                            <div> <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"></div>
                            <div class="imgright"> <span>On your mark get set and go now </br><a href="#">April 12,
                                        2023</a></span>
                            </div>
                        </div>
                        <div class="row latestposts latestpostsbrd mx-0">
                            <div> <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"></div>
                            <div class="imgright"> <span>The ship set ground on the shore of this </br><a href="#">May
                                        12,
                                        2023</a></span>
                            </div>
                        </div>
                        <div class="row latestposts latestpostsbrd mx-0 brdnone">
                            <div> <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"></div>
                            <div class="imgright"> <span>This time there's no stopping us from away </br><a href="#">May
                                        29,
                                        2015</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 about-box  mb-md-0 mb-5">
                    <div class="col-lg-9 mx-auto socialbox p-0">
                        <h3>CONTACT INFO</h3>
                        <p>4111-e Rose Lake Rd #2492, Charlotte,</br>
                            North Carolina 28217</p>
                        <a href="tel:+442081338117" class="mb-2">+44 20 8133 8117</a>
                        <a href="mailto:info@theytrust.us">info@theytrust.us</a>
                        <span class="social desktop-sec">
                            <img src="{{asset('front_components/images/s1.png')}}" alt="" class="img-fluid">
                            <img src="{{asset('front_components/images/s2.png')}}" alt="" class="img-fluid">
                            <img src="{{asset('front_components/images/s3.png')}}" alt="" class="img-fluid">
                            <img src="{{asset('front_components/images/s4.png')}}" alt="" class="img-fluid">
                        </span>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="container-fluid footer ">
        <div class="container  text-center">
            <ul>
                <li><a href="https://theytrust-us.developmentserver.info/"> Home</a></li>
                <li><a href="{{url('about')}}"> About</a></li>
                <li><a href="{{url('/sponsorship')}}">Sponsorship</a> </li>
                <li><a href="{{url('contact')}}">Contact</a></li>
                <li><a href="{{url('privacy')}}"> Privacy Policy</a> </li>
            </ul>
            <ul class="mt-0 mt-md-4 terms">
                <li><a href="{{url('terms')}}">Terms & Conditions</a></li>
                <li class="brdnone"><a href="{{url('faq')}}">FAQ</a></li>
            </ul>
        </div>
    </section>

    <!-- Sign in Modal -->
    <div class="modal fade" id="singin-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title text-center">Sign In </br><span class="text-center"> to continue with Theytrustus</span></h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body  ">
                    <div class="singinbox d-flex row">
                        <div class="signin col-md-2 col-2"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                        <div class="signintxt col-md-10 col-10 text-center">
                            <a href="{{ url('auth/linkedin') }}" class="btnlink" data-dismiss="" >Sign in with LinkedIn</a>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
        </div>
    </div>

   
   


    

    <!-- footer end -->