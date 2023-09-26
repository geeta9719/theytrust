@extends('layouts.admin-master')

@section('content')

    <?php 
    //print_r($errors); 
    //print_r($service);
    $errors->count();
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="col-md-4" id="msg" style="margin:0 auto;text-allign:center">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                    @endif   
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">BNI Member</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.member.index')}}" class="btn btn-sm btn-primary"> Show </a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <!-- update record here -->
                            <div class="col-md-8 editRec" style="margin:0 auto; margin-top:20px; " id="editRec">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" >
                                        <h3 class="card-title" >Update Record</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" action="{{route('admin.member.update',$member)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <input type="text" class="form-control {{$errors->has('fname') ? 'is-invalid' : ''}}" id="fname" name="fname" value="{{$member->fname}}">
                                                @error('fname')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input type="text" class="form-control {{$errors->has('lname') ? 'is-invalid' : ''}}" id="lname" name="lname" value="{{$member->lname}}">
                                                @error('lname')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" class="form-control {{$errors->has('mobile') ? 'is-invalid' : ''}}" id="mobile" name="mobile" value="{{$member->mobile}}">
                                                @error('mobile')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" value="{{$member->email}}">
                                                @error('email')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="chapter">Chapter</label>
                                                <input type="text" class="form-control {{$errors->has('chapter') ? 'is-invalid' : ''}}" id="chapter" name="chapter" value="{{$member->chapter}}">
                                                @error('chapter')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <input type="text" class="form-control {{$errors->has('region') ? 'is-invalid' : ''}}" id="region" name="region" value="{{$member->region}}">
                                                @error('region')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control {{$errors->has('country') ? 'is-invalid' : ''}}" id="country" name="country" value="{{$member->country}}">
                                                @error('country')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
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