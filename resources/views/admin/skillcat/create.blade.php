@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6"> <!-- Adjust the column width as needed -->
                <h1>Create Skill Category</h1>
            </div>
            <div class="col-md-6 text-right"> <!-- Adjust the column width and alignment as needed -->
                <a href="{{ route('admin.skills.index') }}" class="btn btn-primary">Show</a>
            </div>
        </div>

        @if(Session::has('msg'))
            <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif

        <form action="{{ route('admin.skills.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="subcat_child_id">Subcategory Child:</label>
                <select name="subcat_child_id" id="subcat_child_id" class="form-control">
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
                @error('subcat_child_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('script')
<script>
    // Any custom JavaScript can go here
</script>
@endsection
