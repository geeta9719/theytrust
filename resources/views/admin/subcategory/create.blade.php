@extends('layouts.admin-master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
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
                            <h3 class="card-title">SUBCATEGORY</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.subcategory.index')}}" class="btn btn-sm btn-primary" > Show </a>
                            </span>
                        </div>                        

                        <!--Add new data start here-->
                        <div class="col-md-8 addNew" style="margin:0 auto; margin-top:20px;;" id="addNew">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header" >
                                    <h3 class="card-title" >Add Subcategory</h3>
                                </div>                                
                                <!-- form start -->
                                <form role="form" name="add" id="add" action="{{route('admin.subcategory.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($category as $c)
                                                    <option value="{{$c->id}}">{{$c->category}}</option>
                                                @endforeach    
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                       
                                        <div class="form-group">
                                            <label for="subcategory">Subcategory</label>
                                            <input type="text" class="form-control {{$errors->has('subcategory') ? 'is-invalid' : ''}}" id="subcategory" name="subcategory" placeholder="Subcategory">
                                            @error('subcategory')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" rows="5"></textarea>
                                            @error('description')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('.date').datepicker({  
       format: 'mm-dd-yyyy'
     });  

    $('.validity').datepicker({  
       format: 'yyyy-mm-dd'
    }); 
     
    $('.redeem_offer').datepicker({  
       format: 'yyyy-mm-dd'
    }); 
</script>
  
@endsection