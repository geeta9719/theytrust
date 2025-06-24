@extends('layouts.admin-master')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">

                <!-- Message Box -->
                <div class="col-md-6 mx-auto text-center">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @elseif (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                </div>

                <div class="card shadow-sm p-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Add New Category</h3>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                    </div>

                    <div class="col-md-8 mx-auto mt-3">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="category"><strong>1.</strong> Category Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="category" name="category" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title_type"><strong>2.</strong> Category Type</label>
                                    <select class="form-control" id="title_type" name="title_type">
                                        <option value="Agencies">Agencies</option>
                                        <option value="Companies">Companies</option>
                                        <option value="Experts">Experts</option>
                                        <option value="Designers">Designers</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="page_heading"><strong>3.</strong> Page Main Heading (H1 Tag)</label>
                                    <input type="text" class="form-control bg-light" id="page_heading" name="page_heading" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="slug"><strong>4.</strong> Slug <span class="badge bg-info text-dark">Auto-generated (editable)</span></label>
                                    <input type="text" class="form-control bg-white" id="slug" name="slug">
                                    <small id="slugHint" class="form-text text-warning d-none">You manually changed the slug.</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_title"><strong>5.</strong> Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_description"><strong>6.</strong> Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description"><strong>7.</strong> Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    </div>

                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    let manualSlug = false;

    function generateSlug(text) {
        return text.toLowerCase().trim().replace(/[\s\W-]+/g, '-').replace(/^-+|-+$/g, '');
    }

    function updateFields() {
        const category = document.getElementById("category").value.trim();
        const type = document.getElementById("title_type").value;

        if (category) {
            const heading = `Top ${category} ${type}`;
            const slug = generateSlug(category);
            const metaTitle = `Top ${category} ${type} | They Trust Us`;
            const metaDesc = `Explore the best ${category.toLowerCase()} ${type.toLowerCase()} recommended by experts.`;

            document.getElementById("page_heading").value = heading;

            if (!manualSlug) {
                document.getElementById("slug").value = slug;
                document.getElementById("slugHint").classList.add("d-none");
            }

            document.getElementById("meta_title").value = metaTitle;
            document.getElementById("meta_description").value = metaDesc;
        }
    }

    document.getElementById("category").addEventListener("input", updateFields);
    document.getElementById("title_type").addEventListener("change", updateFields);
    document.getElementById("slug").addEventListener("input", () => {
        manualSlug = true;
        document.getElementById("slugHint").classList.remove("d-none");
    });
</script>
@endsection
