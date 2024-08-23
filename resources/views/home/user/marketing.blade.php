@php
$company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
    $data = $company ? \App\Models\AdminInfo::where('company_id', $company->id)->first() : null;
@endphp
{{-- @extends($data ? 'layouts.home-master' : 'layouts.home') --}}
@extends('layouts.home-master' )

@section('content')

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <!--<h2>EDIT PROFILE</h2>-->
                    <!--<h3><strong class="card-title text-black" style="">Logged In With : {{auth()->user()->email}} </strong></h3>-->
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
                <!--<form action="/action_page.php" class="was-validated">-->
                <form role="form" name="marketing" id="marketing" action="{{route('company.saveAdminInfo')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form" value="form4">
                    <input type="hidden" name="id" value="<?php if(!empty($adminInfo->id)){ echo $adminInfo->id;}else{echo '0';}?>">
                    <input type="hidden" name="company_id" value="<?php if(!empty($adminInfo->company_id)){ echo $adminInfo->company_id;}else{echo $company->id;}?>">
                    <div class="card-body sheet text-black" id="sheet1">
                        <div class="card-header" >
                            <h4><strong class="card-title" >Please fill in admin information</strong></h4>
                        </div> 

                        <div class="form-group">
                            <label for="email"> Email</label><strong style="color: red;"> *</strong>
                            <input type="email" class="form-control rmvId " id="email" name="email" value="<?php if(!empty($adminInfo->email)){ echo $adminInfo->email;}?>">
                            <div class="invalid-feedback email rmvCls"></div>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Admin contact</label>
                            <input type="text" class="form-control rmvId" id="mobile" name="mobile" value="<?php if(!empty($adminInfo->mobile)){ echo $adminInfo->mobile;}?>">
                            <div class="invalid-feedback mobile rmvCls"></div>
                        </div>
                        <div class="form-group">
                            <label for="linkedin">LinkedIn URL</label>
                            <input type="text" class="form-control rmvId" id="linkedin" name="linkedin" value="<?php if(!empty($adminInfo->linkedin)){ echo $adminInfo->linkedin;}?>">
                            <div class="invalid-feedback linkedin rmvCls"></div>
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook URL</label>
                            <input type="text" class="form-control rmvId" id="facebook" name="facebook" value="<?php if(!empty($adminInfo->facebook)){ echo $adminInfo->facebook;}?>">
                            <div class="invalid-feedback facebook rmvCls"></div>
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter URL</label>
                            <input type="text" class="form-control rmvId" id="twitter" name="twitter" value="<?php if(!empty($adminInfo->twitter)){ echo $adminInfo->twitter;}?>">
                            <div class="invalid-feedback twitter rmvCls"></div>
                        </div>
                        <div class="form-group">
                            <label for="analytics">Google Analytics Tracking ID</label>
                            <input type="text" class="form-control rmvId" id="analytics" name="analytics" value="<?php if(!empty($adminInfo->analytics)){ echo $adminInfo->analytics;}?>">
                            <div class="invalid-feedback analytics rmvCls"></div>
                        </div>
                    </div>
                    <a href="{{route('company.focus',$company->id)}}" class="btn btn-sm btn-primary"> < </a>
                    <div class="col-md-12 text-center btnbasic">
                        <button type="button" class="btn btn-sm btn-primary" onclick="checkValue()">Next</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="saveAndBack()">Save and Back</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')
<script type="text/javascript">      
    var checkValue;
    $(document).ready(function(){
        checkValue = function(){
            var ser = $('#marketing').serialize();
            console.log(ser);
            jQuery.ajax({
                url:"{{url('get-listed-validation-step')}}",
                type: "POST",
                data: ser,
                dataType : 'json',
                success: function(result){
                    //console.log(result);
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
                        $("html, body").animate({ scrollTop: "0" }); 
                    }else{
                        $("#marketing").submit();
                    }    
                }
            });
        }
    });   

     document.addEventListener('DOMContentLoaded', function() {
    // Existing code...

    window.saveAndBack = function() {
        // Add a hidden input to indicate "save and back" action
        const form = document.getElementById('marketing');
        const saveBackInput = document.createElement('input');
        saveBackInput.type = 'hidden';
        saveBackInput.name = 'save_and_back';
        saveBackInput.value = '1';
        form.appendChild(saveBackInput);

        // Submit the form
        checkValue();
    }
}); 

</script>
@endsection    