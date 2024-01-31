@extends('layouts.home-master')

@section('content')
<link rel="stylesheet" href="css/style.css">
<style>
   
</style>

@if( Session::has('message') )
    <div class="alert alert-success" style="text-align:center;font-weight: bolder;">{{ Session::get('message') }}</div>
@endif

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="company_profile dash_profile pt-5 container">
        <div class="row ml-0 mr-0 dash-row dashsecond">
            <div class="col-md-3 brdright pt-2 pb-2"><h4>Profile</h4></div>
            <div class="col-md-6 brdright pt-2 pb-2"><h4>Reviews</h4></div>
            <div class="col-md-3 pt-2 pb-2"><h4>Updates</h4></div>   
        </div>

    <div class="borderbox">
        <div class="row ml-0 mr-0 dash-row company text-center ">
            <div class="col-md-3  brdright companybox leftbrd d-flex align-items-center justify-content-center secondrow">
                Last updated: {{ date('M d, Y', strtotime($company->updated_at));}} 
            </div>
            <div class="col-md-6 brdright companybox align-middle d-flex align-items-center justify-content-center secondrow">Add at least three reviews to your profile to increase visibility </div>
            <div class="col-md-3 companybox border-0 d-flex align-items-center justify-content-center secondrow"><span style="">&nbsp; {{ $company->review ?? ' 0 '}} Reviews Added</span></div> 
        </div> 

        <div class="row  ml-0 mr-0 company-dec dash-third ">
            <div class="col-md-3 sponsored companybox pt-3">
                <!-- Profile details -->
                <span class="logobx bx"><img src='{{url("storage/$company->logo")}}' alt="" class="img-fluid" style="width: 50px;height: 50px;"></span>
                <span class="companyname bx"><strong>{{ucfirst($company->name)}}</strong></span>
                <span class="tagline bx">{{ucfirst($company->tagline)}}</span>

                <p class="pt-5">
                    <!-- <img src="https://theytrust-us.developmentserver.info/front_components/images/staticmap.png" class="img-fluid" alt=""> -->
                </p>

                @if($company->is_publish == 0)
                    <p><i class="fa fa-circle" style="color: red;" aria-hidden="true"></i> Profile Unpublished</p>
                @else
                    <p><i class="fa fa-circle" style="color: green;" aria-hidden="true"></i> Profile Published</p>
                @endif

                @if($company->website)<p><i class="fa fa-tag" aria-hidden="true"></i> {{ $company->website }}</p>@endif
                @if($company->email)
                    <p><i class="fa fa-clock-o" aria-hidden="true" ></i> {{ $company->email ?? ''}}</p>
                @endif
                <p><i class="fa fa-user" aria-hidden="true" ></i> Service Lines: {{ $company->service_lines }}</p>
                <p>
                    <?php if(!empty($company->user_id)){ $uid = $company->user_id;}else{ $uid = auth()->user()->id;}?>    
                    @if($company->profile_type)<span class="btn btn-sm disabled" aria-disabled="true" tabindex="-1" style="font-size: 14px;">{{ ucfirst($company->profile_type) }} Profile</span>@endif
                    <a href="{{route('user.allinfo',$uid)}}" class="btn btn-sm" style="font-size: 14px;">Update Profile</a>
                </p>   
            </div>
            <div class="col-md-6 companybox sponsored pt-3">
                <!-- Reviews details -->
                <p>The first review to be published is a sponsored profile review. The rest of the reviews normally take about 1-2 weeks to be published.</p>
            </div>
            <div class="col-md-3 pt-3 sponsored sponsoredright">
                <!-- Updates details -->
                @if($company->is_publish == 0)
                    <p>We are reviewing your Company Profile at the moment and will publish it soon.</p>
                    <p>Once your profile gets published, you can map out your performance through this section.</p>
                @endif
            </div>
        </div>

        <!-- ... (your existing code) ... -->

<div class="row ml-0 mr-0 company-dec dash-third">
    <div class="col-md-12 pt-3 sponsored sponsoredright">
        <h4>Current Subscriptions</h4>
        <div class="row">
            @if($currentSubscription)
                @foreach($currentSubscription as $subscription)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Subscription ID: {{ $subscription['id'] }}</h5>
                                <p class="card-text">Starts On: {{ $subscription['starts_on'] }}</p>
                                <p class="card-text">Expires On: {{ $subscription['expires_on'] }}</p>
                                
                                <!-- Calculate remaining days -->
                                @php
                                    $expires = \Carbon\Carbon::parse($subscription['expires_on']);
                                    $remainingDays = $expires->diffInDays(now());
                                @endphp
                                
                                @if($remainingDays <= 0)
                                    <p class="card-text text-danger">Expired</p>
                                @elseif($remainingDays <= 30)
                                    <p class="card-text text-warning">Expires In: {{ $remainingDays }} days (Expiring soon)</p>
                                @else
                                    <p class="card-text">Expires In: {{ $remainingDays }} days</p>
                                @endif
                                
                                <!-- Add more subscription details as needed -->
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No current subscriptions</p>
            @endif
        </div>
    </div>
</div>

<!-- ... (rest of your code) ... -->

        
        
    </div>
</section>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        showHideAdd = function(idd,idd1){
            $("#"+idd).hide();
            $("#"+idd1).show();
        }
    });    
</script>        
@endsection
