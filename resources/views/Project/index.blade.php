@php
    $company = \App\Models\Company::where('user_id', auth()->user()->id)->first();
@endphp
@extends($company ? 'layouts.home-master' : 'layouts.home')

@section('content')

<div class="container" style="margin-top: 15px;">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Company Project</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('Projects.create') }}">Create New Company Project</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card"> <!-- Wrap everything inside a card -->
    <div class="card-body">
        <div class="table-responsive"> <!-- Wrap the table inside a responsive container -->
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Project Size</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Uploaded Image</th>
                    <th>YouTube Video</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($Projects as $Project)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $Project->title }}</td>
                    <td>{{ $Project->project_size }}</td>
                    <td>{{ $Project->description }}</td>
                    <td><img src="{{ asset('storage/' . $Project->thumbnail_image) }}" alt="Thumbnail" width="100"></td>
                    <td><img src="{{ asset('storage/' . $Project->uploaded_image) }}" alt="Uploaded Image" width="100"></td>
                    
                    <td>
                        @if($Project->youtube_video)
                            <iframe width="200" height="150" src="{{ $Project->youtube_video }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            No video available
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('Projects.destroy',$Project->id) }}" method="Post">
                            <a class="btn btn-info" href="{{ route('Projects.show',$Project->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('Projects.edit',$Project->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div> <!-- End of table-responsive -->
    </div>
</div> <!-- End of card -->
</div> <!-- End of card -->

{!! $Projects->links() !!}

@endsection