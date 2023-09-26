@extends('layouts.home-master')

@section('content')

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 mx-auto text-center">   
                    <h2>EDIT PROFILE</h2>
                    <h3><strong class="card-title text-black" style="">Logged In With : {{auth()->user()->email ?? ''}} </strong></h3>
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
                <form role="form" name="addPer" id="addPer" class="" action="{{route('user.savePersonal',auth()->user()->id)}}" method="post" enctype="multipart/form-data">
                    @csrf    
                    <input type="hidden" name="form" value="personal">
                    <input type="hidden" id="oldAvatar" name="oldAvatar" value="{{auth()->user()->avatar ?? ''}}">
                    <h4><strong class="card-title" >Personal Information</strong></h4> 
                    <div class="pt-4 file-field">
                        <img src="{{ isset(auth()->user()->avatar) ? auth()->user()->avatar : asset('front_components/images/user1.png') }}" width="40" height="40" style="border-radius:25px;">
                        <input type="file" class=" rmvId" id="avatar" name="avatar">
                        <div class="invalid-feedback avatar rmvCls"></div>
                    </div>

                    <div class="form-group pt-4">
                        <label for="first_name">First Name</label><strong style="color: red;"> *</strong>
                        <input type="text" class="form-control rmvId" id="first_name" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" required>
                        <div class="invalid-feedback first_name rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control rmvId" id="last_name" name="last_name" value="{{auth()->user()->last_name ?? '' }}" required>
                        <div class="invalid-feedback last_name rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control rmvId" id="company" name="company" value="{{auth()->user()->company ?? '' }}" placeholder="Company" required>
                        <div class="invalid-feedback company rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Contact Email</label><strong style="color: red;"> *</strong>
                        <input type="text" class="form-control rmvId" id="email" name="email" value="{{auth()->user()->email ?? '' }}" required>
                        <div class="invalid-feedback email rmvCls"></div>
                    </div>

                    <h4 class="pt-4"><strong class="card-title">About</strong></h4> 
                    <div class="form-group pt-4">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control rmvId" id="twitter" name="twitter" value="{{auth()->user()->twitter ?? '' }}" placeholder="https://twitter.com/jondoe">
                        <div class="invalid-feedback twitter rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" class="form-control rmvId" id="linkedin" name="linkedin" value="{{auth()->user()->linkedin ?? '' }}" placeholder="https://linkedin.com/jondoe">
                        <div class="invalid-feedback linkedin rmvId"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio-dd" cols="50" rows="5" class="form-control rmvId">{{auth()->user()->bio ?? '' }}</textarea>
                        <div class="invalid-feedback bio rmvCls"></div>
                    </div>                                                        
                    <div class="card-footer">
                        <!--<button type="submit" class="btn btn-sm btn-primary">Save Changes</button>-->
                        <button type="button" class="btn btn-sm btn-primary" onclick="checkValue()">Save Changes</button>
                    </div>
                </form>
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
            var ser = new FormData($('#addPer')[0]);
            //var ser = $('#addPer').serialize();
            console.log(ser);
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
                        $("#addPer").submit();
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
