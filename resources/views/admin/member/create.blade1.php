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
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">UPDATE CSV FILE</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.member.index')}}" class="btn btn-sm btn-primary" > Show </a>
                            </span>
                        </div>                        

                        <!--Add new data start here-->
                        <div class="col-md-8 addNew" style="margin:0 auto; margin-top:20px;;" id="addNew">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header" >
                                    <h3 class="card-title" >Upload CSV File</h3>
                                </div>                                
                                <!-- form start -->
                                <!--<form role="form" name="add" id="add" action="{{route('admin.member.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="csv">Image</label>
                                            <input type="file" class="form-control-file {{$errors->has('csv') ? 'is-invalid' : ''}}" id="csv" name="csv" >
                                            @error('csv')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="create" class="btn btn-sm btn-primary" style="float:right;">Create</button>
                                    </div>
                                </form>-->
                                
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body ">
                                        <label for="file">CSV File</label>
                                        <input type="file" id="file" name="file" class="form-control-file {{$errors->has('file') ? 'is-invalid' : ''}}" >
                                        @error('file')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-success">Import User Data</button>
                                        <!--<a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>-->
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
<script>
    
</script>
@endsection