@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')
@section('content')

@section('content')
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>
<style>

* {
  box-sizing: border-box;
}
.formbox{
    background-color: #f5f8fd;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}
.pricebox h1{
    font-size: 26px;
    font-weight: bold;
}
.pricebox h2{
    font-size: 22px;
    
}
.pricebox a{
    font-size: 21px;
    font-weight: bold;
    color:#ff3d2e;
}
.price {
    background-color: #388cff;
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  /* background-color: white; */
  color: #111;
  font-size: 25px;
  color: #000;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: left;
  color: #fff;
}

.price .grey {
  /* background-color: #fff; */
  font-size: 20px;
  color: #fff;
}

.button {
    background-color: #fff;
    border: 2px solid red;
    color: #08537e;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none !important;
    font-size: 18px;
    border-radius: 31px;
    border-color: #ff3d2e;
}

.button:hover{
    background-color: #ff3d2e;
    border: 2px solid red;
    color: #fff;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none !important;
    font-size: 18px;
    border-color: #ff3d2e;
    border-radius: 31px;
}
.offerbox{
position: relative;
}
.offer{
    position: absolute;
    top: -29px;
    right: -6px;
    width: 27%;
}
@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}

@media only screen and (max-width: 767px) {
.offer {
   
    width: 31%;
}
.offerbox {

    top: 62px;
}
}
</style>

<?php

use App\Models\Company;

$cd = '';

if( Auth::check() )
{
    $user = auth()->user()->id;
    $cd = Company::select('profile_type')->where( 'user_id', '=', $user )->first();
}

?>
<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">

                </div>
            </div>
        </div>
    </div>
</section>
<section class="formbox container mt-1">
    <div class="row">
        <div class="text-center mx-auto pb-0 pb-md-0 pt-5 pt-md-0 pl-5 pr-5 pricebox pl-md-0 pr-md-0">
        <h1 class="mt-md-5 mt-2">Show your credibility, leadership in your industry </br>and geographies you cater for FREE</h1>
<h2>
Reach the b2b customers that are looking for genuine providers like you and</br> get the tools you need to create a profile that stands out.


</h2>
<button class="button choose-plan" data-uid="{{ $user }}" data-url='{{ url( "user/$user/basicInfo?profile=basic" )}}' name="basic" value="basic" >  Get Started  </button>
<!-- <a href="">Get started today</a> -->


        </div>





        <div class="col-lg-12 mb-5">
            <div class="col-lg-12  form-size">
                <div class="region region-content">
					<div class="register-wrapper">
						<?php
                        $basic = ""; $premium = ""; $sponsorship = "";

                        $clr1 = ""; $clr2 = ""; $clr3 = "";

                        if( !empty( $cd ) && $cd->profile_type == 'basic' )
                        {
                            $basic = "background-color:#ff3d2e;";
                            $clr1 = "color:#fff;";
                        }
                        elseif( !empty( $cd ) && $cd->profile_type == 'premium' )
                        {
                            $premium = "background-color:red;";
                            $clr2 = "color:#fff;";
                        }
                        elseif( !empty( $cd ) && $cd->profile_type == 'sponsorship' )
                        {
                            $sponsorship = "background-color:red;";
                            $clr3 = "color:#fff;";
                        }
                        ?>
						<div class="columns">
							<ul class="price">
								<!-- <li class="header">Basic Profile.</li>
								<li class="grey"> Free Profile</li> -->
								<!--<li class="grey"><a href="{{url('get-listed?price_temp=basic')}}" class="button">Select</a></li>-->
                                <!-- <li class="grey" > -->
                                    <!-- <a href='{{url("user/$user/basicInfo?profile=basic")}}' class="button" style="<?php echo $basic; echo $clr1; ?>"> Get Started </a> -->

                                    <!-- <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{ url( "user/$user/basicInfo?profile=basic" )}}' name="basic" value="basic" style="<?php echo $basic; echo $clr1; ?>">  Get Started  </button>

                                </li> -->
								<!-- <li>Collection of unlimited online reviews</li>
								<li></li>
								<li>Use badges and widgets to display achievements </li>
								<li>Market insight to guide decision-making</li> -->


                                <li class="header"><b>Basic - Free</b></li>
								<li class="grey"><b>Premium Local</b> </br> Change Premium pricing to be $299 p.m or $99pm billed annually</li>

