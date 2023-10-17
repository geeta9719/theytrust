@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Notification boxes -->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="col-md-4" id="msg" style="margin:0 auto;text-align:center">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                    @endif   
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">EDIT USER</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.users.list')}}" class="btn btn-sm btn-primary"> Show All Users </a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <!-- update record here -->
                            <div class="col-md-8 editRec" style="margin:0 auto; margin-top:20px;" id="editUser">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update User</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" action="{{route('admin.user.update', $user)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="first_name" name="first_name" value="{{$user->first_name}}">
                                                @error('first_name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="last_name" name="last_name" value="{{$user->last_name}}">
                                                @error('last_name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" value="{{$user->email}}">
                                                @error('email')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                             <!-- Mobile Field -->
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" class="form-control {{$errors->has('mobile') ? 'is-invalid' : ''}}" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}">
        @error('mobile')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <input type="text" class="form-control {{$errors->has('company') ? 'is-invalid' : ''}}" id="company" name="company" value="{{ old('company', $user->company) }}">
        @error('company')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="bio">Bio</label>
        <textarea class="form-control {{$errors->has('bio') ? 'is-invalid' : ''}}" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" class="form-control-file" id="image" name="image">
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="update" class="btn btn-sm btn-primary" style="float:right;">Update</button>
                                        </div>
                                    </form>
                                </div>
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
<script>

</script>
@endsection
