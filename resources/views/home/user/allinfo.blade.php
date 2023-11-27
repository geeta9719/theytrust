@extends('layouts.home-master')

@section('content')

<?php
if(isset($_GET['profile']) && !empty($_GET['profile']))
{
    $profile_type = $_GET['profile'];
}
else
{
    $profile_type = '';
}    
?>


<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <p class="flashmsg"> @if(Session::has('message'))
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

<section class=" container mb-0" >
    <div class="row">
        
        <div class="container  basicbox">
        <div class="col-md-10 mx-auto p-0">
            <h2>Edit Profile</h2>
            </div>
            <div class="col-md-10 mx-auto d-flex align-items-center justify-content-between boxcss">
                
             <a href="{{route('user.basicInfo',$uid)}}" class="allinforow"> <p>Company Information</p> <i class="fa fa-plus" aria-hidden="true" ></i></a>  
            </div>
            <div class="col-md-10 mx-auto mt-4 d-flex align-items-center justify-content-between boxcss">
                
                <a href="{{route('company.location', $company_id)}}"  class="allinforow"><p>Locations</p> <i class="fa fa-plus" aria-hidden="true" ></i></a>  
            </div>
            <div class="col-md-10 mx-auto mt-4 d-flex align-items-center justify-content-between boxcss">
               
                <a href="{{route('company.focus', $company_id)}}"  class="allinforow"> <p>Project Informations</p> <i class="fa fa-plus" aria-hidden="true"></i></a>  
            </div>
        </div>
    </div>
</section>                    
@endsection
