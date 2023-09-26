<?php
use App\Models\Company;
$cd = '';
if(Auth::check()){
    $uid = auth()->user()->id;
    $cd = Company::select('*')->where('user_id', '=', $uid)->first();
    //dd($cd);
}
?>
<section class="container-fluid profile pt-5  animatedParent">
    <div class=" text-center container">
        <h3 class="animated fadeInLeft slower">Unleash Your Potential, Connect with a Global Audience

</h3>
        <p class="text-white my-4 animated fadeInLeft slower">Redefine Your Reach: Forge Meaningful Connections with more than 5,000,000 potential clients and Make Your Profile Shine with TheyTrustUs.

</p>
        <?php 
        if($cd){
            ?>
            <a href="{{ route('company.dashboard',$cd->id) }}" class="btn btn-primary animated fadeInRight slower">Get Listed <span style="margin-left: 3px; font-weight: 900;">></span></a>
            <?php
        }else{
            ?>
            <a href="{{url('get-listed')}}" class="btn btn-primary animated fadeInRight slower">Get Listed <span style="margin-left: 3px; font-weight: 900;">></span></a>
            <?php
        }
        ?>
        
        <h6 class="animated fadeInRight slower">Learn More <span style="margin-left: 3px;font-weight: 900; color:#fff;">></span></h6>
    </div>
</section>
<!-- contact section -->


<section class="container-fluid contact ">
    


    <div class="container ">

         
            @if($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
            @endif
        

        <!-- <div class="alert alert-success">
        </div> -->

        @if(session()->has('newsuccess'))
            <div class="alert alert-success">
                {{ session()->get('newsuccess') }}
            </div>
        @endif

        <form method="post" action="{{ route('subscribe') }}">
            
            @csrf

            <div class="form-group my-3">

                <input type="email" class="form-control email emailbrd" name="email" placeholder="Email Address">
                
                <button type="submit" class="btn btn-lg btn-primary" name="submit_news" value="submit-newsletter">Subscribe</button>

                <p class="recieve">To Recieve Our Updates Via E-mail</p>
            </div>

        </form>

        <!-- <h2> Email Address</h2> -->
        <div class="row pt-5">
            <div class="col-lg-4 about-box mb-md-0 mb-5">
                <h3>About us</h3>
                <p>At TheyTrustUs, we aim to simplify your search for trusted companies and their exceptional services with reliable B2B reviews. Our platform provides a comprehensive directory of top-notch businesses across various industries. We strive to empower you with reliable information and reviews, enabling you to make informed decisions. Join millions of satisfied users who rely on us for accurate insights. Trust us to connect you with the best in the business.</p>
                <!-- <p>On my way to where the air is sweet. Can you tell me how to get how to get to Sesame Street! The
                    first mate and his Skipper too will do their very best to make the others comfortable </p> -->
                <span class="social"><i class="fa fa-facebook"></i><i class="fa fa-twitter-square"></i><i
                        class="fa fa-instagram"></i></span>
            </div>
            <div class="col-lg-4 about-box mb-md-0 mb-5">
                <h3>latest posts</h3>
                <div class="row latestposts latestpostsbrd mx-0">
                    <div> 
                        <!-- <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"> -->
                </div>
                    <div class="imgright"> <span>On your mark get set and go now </br><a href="#">April 12,
                                2023</a></span>
                    </div>
                </div>
                <div class="row latestposts latestpostsbrd mx-0">
                    <div>
                         <!-- <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"> -->
                </div>
                    <div class="imgright"> <span>The ship set ground on the shore of this </br><a
                                href="#">MAy 3,
                                2023</a></span>
                    </div>
                </div>
                <div class="row latestposts latestpostsbrd mx-0 brdnone">
                    <div> 
                        <!-- <img src="{{asset('front_components/images/latestnews.jpg')}}" alt="" class="img-fluid"> -->
                </div>
                    <div class="imgright"> <span>This time there's no stopping us from away </br><a
                                href="#">May 29,
                                2023</a></span>
                    </div>
                </div>
                <!-- <p>  <span class="rounded-sm"></span>On your mark get set and go now</p>
                      <span>April 12, 2015</span> -->
            </div>
            <!-- <div class="col-lg-3 about-box mb-md-0 mb-5">
                <h3 class="mb-4">Latest tweets</h3>
                <ul class="tweetsicon">
                    <li> Educamus is one of the excellent university template
                        http://educampus/universitybestpsd/
                        1 hours ago</li>
                    <li> Educamus is one of the excellent university template
                        http://educampus/universitybestpsd/
                        1 hours ago</li>
                </ul>
            </div> -->
            <div class="col-lg-4 about-box">
                <h3>contact info</h3>
                <p class="d-flex align-items-start"> <img src="{{asset('front_components/images/map.png')}}" alt="" class="img-fluid mr-3">
                    <span>4111-e Rose Lake Rd #2492, Charlotte, </br>North Carolina 28217</span></p>
                <p class="d-flex align-items-start"> <img src="{{asset('front_components/images/call.png')}}" alt="" class="img-fluid mr-3">
                    <span><a href="tel:+44 20 8133 8117">+44 20 8133 8117</a>
                    </span></p>
                <!-- <p class="d-flex align-items-start"> <img src="{{asset('front_components/images/call.png')}}" alt="" class="img-fluid mr-3">
                    <span><a href="tel:+61 2 800 600 12">+61 2 800 600 12</a></span></p>-->
                <p class="d-flex align-items-start"> <img src="{{asset('front_components/images/envalop.png')}}" alt="" class="img-fluid mr-3">
                    <span><a href="mailto:info@theytrust.us">info@theytrust.us</a></span></p>
            </div>
        </div>
    </div>
</section>
<!-- contact section -->
<section class="container-fluid footer ">
    <div class="container text-md-right text-center">
        <ul class="mb-0 p-0">
            <a href="{{url('/')}}"><li>Home</li></a>
            <a href="{{url('/about')}}"><li>About</li></a>
            <a href="{{url('/sponsorship')}}"><li>Sponsorship</li></a>
            <a href="{{url('/contact')}}"><li>Contact</li></a>
            <a href="{{url('/privacy')}}"><li>Privacy Policy</li></a>
            <a href="{{url('/terms')}}"><li>Terms & Conditions</li></a>
            <a href="{{url('/faq')}}" class="brdnone"><li class="brdnone">Faq</li></a>
        </ul>
    </div>
</section>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title text-center">Sign In </br><span class="text-center"> to continue with Theytrustus</span></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body  ">
                <div class="singinbox d-flex row">
                    <div class="signin col-md-2 col-2"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                    <div class="signintxt col-md-10 col-10 text-center">
                        <a href="{{ url('auth/linkedin') }}" class="btnlink" data-dismiss="" > Sign in with LinkedIn</a>
                    </div>
                </div>
            </div> 
            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary closebtn" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>