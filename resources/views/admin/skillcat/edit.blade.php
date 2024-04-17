@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <h1>Edit Skill Category</h1>
        @if(Session::has('msg'))
            <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif

        <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="subcat_child_id">Subcategory Child:</label>
                <select name="subcat_child_id" id="subcat_child_id" class="form-control">
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $skill->subcat_child_id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('subcat_child_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $skill->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection










{{-- @extends('layouts.admin-master')

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
                            <h3 class="card-title">SKILL</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.skills.index')}}" class="btn btn-sm btn-primary"> Show </a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <!-- update record here -->
                            <div class="col-md-8 editRec" style="margin:0 auto; margin-top:20px; " id="editRec">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header" >
                                        <h3 class="card-title" >Update Category</h3>
                                    </div>

                                    <h1>Edit Skill</h1>
                                    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="subcat_child_id">Subcategory Child ID:</label>
                                           
                                            <select name="subcat_child_id" id="subcat_child_id" class="form-control">
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $skill->subcat_child_id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            @error('subcat_child_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Skill:</label>
                                            <input type="text" name="skill" id="skill" class="form-control" value="{{ $skill->name }}">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>


                                    <!-- form start -->
                                    {{-- <form role="form" action="{{route('admin.subcategory-child.update',$subcategorychild)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="subcategory_id">Subcategory</label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                    <option value="">Select Business</option>
                                                    @foreach($subcategory as $c)
                                                        <?php
                                                        if($c->id == $subcategorychild->subcategory_id){
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        } 
                                                        ?> 
                                                        <option value="{{$c->id}}"  {{$selected}}>{{$c->subcategory}}</option>
                                                    @endforeach    
                                                </select>
                                                @error('subcategory_id')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name">Subcategory Child</label>
                                                <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{$subcategorychild->name}}">
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="update" class="btn btn-sm btn-primary" style="float:right;">Update</button>
                                        </div>
                                    </form> --}}
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



@section('script')
<script>

</script>
@endsection