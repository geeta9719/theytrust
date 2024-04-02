@extends('layouts.admin-master')

@section('content')

<!-- Main content add companey view -->

<section class="formbox container">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size"> 
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                    @endif   

                    @error('file')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
            </div>
        </div>
    </div>
</section> 


<!-- Start Section Location -->

@php 
    $id = 1
@endphp

<section class="formbox locationbox container mb-5 pb-5">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size"> 

                <form role="form" name="addLoc" id="addLoc" action="{{route('admin.company.save-location')}}" method="post" enctype="multipart/form-data">
                    
                @csrf 

                @if( count( $addresses ) > 0 )

                    @foreach( $addresses as $add )

                    <div class="card-body sheet" id="sheet2">  
                                    
                            <div class="container mt-5 innerformbox">

                                <input type="hidden" name="user_id" value="{{ $add->user_id }}"/> 
                                <input type="hidden" name="company_id" value="{{ $add->company_id }}"/>
                                <input type="hidden" name="id[]" value="{{ $add->id }}"/> 
                                <input type="hidden" name="action[]" value="update"/>
                                <input type="hidden" name="is_head_office[]" value="{{ $add->is_head_office }}"/>
                                
                                <div class="headquater font-weight-bold" style="font-size:22px;">{{ $add->is_head_office === 1 ? 'Head Office Location' : 'Additional Office Location' }}</div>
                                 
                                <div class="addForm text-black" id="addForm">
                                    
                                    <div class="form-group">
                                        <label for="country">Country</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="country{{$add->id}}" name="country_iso2[]" onchange="selectCountry({{$add->id}})" required="required">
                                            <option value="">Select Country</option>
                                            @foreach( $country as $key => $cntry )
                                            <option value="{{$key}}" {{ $add->country_iso2 == $key ? 'selected' : '' }} >{{$cntry}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback country rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="state">State</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="state{{$add->id}}" name="state_iso2[]" onchange="selectState({{$add->id}})" required="required">
                                            <option value="">Select State</option>
                                            @foreach( $states as $state )
                                                @if( $state->country_code == $add->country_iso2)
                                                    <option value="{{$state->iso2}}" {{$add->state_iso2 == $state->iso2 ? 'selected':''}} >{{$state->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback state rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="city{{$add->id}}" name="city[]" required="required">
                                             <option value="">Select City</option>
                                             @if( $add->city )
                                             <option value="{{$add->city}}" selected="selected">{{$add->city}}</option>
                                             @endif
                                        </select>
                                        <div class="invalid-feedback city rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control rmvId" id="zip{{$add->id}}" name="zip[]" value="{{$add->zip}}">
                                        <div class="invalid-feedback zip rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="address{{$add->id}}" name="address[]" required="required" value="{{$add->address}}">
                                        <div class="invalid-feedback address rmvCls"></div>
                                    </div>

                                </div>

                                <div class="addForm text-black" id="addEmail">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control rmvId" id="email{{$add->id}}" name="email[]" value="{{$add->email}}">
                                        <div class="invalid-feedback email rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Contact No</label>
                                        <input type="text" class="form-control rmvId" id="mobile{{$add->id}}" name="mobile[]" value="{{$add->mobile}}">
                                        <div class="invalid-feedback mobile rmvCls"></div>
                                    </div> 
                                </div>

                            </div> 
                    </div>
                    
                    @endforeach

                @else

                    <div class="card-body sheet" id="sheet2">  
        
                            <div class="container mt-5 innerformbox">

                                <input type="hidden" name="user_id" value="{{ $user_id }}"/> 
                                <input type="hidden" name="company_id" value="{{ $company_id }}"/>
                                <input type="hidden" name="id[]" value="{{ $id }}"/>
                                <input type="hidden" name="action[]" value="insert"/> 
                                <input type="hidden" name="is_head_office[]" value="1"/> 
                                
                                <div class="headquater">Head Office Location</div>
                                 
                                <div class="addForm text-black" id="addForm">
                                    
                                    <div class="form-group">
                                        <label for="country">Country</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="country{{$id}}" name="country_iso2[]" onchange="selectCountry({{$id}})" required="required">
                                            <option value="">Select Country</option>
                                            @foreach( $country as $key => $cntry )
                                            <option value="{{$key}}">{{$cntry}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback country rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="state">State</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="state{{$id}}" name="state_iso2[]" onchange="selectState({{$id}})" required="required">
                                            <option value="">Select State</option>
                                        </select>
                                        <div class="invalid-feedback state rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label><strong style="color: red;"> *</strong>
                                        <select class="form-control rmvId" id="city{{$id}}" name="city[]" required="required">
                                             <option value="">Select City</option>
                                        </select>
                                        <div class="invalid-feedback city rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control rmvId" id="zip{{$id}}" name="zip[]">
                                        <div class="invalid-feedback zip rmvCls"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label><strong style="color: red;"> *</strong>
                                        <input type="text" class="form-control rmvId" id="address{{$id}}" name="address[]" required="required">
                                        <div class="invalid-feedback address rmvCls"></div>
                                    </div>

                                </div>

                                <div class="addForm text-black" id="addEmail">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control rmvId" id="email{{$id}}" name="email[]" />
                                        <div class="invalid-feedback email rmvCls"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Contact No</label>
                                        <input type="text" class="form-control rmvId" id="mobile{{$id}}" name="mobile[]" />
                                        <div class="invalid-feedback mobile rmvCls"></div>
                                    </div> 
                                </div>

                            </div> 
                    </div>

                @endif

                    <div class="addForm text-black" id="addAddressAdditional" ></div>

                    <button type="button" id="addition_address_add" class="btn btn-sm btn-primary">Add Aditional Address</button>

                    <br>
                    
                    <br>

                    <a href="{{ route( 'admin.company.add', [ $user_id, $company_id ] )}}" class="btn btn-sm btn-primary"> < </a>

                    <button type="submit" class="btn btn-lg btn-primary">Save Location</button>

                    <a href="{{ route( 'admin.company.focus', $company_id )}}" class="btn btn-sm btn-primary"> > </a>
                    
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
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB9YeE5IDfcAUalQ8G26_crBmKoHYvoN5I&libraries=places"></script>
<script type="text/javascript">

$(document).ready(function(){

    var i = {{$id+1}};

    $(document).on( 'click', '#addition_address_add', function(){

    var adtnl_add = '<div class="card-body sheet" id="sheet2">';                                                 
        adtnl_add += '   <div class="container mt-5 innerformbox">';
        adtnl_add += '<div class="headquater ">Additional Office Address '+i+'</div>';                       
        adtnl_add += '<div class="addForm text-black" id="addForm">'; 

        adtnl_add += '<input type="hidden" name="id[]" value="'+i+'">';
        adtnl_add += '<input type="hidden" name="action[]" value="insert">';
        adtnl_add += '<input type="hidden" name="is_head_office[]" value="0"/>';

        adtnl_add += '   <div class="form-group">';
        adtnl_add += '       <label for="country">Country</label><strong style="color: red;"> *</strong>';
        adtnl_add += '       <select class="form-control rmvId" id="country'+i+'" name="country_iso2[]" onchange="selectCountry('+i+')" required="required">';
        adtnl_add += '           <option value="">Select Country</option>';
        
        adtnl_add += "           {!! $country_option_html !!}";

        adtnl_add += '       </select>';
        adtnl_add += '       <div class="invalid-feedback country rmvCls"></div>';
        adtnl_add += '   </div>';

        adtnl_add += '   <div class="form-group">';
        adtnl_add += '       <label for="state">State</label><strong style="color: red;"> *</strong>';
        adtnl_add += '       <select class="form-control rmvId" id="state'+i+'" name="state_iso2[]" onchange="selectState('+i+')" required="required">';

        adtnl_add += '           <option value="">Select State</option>'
        adtnl_add += '       </select>';
        adtnl_add += '       <div class="invalid-feedback state rmvCls"></div>';
        adtnl_add += '   </div>';

        adtnl_add += '   <div class="form-group">';
        adtnl_add += '       <label for="city">City</label><strong style="color: red;"> *</strong>';
        adtnl_add += '       <select class="form-control rmvId" id="city'+i+'" name="city[]" required="required">';
        adtnl_add += '            <option value="">Select City</option>';
        adtnl_add += '       </select>';
        adtnl_add += '       <div class="invalid-feedback city rmvCls"></div>';
        adtnl_add += '   </div>';

        adtnl_add += '   <div class="form-group">';
        adtnl_add += '       <label for="zip">Zip</label>';
        adtnl_add += '       <input type="text" class="form-control rmvId" id="zip'+i+'" name="zip[]">';
        adtnl_add += '       <div class="invalid-feedback zip rmvCls"></div>';
        adtnl_add += '   </div>';

        adtnl_add += '   <div class="form-group">';
        adtnl_add += '       <label for="address">Address</label><strong style="color: red;"> *</strong>';
        adtnl_add += '       <input type="text" class="form-control rmvId" id="address'+i+'" name="address[]" required="required">';
        adtnl_add += '       <div class="invalid-feedback address rmvCls"></div>';
        adtnl_add += '   </div>';
   
        adtnl_add += ' </div>';

        adtnl_add += ' <div class="addForm text-black" id="addEmail">';
        adtnl_add += ' <div class="form-group">';
        adtnl_add += '    <label for="email">Email</label><strong style="color: red;"> *</strong>';
        adtnl_add += '    <input type="text" class="form-control rmvId" id="email'+i+'" name="email[]" required="required">';
        adtnl_add += '    <div class="invalid-feedback email rmvCls"></div>';
        adtnl_add += ' </div>';
        adtnl_add += ' <div class="form-group">';
        adtnl_add += '    <label for="mobile">Contact No</label><strong style="color: red;"> *</strong>';
        adtnl_add += '    <input type="text" class="form-control rmvId" id="mobile'+i+'" name="mobile[]" required="required">';
        adtnl_add += '    <div class="invalid-feedback mobile rmvCls"></div>';
        adtnl_add += ' </div>'; 
        adtnl_add += '</div>';

        adtnl_add += '</div>'; 
        adtnl_add += '</div>';

        i = i+1;

        $('#addAddressAdditional').append( adtnl_add ); 

    });
});

</script>

<script type="text/javascript"> 

    var selectCountry;
    var selectState;

    $(document).ready( function () 
    {
        selectCountry = function ( idd ){

            var country_code = $('#country'+idd).val();
    
            $( "#state" + idd ).html('');
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
            var state_code   = $('#state'+idd).val();
            var country_code = $('#country'+idd).val();

            $("#city"+idd).html('');
            $.ajax({
                url:"{{url('get-cities-by-state')}}",
                type: "POST",
                data: {
                    country_code: country_code,
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
</script>
@endsection