<li  class="grey"><b>Featured Regional</b> </br> Starts at $499 p.m. (minimum 3 months commitment)</li>
<li  class="grey">Below the plans write <b style="color:#ff3d2e;">“Compare our plans”</b> hyperlink it below with a plan comparison like this
</li>
<li class="grey"><b>Compare our plans</b></br>
They Trust Us has plans for any size of business. Check out our full list of features to see which is right for you.

</li>















                                <li></li>
							</ul>
						</div>

						<div class="columns offerbox mb-5 mb-md-0">
                            <img src="https://theytrust-us.developmentserver.info/front_components/images/most.png" alt="" class="img-fluid offer">
							<ul class="price ">

                                <li class="header">  <b> Premium </b></li>

                                <li class="grey">$200/month Or $100/month billed annually</li>

								<!--<li class="grey"><a href="{{url('get-listed?price_temp=premium')}}" class="button">Buy</a></li>-->

                                <li class="grey">
                                    <!-- <a href='{{url("user/$user/basicInfo?profile=premium")}}' class="button" style="<?php echo $premium; echo $clr2; ?>">Get Started</a> -->
                                    <!-- <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{url("user/$user/basicInfo?profile=premium")}}' name="premium" value="premium" style="<?php echo $premium; echo $clr2; ?>" disabled>  Coming Soon  </button> -->
                                    <a href="{{ route('plans.compare') }}" class="btn btn-primary">Coming Soon </a>
                                </li>

                                <li><strong>Includes benefits of Basic Profile, and more</strong></li>
								<li>Collect unlimited reviews by phone and online</li>
								<li>Priority publishing of reviews</li>

							<li>Priority support for Profile, and Verification eligibility
</li> 
<li>Priority support for Profile
</li> 
<li></li>
							</ul>
						</div>

						<div class="columns mt-5-0 pt-md-0 mt-md-0 pt-md-0 mt-5 pt-4">
							<ul class="price">
								<li class="header"> <b>Reviews  </b></li>
                                <!-- <li class="header"> <b>Reviews  </b>Feature Sponsorship</li> -->
								<li class="grey">Starts from $300/month</li>

                                <!--<li class="grey"><a href="{{url('get-listed?price_temp=sponsorship')}}" class="button">Learn More</a></li>-->

                                <li class="grey">

                                    <!-- <a href='{{url("user/$user/basicInfo?profile=sponsorship")}}' class="button" style="<?php echo $sponsorship; echo $clr3; ?>">Get Started </a> -->
                                    <!-- <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{url("user/$user/basicInfo?profile=sponsorship")}}' name="sponsorship" value="sponsorship" style="<?php echo $sponsorship; echo $clr3; ?>" disabled>  Coming Soon  </button> -->
                                    <a href="{{ route('plans.compare') }}" class="btn btn-primary">Coming Soon </a>
                                </li>

								<li><strong>Includes benefits of Premium Profile, and more</strong></li>
								<li>Listing shown above Free and Premium </li>
								<li>Enhanced level of visibility on all pages </li>
                               <li>Enhanced level of visibility on all pages with Profile Verification</li> 
								<li>Customer Success Analyst with additional analytics tracking</li> 
                                <li></li>
                                <li></li>
                            </ul>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')
<script type="text/javascript">
    $('.choose-plan').click(function (){

        var plan    = $(this).val();
        var url     = $(this).data('url');
        var user_id = $(this).data('uid');

         $.ajax({
                    url:"{{url('/user/choose-plan')}}",
                    type: "POST",
                    data: { plan: plan, user_id: user_id,  _token: "{{ csrf_token() }}" },
                    success: function(result)
                    {
                        if( result.status == 'success' )
                        {
                            window.location.href = url;
                        }
                    }
            });
    });
</script>
@endsection
