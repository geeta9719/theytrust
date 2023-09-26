@extends('layouts.home-master')
@section('content')

<style type="text/css">
	.stxt {
	    background-color: #0087f2;
	    border-radius: 0;
	    padding: 10px;
	}
	.stxt>a {
	    text-decoration: none;
	}
</style>
<section class="container-fluid signin-banner animatedParent hero-section ">		
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center"> </div>
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
							<div class="col-md-4 mx-auto text-center">
								<div class="register-wrapper-inside">
									<div class="step-wrapper step1div">
										<div class="stxt text-center">
											<a href="{{url('get-listed')}}" class="btnlink text-white" data-dismiss=""><strong>Are You Service Provider</strong></a>
										</div>	
										<div class=" step-number text-center"><strong>OR</strong></div>
										<div class="stxt text-center">
											<a href="{{url('/')}}" class="btnlink text-white" data-dismiss=""><strong>Looking for Service Provider</strong></a>
										</div>										
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