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
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <div class="container">
					<p>Contact us</p>
					@if(Session::get('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<form method="POST" action="{{url('sendContactEmail')}}">
						@csrf
						<div class="form-group">
							<label for="pwd">Contact Email*:</label>
							<input type="text" class="form-control" id="contact_email" name="contact_email">
							<span class="text-danger">@error('contact_email'){{$message}}@enderror</span>
						</div>
						
						<div class="form-group">
							<label for="usr">First Name*:</label>
							<input type="text" class="form-control" id="first_name" name="first_name">
							<span class="text-danger">@error('first_name'){{$message}}@enderror</span>
						</div>
						
						<div class="form-group">
							<label for="usr">Last Name*:</label>
							<input type="text" class="form-control" id="last_name" name="last_name">
							<span class="text-danger">@error('last_name'){{$message}}@enderror</span>
						</div>
						
						<div class="form-group">
							<label for="pwd">Company Name*:</label>
							<input type="text" class="form-control" id="company_name" name="company_name">
							<span class="text-danger">@error('company_name'){{$message}}@enderror</span>
						</div>
						
						<div class="form-group">
							<label for="subject">Subject:</label>
							<input type="text" class="form-control" id="subject" name="subject">
						</div>
						
						<div class="form-group">
							<label for="message" class="form-label">What can we help with?</label>
							<textarea class="form-control" id="message" name="message" rows="3"></textarea>
						</div>
						<br>
						<input type="submit" name="send _email" value="Submit" class="btn btn-primary">
					</form>
				</div>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')

@endsection


