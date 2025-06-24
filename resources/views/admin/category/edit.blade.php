@extends('layouts.admin-master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="col-md-4" id="msg" style="margin: 0 auto; text-align: center">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @elseif (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                        <span style="float: right">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                        </span>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="col-md-8 mx-auto mt-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Update Category</h3>
                                </div>

                                <form action="{{ route('admin.category.update', $category) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="category">Category Name</label>
                                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $category->category) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="title_type">Title Type</label>
                                            <select class="form-control" id="title_type" name="title_type">
                                                <option value="Agencies" {{ $category->title_type == 'Agencies' ? 'selected' : '' }}>Agencies</option>
                                                <option value="Companies" {{ $category->title_type == 'Companies' ? 'selected' : '' }}>Companies</option>
                                                <option value="Experts" {{ $category->title_type == 'Experts' ? 'selected' : '' }}>Experts</option>
                                                <option value="Designers" {{ $category->title_type == 'Designers' ? 'selected' : '' }}>Designers</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="page_heading">Page Heading (H1 Tag)</label>
                                            <input type="text" class="form-control" id="page_heading" name="page_heading" value="{{ old('page_heading', $category->page_heading) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $category->meta_description) }}</textarea>
                                        </div>

                                       

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // Optional: auto-generate page_heading/meta if user changes category name
    document.getElementById("category").addEventListener("input", function () {
        const category = this.value.trim();
        const type = document.getElementById("title_type").value;
        if (category) {
            document.getElementById("page_heading").value = `Top ${category} ${type}`;
            document.getElementById("meta_title").value = `Top ${category} ${type} | They Trust Us`;
            document.getElementById("meta_description").value = `Explore the best ${category.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;
            document.getElementById("slug").value = category.toLowerCase().replace(/[\s\W-]+/g, '-');
        }
    });

    document.getElementById("title_type").addEventListener("change", function () {
        document.getElementById("category").dispatchEvent(new Event('input'));
    });
</script>
@endsection
