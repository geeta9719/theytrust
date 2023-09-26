@extends('layouts.home-master')

@section('content')
<section class="container-fluid signin-banner animatedParent hero-section ">		
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                	<h3>Privacy Policy</h3>
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
					<p>Privacy Policy</p>
					@if(Session::get('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
                    <span>
                        Last revised: January 29th, 2019

                        <strong>Principles of data protection</strong>

                        This Privacy Policy covers information we collect from users and visitors of https://Theytrustus.co and our related research and review services (collectively, the “Services”).  By using the Services or otherwise agreeing to this Privacy Policy, you are consenting to the collection, use, disclosure and other handling of your information as described below.

                        If you have any concern about providing information to us or having such information displayed on the Services or otherwise used in any manner permitted in this Privacy Policy, you should not use the Services.

                        1. The Information We Collect.
                        Information Submitted by You
                        Information about you. We collect information about you when you participate in our research process and use the Services in a variety of ways:

                        When you create an account, you provide us with information such as your name and email address either directly or via your LinkedIn account.  We may also ask for your credit card or other banking details if you purchase certain Theytrustus Services. You can provide additional information to enhance your profile such as your location, industry, bio, picture, and phone number.  If you believe that someone has created an unauthorized account depicting you or your likeness, you can request its removal by contacting us.

                        As part of the review submission process, we will collect your name, company name, phone number, and email address for our records, but this information will not be made available to the public.
                        For posted reviews, you will have the option to either remain anonymous (e.g., only your generic job title, company description, industry, company size, and location will be posted with your review) or attribute your comments by providing information such as your name, company name, project details, and your photo.  If you choose to attribute your review, you agree that we may publicly display such information in connection with your review through the Services.
                        When you complete a survey, your responses will remain anonymous, and we will only display the results along with a generic job title, department, industry, company size, and location.
                        When you submit a project request form or consultation form, it is important to be as accurate as possible and list as much relevant information as possible. The more information you provide, the more appropriate will be the recommended Vendor matches for your project. We will need, at the least, your name, company name, project details, email contact details and preferred way for us to contact you. Please note that your email address, phone number, and other submitted information would be provided to the service providers as well as affiliate network and partner Vendors who may best fit your project needs.
                        Information about others.  You may provide information about others (e.g. clients), including their names, emails, phone numbers and companies to support our reference check and review process. You should obtain the consent of other individuals prior to providing Theytrustus with their information. The information you provide about others is only used in the reference check and review process.
                    </span>
					
				</div>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')

@endsection


