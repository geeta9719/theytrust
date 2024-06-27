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
                            <h3 class="card-title">Sub Child Category</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.subcategory-child.show')}}" class="btn btn-sm btn-primary" > Show </a>
                            </span>
                        </div>                        

                        <!--Add new data start here-->
                        <div class="col-md-8 addNew" style="margin:0 auto; margin-top:20px;;" id="addNew">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header" >
                                    <h3 class="card-title" >Add New Sub Child Category</h3>
                                </div>                                
                                <!-- form start -->
                                <form role="form" name="add" id="add" action="{{route('admin.subcategory-child.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control {{$errors->has('subcategory_id') ? 'is-invalid':''}}">
                                                <option value="">Select Sub Category</option>
                                                @foreach($subcategory as $c)
                                                    <option value="{{$c->id}}">{{$c->subcategory}}</option>
                                                @endforeach    
                                            </select>
                                            @error('subcategory_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                       
                                        <div class="form-group">
                                            <label for="name">Subcategory Child</label>
                                            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Subcategory Child">
                                            @error('name')
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
<script>
    
</script>
@endsection