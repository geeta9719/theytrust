@extends('layouts.home-master')

@section('content')
<section class="container-fluid signin-banner animatedParent hero-section ">		
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                	<h3>Terms & Conditions</h3>
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
					<p>Terms & Conditions</p>
					@if(Session::get('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<span>
                        <strong>Theytrustus TERMS OF USE</strong>
                        Last Updated: August 9, 2021

                        The mission of Theytrustus is to connect buyers and sellers of business services. To achieve our mission, Theytrustus’s website assists buyers in identifying prospective service providers, including by providing reviews of such companies.  We also assist service providers in marketing their companies and services. The terms “we”, “us”, “our” refer to Theytrustus, a Delaware corporation, 1800 Massachusetts Ave, Suite 200, Washington, DC  20036. The term “you”, “users”, “buyers” or “service provides” refers to users who visit the Theytrustus website (“Website”) and/or contribute content to Theytrustus via the Website, email, telephone, or otherwise.

                        BEFORE USING Theytrustus’S SERVICES READ THIS TERMS OF USE (“TERMS”) CAREFULLY. IT IS A LEGAL CONTRACT GOVERNING YOUR USE OF Theytrustus’S WEBSITE AND SERVICES, INCLUDING UPGRADES THERETO AND MATERIALS MADE AVAILABLE THEREIN.  BY USING THE Theytrustus WEBSITE, REGISTERING ON Theytrustus, OBTAINING INFORMATION FROM Theytrustus SUCH AS RESEARCH PUBLICATIONS, USING THE Theytrustus API OR MOBILE APPLICATION, CONTRIBUTING CONTENT TO Theytrustus BY ANY CHANNEL INCLUDING BY POSTING INFORMATION ON THE WEBSITE, RESPONDING TO A SURVEY, SUBMITTING AN EMAIL, OR PARTICIPATING IN A TELEPHONE INTERVIEW(COLLECTIVELY “Theytrustus” OR THE “SERVICES”), YOU, YOUR HEIRS, AND ASSIGNS (COLLECTIVELY, “YOU” OR “YOUR”) AGREE TO BE BOUND BY THESE TERMS, Theytrustus’S PRIVACY POLICY, Theytrustus’S REVIEW GUIDELINES, AND ANY APPLICABLE Theytrustus INVOICE(S) (“INVOICE”) (COLLECTIVELY, THE “TERMS”).  

                        If you are entering into these Terms on behalf of a company or other legal entity, you represent that you have the authority to bind such entity and its affiliates to the Terms. In that case, the terms “you” or “your” shall also refer to such entity, and its affiliates, as applicable. If you do not have such authority, or you do not accept all of these Terms, do not use the Services or provide information to Theytrustus. 

                        Be sure to return to this page periodically to review the most current version of the Terms. We reserve the right at any time, at our sole discretion, to change or otherwise modify the Terms without prior notice, and your continued access to or use of the Services signifies your acceptance of the updated or modified Terms.

                        We retain the right at our sole discretion to deny access to anyone to the Services we offer, at any time and for any reason, including, but not limited to, for violation of these Terms.

                        Eligibility 

                        You must be 18 years of age or older in order to use the Services, including to register for an account, use the Website or submit reviews or other User Content (defined below).   

                        Account Registration

                        As part of your use of the Services, you may have the opportunity to create a Theytrustus account. You are responsible for your account and agree to provide, upon registration, and at all times maintain, accurate, current, and complete information. Theytrustus reserves the right, in its sole discretion, to refuse to keep accounts for, or provide Services to, any individual. Theytrustus reserves the right to suspend or terminate your account if any information provided during the registration process or at other times proves to be inaccurate, not current or incomplete. You are responsible for ensuring the confidentiality and security of your account information, including your username and password. You will immediately notify Theytrustus of any unauthorized use of your account. Theytrustus cannot and will not be liable for any loss or damage arising from your failure to properly comply with this section.                
                    </span>
				</div>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')

@endsection


