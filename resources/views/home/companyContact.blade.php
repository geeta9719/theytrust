@extends('layouts.home-master')

@section('content')
<?php $user = Auth::user();?>
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>

<section class="container-fluid signin-banner animatedParent hero-section ">		
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <!--<h2>EDIT PROFILE</h2>-->
                    <!--<h3><strong class="card-title text-black" style=""> </strong></h3>-->
                    <p> @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                        @endif
                    </p>
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
									<p>Contact Hyperlink InfoSystem using the form below</p>
									@if(Session::get('success'))
										<div class="alert alert-success">{{ Session::get('success') }}</div>
									@endif
								  <form method="POST" action="{{url('sendCompanycontactEmail')}}">
									@csrf
								    <div class="form-group">
										<label for="usr">Full Name:</label>
										<input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->name}}">
										<span class="text-danger">@error('full_name') {{ $message }} @enderror</span>
								    </div>
								    <div class="form-group">
										<label for="pwd">Company Name:</label>
										<input type="text" class="form-control" id="company_name" name="company_name">
										<span class="text-danger">@error('company_name') {{ $message }} @enderror</span>
								    </div>
									<div class="form-group">
										<label for="pwd">Contact Email:</label>
										<input type="text" class="form-control" id="contact_email" name="contact_email" value="{{$user->email}}" readonly>
										<span class="text-danger">@error('contact_email') {{ $message }} @enderror</span>
								    </div>
									<div class="form-group">
										<label for="subject">Subject:</label>
								    </div>
									<div class="form-check">
										<input type="radio" class="form-check-input" name="subject" value="leads" checked> Get a quote/discuss my project needs
										<label class="form-check-label" for="radio1"></label>
									</div>
									<div class="form-check">
										<input type="radio" class="form-check-input" name="subject" value="partnership"> Propose a partnership opportunity
										<label class="form-check-label" for="radio2"></label>
									</div>
									<div class="form-check">
										<input type="radio" class="form-check-input" name="subject" value="job_seeker"> Find a job
										<label class="form-check-label"></label>
									</div>
									<div class="form-check">
										<input type="radio" class="form-check-input" name="subject" value="other"> Other
										<label class="form-check-label"></label>
									</div>
									<span class="text-danger">@error('subject') {{ $message }} @enderror</span>
									<div class="form-check">
										<label for="message" class="form-label">Message</label>
										<textarea class="form-control" id="message" name="message" rows="3"></textarea>
										<span class="text-danger">@error('message') {{ $message }} @enderror</span>
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


