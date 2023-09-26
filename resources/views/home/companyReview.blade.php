@extends('layouts.home-master')

@section('content')
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>

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
						<div class="row  text-center  mx-auto text-center">
							<div class="col-md-8 mx-auto text-center">
								<div class="register-wrapper-inside">
									<p class="reg-summary">Build your company profile and start collecting client reviews.</p>
									<div class="step-wrapper step1div">
										<p class="step-number">Step 1
											<span class="step-link-mobile-completed"></span>
										</p>
										<h2><span>Sign in with Linkedin</span></h2>
										<p class="step-text">Verify your credentials &amp; create your user account</p>
										@if(!Auth::check())
											<div class="signintxt col-md-10 col-10 text-center">
												<a href="{{url('auth/linkedin')}}" class="btnlink" data-dismiss=""> Sign in with LinkedIn</a>
											</div>
										@else
											<style>
												.step1div{ display:none;}
												.step1hr{ display:none;}
											</style>
										@endif
									</div>
									<hr class="step1hr">
									<div class="step-wrapper ">
										<p class="step-number">Step 2</p>
										<h2>Review Online</h2>
										<p class="step-text">Use our online form to submit your review.</p>
										@if(Auth::check())
											<a href="{{route('company.getReview', $company)}}" class="incomplete" data-step="choose_package">Begin Online Review</a>
										@endif
									</div>
									
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