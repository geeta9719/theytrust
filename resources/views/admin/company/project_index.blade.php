@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')

@section('content')

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                
                    <p> @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                        @endif
                    </p>
                    <h1>All Company Projects</h1>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal">
                        Add New Project
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="formbox container">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <div class="row">
                    @foreach ($projects as $project)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Edit button -->
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Edit</a>
                                    
                                    <h5 class="card-title">Project  Name:{{ $project->title }}</h5>
                                    <p class="card-text">Project Size: {{ $project->project_size }}</p>
                                    <p class="card-text">Description : {{ $project->description }}</p>
                                    @if($project->uploaded_image)
                                        <img src="{{ $project->uploaded_image }}" class="card-img-top" alt="Uploaded Image">
                                    @endif
                                    @if($project->youtube_video)
                                        <iframe width="100%" height="200" src="{{ $project->youtube_video }}" frameborder="0" allowfullscreen></iframe>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for adding a new project -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Add form fields for new project here -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <input type="file" class="form-control-file" id="thumbnail_image" name="thumbnail_image">
                            </div>
                            @error('thumbnail_image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                            
                         
                            <div class="form-group">
                                <label for="category">Services</label>
                                <select class="form-control" id="category" name="services_id"required>
                                    <option value="">Select Category</option> <!-- Optional default option -->
                                    @foreach($categories as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="project_size">Project Size</label>
                                <input type="text" class="form-control" id="project_size" name="project_size" required>
                                @error('project_size')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                                
                            </div>
                            <div class="form-group">
                                <label for="uploaded_image">Uploaded Image</label>
                                <input type="file" class="form-control-file" id="uploaded_image" name="uploaded_image">
                                @error('uploaded_image')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                                
                            </div>
                            <div class="form-group">
                                <label for="youtube_video">YouTube Video</label>
                                <input type="text" class="form-control" id="youtube_video" name="youtube_video">

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
