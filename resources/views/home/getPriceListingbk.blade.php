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

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
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
  background-color: white;
  color: #111;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #fff;
  font-size: 20px;
}

.button {
    background-color: #fff;
    border: 2px solid red;
    color: #08537e;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none !important;
    font-size: 18px;
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
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
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
        <div class="col-lg-12">
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
								<li class="header">Basic Profile</li>
								<li class="grey"> Free Profile</li>
								<!--<li class="grey"><a href="{{url('get-listed?price_temp=basic')}}" class="button">Select</a></li>-->
                                <li class="grey" >
                                    <!-- <a href='{{url("user/$user/basicInfo?profile=basic")}}' class="button" style="<?php echo $basic; echo $clr1; ?>"> Get Started </a> -->

                                    <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{ url( "user/$user/basicInfo?profile=basic" )}}' name="basic" value="basic" style="<?php echo $basic; echo $clr1; ?>">  Get Started  </button>

                                </li>
								<li>Collection of unlimited online reviews</li>
								<li></li>
								<li>Use badges and widgets to display achievements </li>
								<li>Market insight to guide decision-making</li>
							</ul>
						</div>

						<div class="columns">
							<ul class="price">

                                <li class="header">   Premium</li>

                                <li class="grey">$200/month Or $100/month billed annually</li>

								<!--<li class="grey"><a href="{{url('get-listed?price_temp=premium')}}" class="button">Buy</a></li>-->

                                <li class="grey">
                                    <!-- <a href='{{url("user/$user/basicInfo?profile=premium")}}' class="button" style="<?php echo $premium; echo $clr2; ?>">Get Started</a> -->
                                    <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{url("user/$user/basicInfo?profile=premium")}}' name="premium" value="premium" style="<?php echo $premium; echo $clr2; ?>" disabled>  Coming Soon  </button>
                                </li>

                                <li><strong>Includes benefits of Basic Profile, and more</strong></li>
								<li>Collect unlimited reviews by phone and online</li>
								<li>Priority publishing of reviews</li>

								<li>Priority support for Profile, and Verification eligibility
</li>
							</ul>
						</div>

						<div class="columns">
							<ul class="price">
								<li class="header"> Reviews Feature Sponsorship</li>
								<li class="grey">Starts from $300/month</li>

                                <!--<li class="grey"><a href="{{url('get-listed?price_temp=sponsorship')}}" class="button">Learn More</a></li>-->

                                <li class="grey">

                                    <!-- <a href='{{url("user/$user/basicInfo?profile=sponsorship")}}' class="button" style="<?php echo $sponsorship; echo $clr3; ?>">Get Started </a> -->
                                    <button class="button choose-plan" data-uid="{{ $user }}" data-url='{{url("user/$user/basicInfo?profile=sponsorship")}}' name="sponsorship" value="sponsorship" style="<?php echo $sponsorship; echo $clr3; ?>" disabled>  Coming Soon  </button>
                                </li>

								<li><strong>Includes benefits of Premium Profile, and more</strong></li>
								<li>Listing shown above Free and Premium </li>
								<li>Enhanced level of visibility on all pages with Profile Verification</li>

								<li>Customer Success Analyst with additional analytics tracking</li>
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
