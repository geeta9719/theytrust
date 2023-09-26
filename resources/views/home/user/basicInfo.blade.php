@extends('layouts.home-master')

@section('content')

<?php
if(isset($_GET['profile']) && !empty($_GET['profile'])){
    $profile_type = $_GET['profile'];
}else{
    $profile_type = '';
}    
?>

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <!--<h2>EDIT PROFILE</h2>-->
                    <!--<h3><strong class="card-title text-black" style="">Logged In With : {{auth()->user()->email}} </strong></h3>-->
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
<section class="formbox container">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <!--<form action="/action_page.php" class="was-validated">-->
                <form role="form" name="basicAdd" id="basicAdd" class="" action="{{route('user.saveBasicInfo')}}" method="post" enctype="multipart/form-data">
                    @csrf   
                    <input type="hidden" name="user_id" value="<?php if(!empty($company->user_id)){ echo $company->user_id;}else{echo auth()->user()->id;}?>"> 
                    <input type="hidden" name="form" value="form1">
                    <input type="hidden" name="profile_type" value="<?php if(!empty($profile_type)){ echo $profile_type;}elseif(!empty($company->profile_type)){echo $company->profile_type;}?>">
                    <input type="hidden" id="oldLogo" name="oldLogo" value="{{$company->logo ?? ''}}">

                    <div class="card-body sheet" id="sheet1">
                        <h4><strong class="card-title" >Let's get some basic information</strong></h4> 
                        <div class="pt-4 file-field">
                            <img src="<?php if(!empty($company->logo)){ echo $company->logo;}else{echo asset('front_components/images/logo1.jfif');}?>" width="40" height="40" style="border-radius:25px;">

                            <span> Upload Company Logo  </span><strong style="color: red;"> *</strong>
                            <input type="file" class="rmvId" id="logo" name="logo">
                            <div class="invalid-feedback error1 logo rmvCls">Invalid Image Format!</div>
                        </div>

                        <div class="form-group pt-4">
                            <label for="name">Organization Name </label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control rmvId" id="name" name="name" value="<?php if(!empty($company->name)){ echo $company->name;}?>">
                            <div class="invalid-feedback name rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="website">Website or Company URL (eg: https://example.com) </label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control rmvId" id="website" name="website" value="<?php if(!empty($company->website)){ echo $company->website;}?>">
                            <div class="invalid-feedback website rmvCls"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget">Project Scale</label>
                            <select class="form-control rmvId" id="budget" name="budget" >
                                <option value="">Select a value</option>
                                @foreach($budget as $b)
                                    <?php 
                                    $bb = explode('-',$b['budget']);
                                    $bud = '$'.$bb[0].' - $'.$bb[1];
                                    ?>
                                    <option value="{{ $b['budget'] }}" <?php if(!empty($company->budget)){ echo 'selected';}?> >{{ $bud }}</option>
                                @endforeach    
                            </select>
                            <div class="invalid-feedback budget rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="rate">Hourly Rate</label>
                            <select class="form-control rmvId" id="rate" name="rate" >
                                <option value="">Select a value</option>
                                @foreach($rate as $b)
                                    <?php 
                                    $bb = explode('-',$b['rate']);
                                    $bud = '$'.$bb[0].' - $'.$bb[1];
                                    ?>
                                    <option value="{{ $b['rate'] }}" <?php if(!empty($company->rate)){ echo 'selected';}?>>{{ $bud }}</option>
                                @endforeach    
                            </select>
                            <div class="invalid-feedback rate rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="size">Organization Size</label><strong style="color: red;"> *</strong>
                            <select class="form-control rmvId" id="size" name="size" >
                                <option value="">Select a value</option>
                                @foreach($size as $b)
                                    <option value="{{$b->size}}" <?php if(!empty($company->size)){ echo 'selected';}?>>{{$b->size}}</option>
                                @endforeach    
                            </select>
                            <div class="invalid-feedback size rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="founded_at">Company Founded</label>
                            <select class="form-control rmvId" id="founded_at" name="founded_at" >
                                <option value="">Select a value</option>
                                <?php for($i=0; $i<=49; $i++){ $y = date('Y'); ?>    
                                    <option value="{{$y-$i}}" <?php if(!empty($company->founded_at)){ echo 'selected';}?>>{{$y-$i}}</option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback founded_at rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="tagline">Title</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control rmvId" id="tagline" name="tagline" value="<?php if(!empty($company->tagline)){ echo $company->tagline;}?>">
                            <div class="invalid-feedback tagline rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="short_description">Message</label><strong style="color: red;"> *</strong>
                            <textarea name="short_description" id="short_description" cols="50" rows="5" class="form-control rmvId"><?php if(!empty($company->short_description)){ echo $company->short_description;}?></textarea>
                            <div class="invalid-feedback short_description rmvCls"></div>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-sm btn-primary" onclick="checkValue()">Next</button>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">      
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
    });

    var checkValue;
    $(document).ready(function(){
        checkValue = function(){
            var ser = new FormData($('#basicAdd')[0]);
            //var ser = $('#basicAdd').serialize();
            //console.log(ser);
            jQuery.ajax({
                url:"{{url('get-listed-validation-step')}}",
                type: "POST",
                data: ser,
                dataType: "json",
                cache:false,
                contentType: false,
                processData: false,
                success: function(result){
                    console.log(result);
                    $(".rmvCls").html('');
                    $(".rmvId").removeClass('is-invalid');
                    var count = Object.keys(result).length;
                    //console.log(count);
                    if(count > 0){
                        $.each(result, function (key, value) {
                            //console.log(key);
                            //console.log(value);
                            $("."+key).html(value).show();
                            $("#"+key).addClass('is-invalid');
                        });
                        //window.history.pushState('', '', 'companies?'+ser);
                        $(".alert").html('');
                        $(".alert").removeClass('alert-success');
                        $(".alert").removeClass('alert-danger');
                        $("html, body").animate({ scrollTop: "0" }); 
                    }else{
                        $("#basicAdd").submit();
                    }    
                },
                error: function(result){
                    console.log("error");
                    console.log(result);
                }
            });
        }
    });    

</script>
@endsection
