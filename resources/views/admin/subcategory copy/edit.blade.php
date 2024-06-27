@extends('layouts.admin-master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

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
                            <h3 class="card-title">SUBCATEGORY</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.subcategory.index')}}" class="btn btn-sm btn-primary"> Show </a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <!-- update record here -->
                            <div class="col-md-8 editRec" style="margin:0 auto; margin-top:20px; " id="editRec">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" >
                                        <h3 class="card-title" >Update Subcategory</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" action="{{route('admin.subcategory.update',$subcategory)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="category_id"> Parent Category</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="">Select Business</option>
                                                    @foreach($category as $c)
                                                      <?php
                                                        if($c->id == $subcategory->category_id){
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        } 
                                                      ?> 
                                                    <option value="{{$c->id}}"  {{$selected}}>{{$c->category}}</option>
                                                    @endforeach    
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="subcategory">Subcategory</label>
                                                <input type="text" class="form-control {{$errors->has('subcategory') ? 'is-invalid' : ''}}" id="subcategory" name="subcategory" value="{{$subcategory->subcategory}}">
                                                @error('subcategory')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description" rows="5">{{$subcategory->description ?? ''}}</textarea>
                                                @error('description')
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
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
   

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