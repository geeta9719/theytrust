@extends('layouts.admin-master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet" />


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

                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">SUBCATEGORY</h3>
                        <a href="{{ route('admin.subcategory.index') }}" class="btn btn-sm btn-primary">Show</a>
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 mx-auto" id="addNew">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Subcategory</h3>
                                </div>

                                <form action="{{ route('admin.subcategory.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}">{{ $c->category }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="subcategory">Subcategory Name</label>
                                            <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="Subcategory" />
                                            @error('subcategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Auto-generated (category/subcategory)" />
                                        </div>

                                        <div class="form-group">
                                            <label for="title_type">Title Type</label>
                                            <select class="form-control" id="title_type" name="title_type">
                                                <option value="Agencies">Agencies</option>
                                                <option value="Companies">Companies</option>
                                                <option value="Experts">Experts</option>
                                                <option value="Designers">Designers</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="page_heading">Page Main Heading (H1 Tag)</label>
                                            <input type="text" class="form-control" id="page_heading" name="page_heading" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="card-footer text-right">
                                        <button type="submit" name="create" class="btn btn-primary">Create</button>
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
    document.getElementById("subcategory").addEventListener("input", generateFullSlug);
    document.getElementById("title_type").addEventListener("change", generateFullSlug);
    document.getElementById("category_id").addEventListener("change", generateFullSlug);

    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-');
    }

    function generateFullSlug() {
        const categorySelect = document.getElementById("category_id");
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const categoryText = selectedOption.text || '';
        const subcategoryText = document.getElementById("subcategory").value.trim();
        const type = document.getElementById("title_type").value;

        if (categoryText && subcategoryText) {
            const categorySlug = generateSlug(categoryText);
            const subcategorySlug = generateSlug(subcategoryText);
            const fullSlug = `${categorySlug}/${subcategorySlug}`;

            document.getElementById("slug").value = fullSlug;
            document.getElementById("page_heading").value = `Top ${subcategoryText} ${type}`;
            document.getElementById("meta_title").value = `Top ${subcategoryText} ${type}  '{month-year}' Rankings| They Trust Us`;
            document.getElementById("meta_description").value = `Explore the best ${subcategoryText.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;
        }
    }
</script>
@endsection
