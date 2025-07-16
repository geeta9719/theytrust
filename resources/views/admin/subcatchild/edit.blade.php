@extends('layouts.admin-master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="col-md-4 mx-auto text-center" id="msg">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @elseif (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Update Sub Child Category</h3>
                        <a href="{{ route('admin.subcategory-child.show') }}" class="btn btn-sm btn-primary">Show</a>
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Sub Child Category</h3>
                                </div>

                                <form action="{{ route('admin.subcategory-child.update', $subcategorychild) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                <option value="">Select Sub Category</option>
                                                @foreach ($subcategory as $c)
                                                    <option value="{{ $c->id }}" {{ $subcategorychild->subcategory_id == $c->id ? 'selected' : '' }}>
                                                        {{ $c->subcategory }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Subcategory Child</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $subcategorychild->name }}" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $subcategorychild->slug }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="title_type">Title Type</label>
                                            <select class="form-control" id="title_type" name="title_type">
                                                @foreach(['Agencies', 'Companies', 'Experts', 'Designers'] as $type)
                                                    <option value="{{ $type }}" {{ $subcategorychild->title_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="page_heading">Page Main Heading (H1 Tag)</label>
                                            <input type="text" class="form-control" id="page_heading" name="page_heading" value="{{ $subcategorychild->page_heading }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $subcategorychild->meta_title }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ $subcategorychild->meta_description }}</textarea>
                                        </div>

                                

                                    </div>

                                    <div class="card-footer text-right">
                                        <button type="submit"  class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.getElementById("name").addEventListener("input", generateFullSlug);
    document.getElementById("subcategory_id").addEventListener("change", generateFullSlug);
    document.getElementById("title_type").addEventListener("change", generateFullSlug);

    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-');
    }

    function generateFullSlug() {
        const name = document.getElementById("name").value.trim();
        const subcatDropdown = document.getElementById("subcategory_id");
        const subcatText = subcatDropdown.options[subcatDropdown.selectedIndex]?.text || '';
        const type = document.getElementById("title_type").value;

        if (subcatText && name) {
            const subcatSlug = generateSlug(subcatText);
            const nameSlug = generateSlug(name);
            const fullSlug = `/${nameSlug}`;

            document.getElementById("slug").value = fullSlug;
            document.getElementById("page_heading").value = `Top ${name} ${type}`;
            document.getElementById("meta_title").value = `Top ${name} ${type}   '{month-year}' Rankings  | They Trust Us`;
            document.getElementById("meta_description").value = `Explore the best ${name.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;
        }
    }
</script>
@endsection
