@extends('layouts.home-master')

@section('content')

<?php 
$profile = '';
$user = 0;
if(isset($_GET['price_temp'])){
	$profile = $_GET['price_temp'];
}
if(Auth::check()){
	$user = auth()->user()->id;
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
<section class="formbox container">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <div class="region region-content">
					<div class="register-wrapper">
						<div class="row mx-auto text-center">
							<div class="col-md-8 mx-auto text-center">
								<div class="register-wrapper-inside"><p class="reg-summary">Build your company profile and start collecting client reviews.</p>
									@if(!Auth::check())
									<div class="step-wrapper step1div">
										<p class="step-number">Step 1<span class="step-link-mobile-completed"></span></p>
										<p class="step-text">Verify your credentials &amp; create your user account</p>
										<div class="signintxt col-md-10 col-10 text-center">
											<a href="{{url('auth/linkedin')}}" class="btnlink" data-dismiss=""> Sign in with LinkedIn</a>
										</div>											
									</div>
									@endif
									<hr class="step1hr">
									<?php
									if(Auth::check() && empty($profile)){
										?>
										<div class="step-wrapper step2div">
											<p class="step-number">Step 2</p>
											<p>Select profile Offering</p>
											<a href="{{url('sponsorship')}}" class="incomplete" data-step="choose_package">Click Here</a>
										</div>
										<?php
									}
									?>
									<hr class="step2hr">
									<?php
									if(Auth::check() && $profile != ''){ 
										?>
										<div class="step-wrapper step3div">
											<p class="step-number">Step 3</p>
											<p>Make Your Company Profile</p>
											<a href='{{url("user/$user/basicInfo?$profile")}}' class="incomplete" data-step="choose_package">Click Here</a>
										</div>
										<?php
									}
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>                        
@endsection