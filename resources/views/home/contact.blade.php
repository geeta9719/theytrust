@extends('layouts.home-master')
@section('content')
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet" />
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
<section class="formbox container contact-form-sec mt-1">
	<div class="row  ">
		<div class="col-lg-12">
			<div class="col-lg-12  form-size">
				<div class="container">

					@if(Session::get('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>		
					@endif

					@if($errors->any())
					    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
					@endif

					<p><b>Team TheyTrustUs</b></p>
					<p><u><b>We are here to help!</b></u></p>
					<h6><b>You can choose from the options below based on your question type.</b></h6>
					
					<form method="POST" action="{{ url('sendContactEmail') }}">
						
						@csrf
						
						<div class="form-group">
							<input type="radio" name="help_options" value="Services buyer" checked ="checked" />
							<label for="">Services buyer</label><br>
							<input type="radio" name="help_options" value="Services Reviewer">
							<label for="">Services Reviewer</label><br>
							<input type="radio" name="help_options" value="Provider with a TheyTrustUs profile">
							<label for="">Provider with a TheyTrustUs profile</label><br>
							<input type="radio" name="help_options" value="Establishing a TheyTrustUs Profile as a Service Provider">
							<label for="">Establishing a TheyTrustUs Profile as a Service Provider</label><br>
							<input type="radio" name="help_options" value="Other">
							<label for="">Other</label>
						</div>
						
						<p><u><b>Let's find an answer together.</b></u></p>
						
						<h6><b>Our team will be able to respond to your inquiry more quickly if you provide us with your contact information and additional details.</b> </h6>
						
								<div class="form-group">
				<label for="first_name">First Name*:</label>
				<input type="text" class="form-control" id="first_name" name="first_name" required="required" value="{{ old('first_name') }}">
			</div>

			<div class="form-group">
				<label for="last_name">Last Name*:</label>
				<input type="text" class="form-control" id="last_name" name="last_name" required="required" value="{{ old('last_name') }}">
			</div>

			<div class="form-group">
				<label for="email">Email*:</label>
				<input type="text" class="form-control" id="email" name="email" required="required" value="{{ old('email') }}">
			</div>

			<div class="form-group">
				<label for="phone">Phone Number*:</label>
				<input type="tel" class="form-control" id="phone" name="phone" required="required" value="{{ old('phone') }}">
			</div>


						<div class="form-group">
    <label for="message">Message*:</label>
    <textarea class="form-control" id="message" name="message" required="required" rows="4"></textarea>
</div>

						<br>
						
						<input type="submit" name="send-contact" value="Submit" class="btn btn-primary" />

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
@endsection