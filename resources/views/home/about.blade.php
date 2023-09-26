@extends('layouts.home-master')
@section('content')
<section class="container-fluid signin-banner animatedParent hero-section ">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-5 mx-auto text-center">
					<h3>About Us</h3>
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
					<p>About Us</p></br>
					@if(Session::get('success'))
					<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<span>
						<strong>What Is Theytrustus?</strong></br>
						Theytrustus is a data-driven field guide to business buying decisions.
						The Challenge: Market insight to guide business buying decisions is limited and often
						unorganized.
						Advertorials, paid endorsements, and sponsored posts make finding credible and accessible market
						research difficult.
						Data, case studies, and client testimonials guide buyers through the process of choosing a
						business service or solution — but it is often difficult to find all of these resources in one
						place.
						The Solution: Theytrustus, a platform of in-depth client reviews, data-driven content, and
						vetted market leaders.
						Theytrustus cuts through disorganized market research by collecting client feedback and
						analyzing industry data, arming businesses with the insights and analysis they need to connect
						and tackle challenges with confidence.
						Getting Started on Theytrustus
						Read unbiased reviews conducted by Theytrustus analysts
						See how businesses and solutions compare in a specific market
						Discover industry trends and insights from thought leaders
					</span>
					</br></br>
					<span><strong> A reliable resource that empowers data-driven content, extensive client reviews, and
							vetted professionals.</strong></span></br>
					<span>With Theytrustus, buyers and service seekers can find the best companies based on
						comprehensive reviews and research. </span></br></br>
					<span><strong>Business buying decisions guided by data.</strong></span></br>
					<span>Based on client feedback and industry data, we turn disorganized market research into
						meaningful insights and analyses that help businesses connect with clients and meet challenges
						confidently.
						We know the struggle service seekers face in finding a company to fulfill a specific need and
						how leading software firms try to differentiate themselves from the inferior competition.
						Thus, our mission is to help service buyers worldwide find the best firm/ product that meets
						their specific needs by providing a categorized directory, client reviews, and company content &
						resources. Our team interviews real clients, collects data, and compares competitors to help you
						find the best firm for your next big project.
						Performance-based companies seek exposure to the right audience, which is exactly what
						TheyTrustus serves; we:</span>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid agencies text-center animatedParent">
	<div class="container animated fadeInUp slowest go">
		<div class="row">
		
		</div>
		<div class="row pt-5 mt-4 equal">
			<div class="col-lg-3 col-md-6 px-4 px-md-1">
				<div class="agenciesbox">
					<img src="https://theytrust-us.developmentserver.info/front_components/images/icons.png" alt="">
					<h3>Share critical products and business  information. </h3>
					
				</div>
			</div>
			<div class="col-lg-3 col-md-6 px-4 px-md-1">
				<div class="agenciesbox">
					<img src="https://theytrust-us.developmentserver.info/front_components/images/icons.png" alt="">
					<h3>
     Build relationships between service seekers and providers.

             </h3>
					
				</div>
			</div>
			<div class="col-lg-3 col-md-6 px-4 px-md-1">
				<div class="agenciesbox">
					<img src="https://theytrust-us.developmentserver.info/front_components/images/icons.png" alt="">
					<h3>Treat our customer’s information as our valuable business asset.</h3>
					
				</div>
			</div>
			<div class="col-lg-3 col-md-6 px-4 px-md-1">
				<div class="agenciesbox">
					<img src="https://theytrust-us.developmentserver.info/front_components/images/icons.png" alt="">
					<h3>Ensure unbiased and authentic reviews to bring honesty to the market.</h3>
					
				</div>
			</div>
		</div>
		<a href="https://theytrust-us.developmentserver.info/company/104/dashboard" class="btn btn-primary animated fadeInRight slower go mt-5  mb-5">Join TheyTrustUs

 <span style="margin-left: 3px; font-weight: 900;">&gt;</span></a>
	</div>

</section>
@endsection
@section('script')
@endsection