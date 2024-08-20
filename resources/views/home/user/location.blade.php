@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
    $addresses = $company ? \App\Models\Address::where('company_id', $company->id)->first() : null;
@endphp
{{-- @extends($addresses ? 'layouts.home-master' : 'layouts.home') --}}
@extends('layouts.home-master' )

@section('content')

<link rel="stylesheet" href="css/style.css">
<style>
   .innerformbox{
    box-shadow: 0 0 10px 0 rgb(0 0 0 / 20%);
    background-color: #fff;
    padding: 36px 40px;
    margin-bottom: 30px;
    width:600px;
   }
   .brdbtmtext{
       border-bottom:1px solid #f1f1f1;
       padding: 2px 0;
       display:flex;
   }

   .brdbtmtext .leftinnerbox{
       width:50%;
   }
   .emailinput{
       display:inline-block;
   }
   .mobileinput{
    display:inline-block;
    margin-left: 76px;
   }
   .submitbtn{
       color:#fff!important;
   }
   .namebox{
       font-weight:bold;
       width:50%;
   }
   .crossbtn a {
    display: block;
    padding: 1px 10px !important;
    color: #fff;
    background-color: #b21f2d;
    font-size: 18px;
    border: 3px solid #b21f2d;
    font-weight: bold;
    position: relative;
    margin-top: -51px;
    float: right;
    border-radius: 100%;
}
@media (max-width:767px) {
.crossbtn a {
    display: block;
    padding: 1px 9px !important;
    color: #fff;
    background-color: #b21f2d;
    font-size: 16px;
    border: 3px solid #b21f2d;
    font-weight: bold;
    position: relative;
    margin-top: -51px;
    float: right;
    border-radius: 100%;
    margin-right: 16px;
}}
   @media (max-width:676px) {

       .headquater{    font-size: 22px;}
    .locationbox {
    width: 100%!important;}
    .mobileinput {
    display: block;
    
}
.form-control {
    display: block;
    }

.emailinput{
       display:block;
   }
   .innerformbox {
       width:100%;
       padding: 36px 8px;
   }
   .brdbtmtext .leftinnerbox {
    width: 50%;
}
.mobileinput {
   
    margin-left: 0px; 
}
   }

