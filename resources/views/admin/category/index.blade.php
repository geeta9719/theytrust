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
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">CATEGORIES</h3>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle text-nowrap">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Page Heading</th>
                                        <th>Meta Title</th>
                                        {{-- <th>Meta Description</th> --}}
                                        {{-- <th>Title Type</th> --}}
                                        {{-- <th>Description</th> --}}
                                        <th>Top</th>
                                        {{-- <th>Created</th> --}}
                                        {{-- <th>Updated</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category as $i => $cat)
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td>{{ $cat->category }}</td>
                                            <td>{{ $cat->slug }}</td>
                                            <td>{{ $cat->page_heading }}</td>
                                            <td>{{ $cat->meta_title }}</td>
                                            {{-- <td>{{ Str::limit($cat->meta_description, 60) }}</td> --}}
                                            {{-- <td>{{ $cat->title_type }}</td> --}}
                                            {{-- <td>{{ Str::limit($cat->description, 50) }}</td> --}}
                                            <td class="text-center">
                                                <input type="checkbox" class="top_cat" id="top_cat_{{ $cat->id }}"
                                                    onclick="setPriority({{ $cat->id }})"
                                                    {{ $cat->top_cat ? 'checked' : '' }}>
                                            </td>
                                            {{-- <td>{{ optional($cat->created_at)->format('Y-m-d') }}</td> --}}
                                            {{-- <td>{{ optional($cat->updated_at)->format('Y-m-d') }}</td> --}}
                                            <td>
                                                <a href="{{ route('admin.category.edit', $cat) }}" class="btn btn-sm btn-outline-primary mb-1">Edit</a>
                                                <form method="post" action="{{ route('admin.category.destroy', $cat) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center text-muted">No records found.</td>
                                        </tr>
                                    @endforelse
                        
                                    @if ($category->hasPages())
                                        <tr>
                                            <td colspan="12" class="text-center">
                                                {!! $category->links() !!}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var setPriority;
    jQuery(document).ready(function () {
        setPriority = function (id) {
            var isChecked = $('#top_cat_' + id).is(':checked');
            var value = isChecked ? 1 : 0;
            var msg = isChecked ? 'Added to top Category list' : 'Removed from top Category list';

            $.ajax({
                url: '{{ url('admin/category/set-priority') }}',
                type: 'POST',
                data: {
                    id: id,
                    top_cat: value,
                    _token: '{{ csrf_token() }}'
                },
                success: function (result) {
                    $('#msg').html('<div class="alert alert-success">' + msg + '</div>');
                    $('html, body').animate({ scrollTop: 0 });
                }
            });
        };
    });
</script>
@endsection
