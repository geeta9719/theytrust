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
                    <div class="col-md-4" id="msg" style="margin:0 auto;text-align:center">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                    @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                    @endif   
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SERVICE PROVIDER</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.service-provider.index')}}" class="btn btn-sm btn-primary"> Show </a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <!-- update record here -->
                            <div class="col-md-8 editRec" style="margin:0 auto; margin-top:20px;" id="editRec">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Service Provider</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" action="{{route('admin.service-provider.update', $serviceProvider)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{$serviceProvider->name ?? ''}}">
                                                @error('name')
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