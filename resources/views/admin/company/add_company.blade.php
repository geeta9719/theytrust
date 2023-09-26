@extends('layouts.admin-master')

@section('content')

<section class="formbox container">
    
    <div class="row  ">
        
        <div class="col-lg-12">

            <div class="col-lg-12  form-size"> 

            <div class="col-md-12 mb-4" id="msg" style="margin:0 auto;text-align:center;">
                
                @if(Session::has('message'))
                    <div class="alert alert-danger">{{Session::get('message')}}</div>

                @elseif(session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
                @endif   

                @error('file')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror


                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                    
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <h4 style="text-align: center;" class="font-weight-bold">Add User for Company</h4>


            <form id="comapany_basic_info" class="" action="{{route('admin.company.save')}}" method="post" enctype="multipart/form-data">
                
                @csrf   

                    <input type="hidden" name="user_id" value="{{ $user ? $user->id : '' }}" />
                    <input type="hidden" name="company_id" value="{{ $company ? $company->id : '' }}" />
                    
                    <div class="form-group">
                            <label for="name">User Email</label><strong style="color: red;"> *</strong>
                            <input type="email" class="form-control" id="u-email" name="user_email" value="{{ $user ? $user->email : '' }}" />
                            <div class="invalid-feedback user_email rmvCls"></div>
                    </div>

                    <div class="form-group">
                            <label for="fname">User First Name</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="user_fname" name="user_fname" value="{{ $user ? $user->first_name : '' }}" />
                            <div class="invalid-feedback user_fname rmvCls"></div>
                    </div>

                    <div class="form-group">
                            <label for="lname">User Last Name</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="user_lname" name="user_lname" value="{{ $user ? $user->last_name : '' }}" />
                            <div class="invalid-feedback user_lname rmvCls"></div>
                    </div>

                    <h4><strong class="card-title" style="font-weight:bold;">Let's get some basic information about company</strong></h4>

                    <div class="pt-4 file-field">

                        @if( $company )
                            <img src='{{ $company->logo }}' width="40" height="40" style="border-radius:25px;">
                        @else
                            <img src="{{asset('front_components/images/logo1.jfif')}}" width="40" height="40" style="border-radius:25px;">
                        @endif
                        

                        <span> Upload Company Logo  </span><strong style="color: red;"> *</strong>
                        <input type="file" class="rmvId" id="logo" name="logo">
                        <div class="invalid-feedback error1 logo rmvCls">Invalid Image Format!</div>
                    </div>

                    <div class="form-group pt-4">
                        <label for="name">Organization Name </label><strong style="color: red;"> *</strong>
                        <input type="text" class="form-control rmvId" id="org_name" name="org_name" value="{{ $company ? $company->name : '' }}"/>
                        <div class="invalid-feedback org_name rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="website">Website or Company URL (eg: https://example.com) </label><strong style="color: red;"> *</strong>
                        <input type="url" class="form-control rmvId" id="website" name="website"value="{{ $company ? $company->website : '' }}"/>
                        <div class="invalid-feedback website rmvCls"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="budget">Project Scale</label>
                        
                        <select class="form-control rmvId" id="budget" name="budget" >
                            <option value="">Select a value</option>
                            @foreach( $budgets as $budget )
                                <option value="{{$budget}}" {{ ( $company &&  $budget == $company->budget ) ? 'selected' : '' }}>{{$budget}}</option>
                            @endforeach

                        </select>

                        <div class="invalid-feedback budget rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="rate">Hourly Rate</label>
                        <select class="form-control rmvId" id="rate" name="rate" >
                            <option value="">Select a value</option>
                            @foreach( $rates as $rate )
                                <option value="{{$rate}}" {{ ( $company &&  $rate == $company->rate ) ? 'selected' : '' }}>{{$rate}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback rate rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="size">Organization Size</label><strong style="color: red;"> *</strong>
                        <select class="form-control rmvId" id="size" name="size" >
                            <option value="">Select a value</option>
    
                            @foreach( $sizes as $size )
                                <option value="{{$size}}" {{ ( $company &&  $size == $company->size ) ? 'selected' : '' }}>{{$size}}</option>
                            @endforeach
                               
                        </select>
                        <div class="invalid-feedback size rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="founded_at">Company Founded</label>
                        <select class="form-control rmvId" id="founded_at" name="founded_at" >
                            <option value="">Select a value</option>
                            <?php for( $i=0; $i <= 49; $i++ ){ $y = date('Y'); ?>    
                                <option value="{{ $y-$i }}" {{ ( $company &&  $y-$i == $company->founded_at ) ? 'selected' : '' }} >{{ $y-$i }}</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback founded_at rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <input type="text" class="form-control rmvId" id="tagline" name="tagline" value="{{ $company ? $company->tagline : '' }}"/>
                        <div class="invalid-feedback tagline rmvCls"></div>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Message</label><strong style="color: red;"> *</strong>
                        <textarea name="short_description" id="short_description" cols="50" rows="5" class="form-control rmvId">{{ $company ? $company->short_description : '' }}</textarea>
                        <div class="invalid-feedback short_description rmvCls"></div>
                    </div>
<div class="d-flex" style="">
                    <button type="submit" class="btn btn-xl mb-5 btn-primary">Add Basic Details</button>

                    @if( $company )
 <a href="{{ route( 'admin.company.location', [ $company->id , $company->user_id ] )}}" class="btn btn-md btn-primary" style="height: 37px; margin-left: 13px;"> > </a>
                    @endif
                            </div>
                </form>
            </div>
        </div>
    </div>
</section> 


<!-- END Section Basic Information -->

@endsection

@section('script')

@endsection