</style>
<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <h3><strong>Describe your company's location</strong></h3>
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
<section class="formbox locationbox container">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <!--<form action="/action_page.php" class="was-validated">-->
                <form role="form" name="addLoc" id="addLoc" action="{{route('company.savelocation')}}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="card-body sheet" id="sheet2"> 
                        <!--<h4><strong class="card-title" >Where is your company Located</strong></h4>-->
                        <?php $i=0; ?>
                        @if($address->count() > 0) 
                            @foreach($address as $add)
                            <?php 
                            $i++; 
                            if(isset($add->country->state)){
                                foreach($add->country->state as $stt){
                                    if($stt->iso2 == $add->state_iso2){
                                        $sttt = $stt->name;
                                    }
                                }
                            }
                            ?>  
                            <!------------------------Address Form1 start----------------------->
                            <div class="container mt-5 innerformbox">
                                <input type="hidden" name="form" value="form2">
                                <input type="hidden" name="user_id" value="{{$add->user_id}}"> 
                                <input type="hidden" name="company_id" value="{{$add->company_id}}"> 
                                <div>
                                    <div><strong>@if($add->type == 1) {{'Headquarters Location'}}@else{{'Additional Location'}} @endif</strong></div></br>
                                    
                                    <span class="del-add-btn crossbtn right">
                                        <a data-address="{{$add->autocomplete}}" href="{{route('delete-location-by-id',$add->id)}}" class="delete-location btn btn-danger">X</a>
                                    </span>

                                    <div class="form-group">
                                        <label>Search Company Address 1.</label>
                                        <input type="text" name="autocomplete[]" id="autocomplete{{$i}}" class="form-control autoApi" placeholder="Choose Location" onkeyup="onk({{$i}})" value="{{$add->autocomplete}}">
                                    </div>
                                </div> 
                                <div class="addForm text-black" id="addStatic{{$i}}">
                                    <div class="form-group">
                                        <div class="brdbtmtext"><span class="leftinnerbox">Country:</span> <span class="country{{$i}} namebox" rel="{{$add->country->iso2 ?? ''}}">{{$add->country->name  ?? ''}}</span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">State:</span> <span class="state{{$i}} namebox" rel="{{$add->state->name ?? ''}}">{{ $sttt ?? ''}}</span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">City:</span> <span class="city{{$i}} namebox" rel="{{$add->city ?? ''}}">{{$add->city ?? ''}}</span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">Zip/Postal Code:</span> <span class="zip{{$i}} namebox" rel="{{$add->zip ?? ''}}">{{$add->zip ?? ''}}</span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">Full Address:</span> <span class="address{{$i}} namebox" rel="{{$add->address ?? ''}}">{{$add->address ?? ''}}</span></div>
                                    </div>
                                    <span style="cursor: pointer;" onclick="editBtn('addStatic{{$i}}','addForm{{$i}}',{{$i}})" class="submitbtn">Edit Your Address</span>
                                </div> <br/>

                                <div class="addForm text-black" id="addForm{{$i}}" style="display:none;">
                                    <input type="hidden" name="id[]" value="{{$add->id}}"> 
                                    <input type="hidden" name="autocomplete_1[]" id="autocomplete-1{{$i}}" value="{{$add->autocomplete}}"> 
                                    <input type="hidden" name="type[]" value="1">
                                    <input type="hidden" name="addref[]" value="{{$i}}"/>
                                    <div class="form-group">
                                        <label for="country">Country</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="country{{$i}}" name="country_iso2[]" onchange="selectCountry({{$i}})">
                                            <option value="">Select Country</option>
                                            @foreach($country as $k=>$c)
                                            <option value="{{$k}}" <?php if(!empty($add->country_iso2) && ($add->country_iso2 == $k )){ echo 'selected';}?> >{{$c}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback country{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="state{{$i}}" name="state_iso2[]" onchange="selectState({{$i}})">
                                            <option value="">Select State</option>
                                            @foreach($state as $k=>$c)
                                                @if($add->country_iso2 == $c->country_code)
                                                <option value="{{$c->iso2}}" <?php if(!empty($add->state_iso2) && ($add->state_iso2 == $c->iso2)){ echo 'selected';} ?>>{{$c->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback state{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="city{{$i}}" name="city[]" >
                                            <option value="">Select City</option>
                                            <option value="<?php if(!empty($add->city)){ echo $add->city;}?>" selected="selected"><?php if(!empty($add->city)){ echo $add->city;}?></option>
                                        </select>
                                        <div class="invalid-feedback city{{$i}} rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control rmvId" id="zip{{$i}}" name="zip[]" value="<?php if(!empty($add->zip)){ echo $add->zip;}?>">
                                        <div class="invalid-feedback zip{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="address{{$i}}" name="address[]" value="<?php if(!empty($add->address)){ echo $add->address;}?>">
                                        <div class="invalid-feedback address{{$i}} rmvCls"></div>
                                    </div>
                                    <span style="cursor: pointer;" onclick="cancelBtn('addForm{{$i}}','addStatic{{$i}}',{{$i}})" class="submitbtn">Cancel and Use Location Search</span>
                                </div><br/>
                                <div class="addForm text-black" id="addEmail{{$i}}">
                                    <div class="form-group emailinput">
                                        <label for="email">Email</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="email{{$i}}" name="email[]" value="<?php if(!empty($add->email)){ echo $add->email;}?>">
                                        <div class="invalid-feedback email{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group mobileinput">
                                        <label for="mobile">Mobile</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="mobile{{$i}}" name="mobile[]" value="<?php if(!empty($add->mobile)){ echo $add->mobile;}?>">
                                        <div class="invalid-feedback mobile{{$i}} rmvCls"></div>
                                    </div> 
                                </div>
                            </div> 
                            @endforeach
                            <?php $i = $i+1; ?>
                        @else
                        <?php $i=1;?>
                        <div >
                            <div class="container mt-5 innerformbox">
                                <input type="hidden" name="user_id" value="<?php if(!empty($company->user_id)){ echo $company->user_id;}else{echo auth()->user()->id;}?>"> 
                                <input type="hidden" name="company_id" value="{{$company->id}}"> 
                                <div>
                                    <div class="headquater">Head Office Location</div></br>
                                    <div class="form-group">
                                        <label>Search Company Address</label>
                                        <input type="text" name="autocomplete[]" id="autocomplete{{$i}}" class="form-control autoApi" placeholder="Choose Location" onkeyup="onk({{$i}})">
                                    </div>
                                </div> 
                                <div class="addForm text-black" id="addStatic{{$i}}" style="display:none;">
                                    <div class="form-group">
                                        <div class="brdbtmtext"><span class="leftinnerbox">Country:</span> <span class="namebox country{{$i}}" rel=""></span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">State:</span> <span class="namebox state{{$i}}" rel=""></span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">City:</span> <span class="namebox city{{$i}}" rel=""></span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">Zip/Postal Code:</span> <span class="namebox zip{{$i}}" rel=""></span></div>
                                        <div class="brdbtmtext"><span class="leftinnerbox">Address:</span> <span class="namebox address{{$i}}" rel=""></span></div>
                                    </div>
                                    <span style="cursor: pointer;" onclick="editBtn('addStatic{{$i}}','addForm{{$i}}',{{$i}})" class="submitbtn">Edit/Update Address</span>
                                </div> <br/>

                                <div class="addForm text-black" id="addForm{{$i}}" style="display:none;">
                                    <input type="hidden" name="id[]" value="0"> 
                                    <input type="hidden" name="autocomplete_1[]" id="autocomplete-1{{$i}}"> 
                                    <input type="hidden" name="type[]" value="1">
                                    <div class="form-group">
                                        <label for="country">Country</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="country{{$i}}" name="country_iso2[]" onchange="selectCountry({{$i}})">
                                            <option value="">Select Country</option>
                                        </select>
                                        <div class="invalid-feedback country{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="state{{$i}}" name="state_iso2[]" onchange="selectState({{$i}})">
                                            <option value="">Select State</option>
                                        </select>
                                        <div class="invalid-feedback state{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="city{{$i}}" name="city[]" >
                                             <option value="">Select City</option>
                                        </select>
                                        <div class="invalid-feedback city{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control rmvId" id="zip{{$i}}" name="zip[]">
                                        <div class="invalid-feedback zip{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="address{{$i}}" name="address[]" >
                                        <div class="invalid-feedback address{{$i}} rmvCls"></div>
                                    </div>
                                    <span style="cursor: pointer;" onclick="cancelBtn('addForm{{$i}}','addStatic{{$i}}',{{$i}})" class="submitbtn">Cancel and Use Location Search</span>
                                </div><br/>
                                <div class="addForm text-black" id="addEmail{{$i}}" style="display:none;">
                                    <div class="form-group">
                                        <label for="email">Email</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="email{{$i}}" name="email[]" >
                                        <div class="invalid-feedback email{{$i}} rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Contact No</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="mobile{{$i}}" name="mobile[]" >
                                        <div class="invalid-feedback mobile{{$i}} rmvCls"></div>
                                    </div> 
                                </div>
                            </div> 
                        </div>  
                        @endif       
                        <!-----------------------Address Form1 End------------------------>
                        <!-----------------------Address Form2 start------------------------>
                        <div class="addForm text-black" id="addAddress" >
                            
                        </div>
                        <!-----------------------Address Form2 End------------------------>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6"><a href="javascript:void(0)" rel="{{$i+1}}" id="addNewAdd" onclick="addNewAdd('addAddress')" class="submitbtn">Add Another Location</a></div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <?php if(!empty($company->user_id)){ $uid = $company->user_id;}else{ $uid = auth()->user()->id;}?>
                                <a href="{{route('user.basicInfo', $uid)}}" class="submitbtn"> < </a>
                                <!--<button type="submit" class="btn btn-sm btn-primary" >Next</button>-->
                                <button type="button" class="submitbtn" onclick="checkValue()">Next</button>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>                        
@endsection

@section('script')
<!------------------------------------------------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
<!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyD5SGX1ce2No1OQ8n8dK5LukPrr0802VDg&libraries=places" ></script> -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCdnZAhg0LJkAqtM7g82yYemaMUTR0PAY4&libraries=places"></script>
<script type="text/javascript">
    var onk;
    $(document).ready(function(){
        onk = function(idd){
            var input = document.getElementById("autocomplete"+idd);
            
            var options = { 
                fields: ["address_components", "formatted_address"]
            };
            
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            //autocomplete.setFields(["formatted_address", "address_components"]);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                console.log(place,"locationlocationlocation");
                var data = [];
                $.each(place.address_components , function(key,val) { 
                    data[val.types[0]] = val.long_name;
                    if(val.types[0] == 'country'){ 
                        data['country_code'] = val.short_name;
                    }
                });
                console.log(data);
                var formatted_address = place.formatted_address;
                $(".country"+idd).html(data['country']);
                $(".country"+idd).attr('rel', data['country_code']);

                $(".state"+idd).html(data['administrative_area_level_1']);
                $(".state"+idd).attr('rel', data['administrative_area_level_1']);

                $(".city"+idd).html(data['locality']);
                $(".city"+idd).attr('rel', data['locality']);

                var address = place.formatted_address;
                // if(data['sublocality_level_3']){address+= data['sublocality_level_3'];}
                // if(data['sublocality_level_2']){address+= data['sublocality_level_2'];}
                // if(data['sublocality_level_1']){address+= data['sublocality_level_1'];}
                // if(data['route']){address+= data['route'];}
                $(".address"+idd).html(address);
                $("#address"+idd).val(address1);
                $(".address"+idd).attr('rel', address);

                if(!data['sublocality_level_1'] && !data['sublocality_level_2'] && !data['sublocality_level_3'] && !data['neighbour']){
                    $(".address"+idd).html(data['locality']);
                    $("#address"+idd).val(data['locality']);
                    $(".address"+idd).attr('rel', data['locality']);
                }
                if(data['neighbour']){
                    $(".address"+idd).html(data['neighbour']);
                    $("#address"+idd).val(data['neighbour']);
                    $(".address"+idd).attr('rel', data['neighbour']);
                }
                $(".zip"+idd).html(data['postal_code']);
                $(".zip"+idd).attr('rel', data['postal_code']);
                //alert(place.formatted_address);
                $("#autocomplete-1"+idd).val(place.formatted_address);

                showCountry(idd,data['country_code']);
                showState(idd,data['country_code'],data['administrative_area_level_1']);
                
                //$("#city"+idd).val(data['locality']);
                $('#city'+idd).html('<option value="">Select City</option>'); 
                $("#city"+idd).append('<option value="'+data['locality']+'" selected>'+data['locality']+'</option>');

                $("#zip"+idd).val(data['postal_code']);
                
                $("#addForm"+idd).hide();
                $("#addStatic"+idd).show();
                $("#addEmail"+idd).show();
            });
        }
    });

    var addNewAdd;
    $(document).ready(function () {
        addNewAdd = function (idd1){
            var idd = $("#addNewAdd").attr('rel');
            //alert(idd);
            var str = '<div class="container mt-5 innerformbox" id="addAdd'+idd+'"><div><strong>Additional Location</strong><span class="submitbtn" onclick="removeNewAdd('+idd+')" style="float:right;" title="Remove Address">X</span></div><br><div class="form-group"><label>Search Company Address</label><input type="text" name="autocomplete[]" id="autocomplete'+idd+'" class="form-control autoApi" placeholder="Choose Location" onkeyup="onk('+idd+')"></div><div class="addForm text-black" id="addStatic'+idd+'" style="display:none;"><div class="form-group"><div class="brdbtmtext"><span class="leftinnerbox">Country:</span> <span class=" namebox country'+idd+'" rel=""></span></div><div class="brdbtmtext"><span class="leftinnerbox">State:</span> <span class="namebox state'+idd+'" rel=""></span></div><div class="brdbtmtext"><span class="leftinnerbox">City:</span> <span class=" namebox city'+idd+'" rel=""></span></div><div class="brdbtmtext"><span class="leftinnerbox">Zip/Postal Code:</span> <span class="namebox zip'+idd+'" rel=""></span></div><div class="brdbtmtext"><span class="leftinnerbox">Address:<span> <span class="namebox address'+idd+'" rel=""></span></div></div><span class="btn btn-primary" onclick="editBtn(\'addStatic'+idd+'\',\'addForm'+idd+'\','+idd+')">Edit Your Address</span></div><div class="addForm text-black" id="addForm'+idd+'" style="display:none;"><input type="hidden" name="id[]" value="0"> <input type="hidden" name="type[]" value="2"><input type="hidden" name="autocomplete_1[]" id="autocomplete-1'+idd+'"><input type="hidden" name="addref[]" value="'+idd+'"/> <div class="form-group"><label for="country">Country</label><strong style="color: red;"> *</strong><select class="form-control rmvId" id="country'+idd+'" name="country_iso2[]" onchange="selectCountry('+idd+')"><option value="">Select Country</option><option value=""></option></select><div class="invalid-feedback country'+idd+' rmvCls"></div></div><div class="form-group"><label for="state">State</label><strong style="color: red;"> *</strong><select class="form-control rmvId" id="state'+idd+'" name="state_iso2[]" onchange="selectState('+idd+')"><option value="">Select State</option><option value="" ></option></select><div class="invalid-feedback state'+idd+' rmvCls"></div></div><div class="form-group"><label for="city">City</label><strong style="color: red;"> *</strong><select class="form-control rmvId" id="city'+idd+'" name="city[]" ><option value="">Select City</option></select><div class="invalid-feedback city'+idd+' rmvCls"></div></div><div class="form-group"><label for="zip">Zip</label><input type="text" class="form-control rmvId" id="zip'+idd+'" name="zip[]" ></div><div class="form-group"><label for="address">Address</label><strong style="color: red;"> *</strong><input type="text" class="form-control rmvId " id="address'+idd+'" name="address[]" ><div class="invalid-feedback address'+idd+' rmvCls"></div></div><span onclick="cancelBtn(\'addForm'+idd+'\',\'addStatic'+idd+'\','+idd+')" class="btn btn-sm btn-primary">Cancel and Use Location Search</span></div><br/><div class="addForm text-black" id="addEmail'+idd+'" style="display:none;"><div class="form-group"><label for="email">Email</label><strong style="color: red;"> *</strong><input type="text" class="form-control rmvId " id="email'+idd+'" name="email[]" ><div class="invalid-feedback email'+idd+' rmvCls"></div></div><div class="form-group"><label for="mobile">Mobile</label><strong style="color: red;"> *</strong><input type="text" class="form-control rmvId" id="mobile'+idd+'" name="mobile[]" ><div class="invalid-feedback mobile'+idd+' rmvCls"></div></div></div></div>';

            //alert(str);
            
            $("#"+idd1).append(str);

            $("#addNewAdd").attr('rel', ++idd);
        }
    });

    var removeNewAdd;
    $(document).ready(function () {
        removeNewAdd = function (idd){
            $("#addAdd"+idd).remove();
        }
    });

    var showBtn;
    var showCountry;
    var showState;
    $(document).ready(function () {
        cancelBtn = function (idd,idd1,idd2){
            var iso2 = $(".country"+idd2).attr('rel');
            showCountry(idd2,iso2);

            var state = $(".state"+idd2).attr('rel');
            showState(idd2,iso2,state);

            var city = $(".city"+idd2).attr('rel');
            var zip = $(".zip"+idd2).attr('rel');
            var address = $(".address"+idd2).attr('rel');

            $('#city'+idd2).html('<option value="">Select City</option>'); 
            $("#city"+idd2).append('<option value="'+city+'" selected>'+city+'</option>');
            $("#zip"+idd2).val(zip);
            $("#address"+idd2).val(address);

            $("#"+idd).hide();
            $("#"+idd1).show();
        }

        editBtn = function (idd,idd1,idd2){
            $("#"+idd).hide();
            $("#"+idd1).show();
        }
     
        showCountry = function(idd,code){
            $("#country"+idd).html('');
            var s;
            $.ajax({
                url:"{{url('get-country')}}",
                type: "POST",
                data: { _token: '{{csrf_token()}}' },
                dataType : 'json',
                success: function(result){
                    $('#country'+idd).html('<option value="">Select Country</option>');  
                    $.each(result.country,function(key,value){
                        if(value.iso2 == code){s = 'selected';}else{ s=''}
                        $("#country"+idd).append('<option value="'+value.iso2+'" '+s+'>'+value.name+'</option>');
                    });
                }
            });
        }

        showState = function(idd,code,state){
            $("#state"+idd).html('');
            var s;
                $.ajax({
                    url:"{{url('get-states-by-country')}}",
                    type: "POST",
                    data: {country_code: code, _token: '{{csrf_token()}}' },
                    dataType : 'json',
                    success: function(result){
                        $('#state'+idd).html('<option value="">Select State</option>'); 
                        $.each(result.states,function(key,value){
                            if(value.name == state){s = 'selected';}else{ s=''}
                            $("#state"+idd).append('<option value="'+value.iso2+'" '+s+'>'+value.name+'</option>');
                        });
                    }
                });
        }

    });
        

    var selectCountry;
    var selectState;
    $(document).ready( function () {
        /////////////// state_city /////////////////
        selectCountry = function (idd){
            var country_code = $('#country'+idd).val();
            //alert(country_code);
            $("#state"+idd).html('');
            $.ajax({
                url:"{{url('get-states-by-country')}}",
                type: "POST",
                data: {
                    country_code: country_code,
                    _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#state'+idd).html('<option value="">Select State</option>'); 
                    $.each(result.states,function(key,value){
                        $("#state"+idd).append('<option value="'+value.iso2+'">'+value.name+'</option>');
                    });
                    $('#city'+idd).html('<option value="">Select State First</option>'); 
                }
            });
        }
        selectState = function (idd)
        {
            var state_code = $('#state'+idd).val();
            $("#city"+idd).html('');
            $.ajax({
                url:"{{url('get-cities-by-state')}}",
                type: "POST",
                data: {
                    state_code: state_code,
                    _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#city'+idd).html('<option value="">Select City</option>'); 
                    $.each(result.cities,function(key,value){
                        $("#city"+idd).append('<option value="'+value.name+'">'+value.name+'</option>');
                    });
                }
            });
        }    
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">      
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
    });

    var checkValue;
    $(document).ready(function()
    {
        checkValue = function()
        {
            var ser = $('#addLoc').serialize();
            jQuery.ajax({
                url :"{{url('get-listed-validation-step')}}",
                type: "POST",
                data: ser,
                dataType: "json",
                success: function(result)
                {
                    console.log(result);
                    $(".rmvCls").html('');
                    $(".rmvId").removeClass('is-invalid');
                    var count = Object.keys(result).length;
                    if( count > 0 )
                    {
                        $.each(result, function (key, value) 
                        {
                            $("."+key).html(value).show();
                            $("#"+key).addClass('is-invalid'); 
                            sn = parseInt( key.replace ( /[^\d.]/g, '' ), 10);
                            $('#addStatic'+sn).hide();
                            $('#addForm'+sn).show();
                        });
                        $(".alert").html('');
                        $(".alert").removeClass('alert-success');
                        $(".alert").removeClass('alert-danger');
                        $("html, body").animate({ scrollTop: "0" }); 
                    }
                    else
                    {
                        $("#addLoc").submit();
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.delete-location').click(function(e){
            e.preventDefault();
            var address = $(this).data('address');
            if( confirm( 'Are you sure you want to delete "'+address+'" ?' ) )
            {
                window.location.href = $(this).attr('href');  
            }
        });
    });
</script>
@endsection