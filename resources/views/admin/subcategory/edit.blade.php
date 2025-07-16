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
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">SUBCATEGORY</h3>
                        <a href="{{ route('admin.subcategory.index') }}" class="btn btn-sm btn-primary">Show</a>
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 mx-auto" id="editRec">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Update Subcategory</h3>
                                </div>

                                <form action="{{ route('admin.subcategory.update', $subcategory) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="category_id">Parent Category</label>
                                            <select name="category_id" id="subcategory_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}" {{ $subcategory->category_id == $c->id ? 'selected' : '' }}>
                                                        {{ $c->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="subcategory">Subcategory</label>
                                            <input type="text" class="form-control" id="name" name="subcategory" value="{{ $subcategory->subcategory }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $subcategory->slug }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="title_type">Title Type</label>
                                            <select class="form-control" id="title_type" name="title_type">
                                                <option value="Agencies" {{ $subcategory->title_type == 'Agencies' ? 'selected' : '' }}>Agencies</option>
                                                <option value="Companies" {{ $subcategory->title_type == 'Companies' ? 'selected' : '' }}>Companies</option>
                                                <option value="Experts" {{ $subcategory->title_type == 'Experts' ? 'selected' : '' }}>Experts</option>
                                                <option value="Designers" {{ $subcategory->title_type == 'Designers' ? 'selected' : '' }}>Designers</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="page_heading">Page Main Heading (H1 Tag)</label>
                                            <input type="text" class="form-control" id="page_heading" name="page_heading" value="{{ $subcategory->page_heading }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $subcategory->meta_title }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ $subcategory->meta_description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4">{{ $subcategory->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
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
    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-').replace(/^-+|-+$/g, '');
    }

    function generateFullSlug() {
        const name = document.getElementById("name").value.trim();
        const subcatDropdown = document.getElementById("subcategory_id");
        const selectedOption = subcatDropdown.options[subcatDropdown.selectedIndex];
        const subcatText = selectedOption && selectedOption.text ? selectedOption.text.trim() : '';
        const type = document.getElementById("title_type").value;

        if (subcatText && name) {
            const subcatSlug = generateSlug(subcatText);
            const nameSlug = generateSlug(name);
            const fullSlug = `/${nameSlug}`;

            document.getElementById("slug").value = fullSlug;
            document.getElementById("page_heading").value = `Top ${name} ${type}`;
            document.getElementById("meta_title").value = `Top ${name} ${type} - '{month-year}' Rankings | They Trust Us`;
            document.getElementById("meta_description").value = `Explore the best ${name.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const nameInput = document.getElementById("name");
        const subcatDropdown = document.getElementById("subcategory_id");

        if (nameInput && subcatDropdown) {
            nameInput.addEventListener("input", generateFullSlug);
            subcatDropdown.addEventListener("change", generateFullSlug);
        }
    });
</script>
@endsection
