@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Edit Skill Category</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.skills.index') }}" class="btn btn-primary">Show</a>
        </div>
    </div>

    @if(Session::has('msg'))
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif

    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="subcat_child_id">Subcategory Child:</label>
            <select name="subcat_child_id" id="subcat_child_id" class="form-control">
                <option value="">Select Subcategory Child</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $skill->subcat_child_id ? 'selected' : '' }}>
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </select>
            @error('subcat_child_id')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Skill Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $skill->name) }}">
            @error('name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $skill->slug) }}">
        </div>

        <div class="form-group">
            <label for="page_heading">Page Heading (H1):</label>
            <input type="text" name="page_heading" id="page_heading" class="form-control" value="{{ old('page_heading', $skill->page_heading) }}">
        </div>

        <div class="form-group">
            <label for="meta_title">Meta Title:</label>
            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $skill->meta_title) }}">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description:</label>
            <textarea name="meta_description" id="meta_description" rows="2" class="form-control">{{ old('meta_description', $skill->meta_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $skill->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    document.getElementById("name").addEventListener("input", generateSlugFields);
    document.getElementById("subcat_child_id").addEventListener("change", generateSlugFields);

    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-');
    }

    function generateSlugFields() {
        const name = document.getElementById("name").value.trim();
        const dropdown = document.getElementById("subcat_child_id");
        const selectedText = dropdown.options[dropdown.selectedIndex]?.text || '';

        if (name && selectedText) {
            const finalSlug = `/${generateSlug(name)}`;
            document.getElementById("slug").value = finalSlug;
            document.getElementById("page_heading").value = `Top ${name}`;
            document.getElementById("meta_title").value = `Top ${name}  '{month-year}' Rankings| They Trust Us`;
            document.getElementById("meta_description").value = `Discover top ${name.toLowerCase()} experts recommended in the industry.`;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            generateSlugFields();
        }, 100);
    });
</script>
@endsection
