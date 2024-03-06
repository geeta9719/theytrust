@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')
   
@section('content')
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Projects.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('Projects.update',$Project->id) }}" method="Post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $Project->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Thumbnail Image:</strong>
                    <input type="file" name="thumbnail_image" class="form-control-file">
                    @if($Project->thumbnail_image)
                        <img src="{{ asset($Project->thumbnail_image) }}" alt="Thumbnail Image" style="max-width: 100px; margin-top: 10px;">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Project Size::</strong>
                        <input type="text" name="project_size" value="{{ $Project->project_size }}" class="form-control" placeholder="Title">
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="category">Services</label>
                <select class="form-control" id="category" name="services_id" required>
                    <option value="">Select Category</option> <!-- Optional default option -->
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}" @if($key == $Project->services_id) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Uploaded Image:</strong>
                    <input type="file" name="uploaded_image" class="form-control-file">
                    @if($Project->uploaded_image)
                        <img src="{{ asset($Project->uploaded_image) }}" alt="Uploaded Image" style="max-width: 100px; margin-top: 10px;">
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>YouTube Video:</strong>
                    <input type="text" name="youtube_video" value="{{ $Project->youtube_video }}" class="form-control" placeholder="YouTube Video">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" name="description" rows="3" placeholder="Description">{{ $Project->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
</div>
@endsection
