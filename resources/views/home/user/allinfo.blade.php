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

<style>
.basicbox{
    background-color: #e8edf0;
    padding: 70px 0;
    /* margin-top: -150px; */
    margin-bottom: 150px;
}
.basicbox  .boxcss {
    border: 1px solid #005dae;
    padding: 10px 22px 10px 22px;
    background-color: #fff;
}
.basicbox  .boxcss p {
    font-size: 22px;
    font-weight: 600;
    margin: 0;
    color:#203457;
}
.basicbox   h2 {
margin: 0 0 20px 0;
    padding: 0;
    font-size: 26px;
    font-weight: 600;
}
.basicbox  .fa-plus{
    color: #fc373e;
    font-weight: bold;
    font-size: 22px;
}    

@media (max-width: 767px) {


    .basicbox {
   
    padding: 35px 35px;
}
}
@media (max-width: 575px) {


.basicbox {

padding: 45px 45px;
}
}
@media (max-width: 400px) {


.basicbox {

padding: 45px 45px;
}
}
</style>

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
                <p>Company Information</p>
             <a href="{{route('user.basicInfo',$uid)}}"> <i class="fa fa-plus" aria-hidden="true" ></i></a>  
            </div>
            <div class="col-md-10 mx-auto mt-4 d-flex align-items-center justify-content-between boxcss">
                <p>Locations</p>
                <a href="{{route('company.location', $company_id)}}"> <i class="fa fa-plus" aria-hidden="true" ></i></a>  
            </div>
            <div class="col-md-10 mx-auto mt-4 d-flex align-items-center justify-content-between boxcss">
                <p>Project Informations</p>
                <a href="{{route('company.focus', $company_id)}}"> <i class="fa fa-plus" aria-hidden="true"></i></a>  
            </div>
        </div>
    </div>
</section>                    
@endsection
