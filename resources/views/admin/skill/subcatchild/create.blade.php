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

                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Add New Sub Child Category</h3>
                        <a href="{{ route('admin.subcategory-child.show') }}" class="btn btn-sm btn-primary">Show</a>
                    </div>

                    <div class="card-body">
                        <div class="col-md-8 mx-auto" id="addNew">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Create Sub Child Category</h3>
                                </div>

                                <form action="{{ route('admin.subcategory-child.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control {{ $errors->has('subcategory_id') ? 'is-invalid' : '' }}">
                                                <option value="">Select Sub Category</option>
                                                @foreach ($subcategory as $c)
                                                    <option value="{{ $c->id }}">{{ $c->subcategory }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Subcategory Child</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Subcategory Child" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Auto-generated" />
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
    document.getElementById("name").addEventListener("input", generateFullSlug);
    document.getElementById("subcategory_id").addEventListener("change", generateFullSlug);
    document.getElementById("title_type").addEventListener("change", generateFullSlug);

    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-');
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
            document.getElementById("meta_title").value = `Top ${name} ${type} | They Trust Us`;
            document.getElementById("meta_description").value = `Explore the best ${name.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            generateFullSlug();
        }, 100);
    });
</script>
@endsection
