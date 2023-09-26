@extends('layouts.admin-master')

@section('content')

    <?php 
    //print_r($errors); 
    $errors->count();
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="col-md-4" id="msg" style="margin:0 auto;text-align:center;">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                    @endif   

                    @error('file')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Business Detail</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.business.index')}}" class="btn btn-sm btn-primary" > Show </a>
                            </span>
                        </div>                        

                        <!--Add new data start here-->
                        <div class="col-md-8 addNew" style="margin:0 auto; margin-top:20px;;" id="addNew">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header" >
                                    <h3 class="card-title" >Add Business Detail</h3>
                                </div>                                
                                <!-- form start -->
                                <form role="form" name="add" id="add" action="{{route('admin.business.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Business Name</label>
                                            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Business Name">
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" placeholder="Email">
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control {{$errors->has('mobile') ? 'is-invalid' : ''}}" id="mobile" name="mobile" placeholder="Mobile">
                                            @error('mobile')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="address" name="address" placeholder="Address">
                                            @error('address')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select name="country" id="country-dd" class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach($country as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach    
                                            </select>
                                            @error('country')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select name="state" id="state-dd" class="form-control"></select>
                                            @error('state')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select name="city" id="city-dd" class="form-control"></select>
                                            @error('city')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="gst">GST</label>
                                            <input type="text" class="form-control {{$errors->has('gst') ? 'is-invalid' : ''}}" id="gst" name="gst" placeholder="GST">
                                            @error('gst')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input type="text" class="form-control {{$errors->has('website') ? 'is-invalid' : ''}}" id="website" name="website" placeholder="Website">
                                            @error('website')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="create" class="btn btn-sm btn-primary" style="float:right;">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('/admin/business/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('/admin/business/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });

    </script>
@endsection