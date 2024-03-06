@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')

@section('content')
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Projects.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $Project->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Thumbnail Image:</strong>
                @if($Project->thumbnail_image)
                <img src="{{ asset('storage/' . $Project->thumbnail_image) }}" alt="Thumbnail Image" style="max-width: 200px;">

                @else
                    <p>No thumbnail image</p>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Uploaded Image:</strong>
                @if($Project->uploaded_image)
                    <img src="{{    'storage/' . asset($Project->uploaded_image) }}" alt="Uploaded Image" style="max-width: 200px;">
                @else
                    <p>No uploaded image</p>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>YouTube Video:</strong>
                @if($Project->youtube_video)
                    <iframe width="560" height="315" src="{{ $Project->youtube_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    No YouTube video provided
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $Project->description ?: 'No description provided' }}
            </div>
        </div>
    </div>
</div>
@endsection
