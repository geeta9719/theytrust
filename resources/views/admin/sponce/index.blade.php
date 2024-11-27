@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
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
                            <h3 class="card-title">SPONCES</h3>
                        </div>

                        <!-- Search functionality -->
                        <div class="card-body">
                            <input type="text" id="searchInput" placeholder="Search by User or Company..." />
                            <button id="searchButton" class="btn btn-sm btn-primary">Search</button>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Category</th>
                                        <th>Plan</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sponces as $sponce)
                                        <tr>
                                            <td>{{ $sponce->id }}</td>
                                            <td>{{ $sponce->user->name ?? 'N/A' }}</td>
                                            <td>{{ $sponce->company->name ?? 'N/A' }}</td>
                                            <td>
                                                {{ $sponce->location->name ?? 'N/A' }}
                                                ({{ class_basename($sponce->location_type_model) }})
                                            </td>
                                            <td>
                                                {{ $sponce->category->name ?? 'N/A' }}
                                                ({{ class_basename($sponce->category_type_model) }})
                                            </td>
                                            <td>{{ $sponce->planSubscription->name ?? 'N/A' }}</td>
                                            <td>{{ $sponce->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination links -->
                        <div class="card-footer">
                            <div class="pagination justify-content-center">
                                {!! $sponces->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // document.getElementById('searchButton').addEventListener('click', function() {
        //     performSearch();
        // });

        // // Add event listener for changes in the search input
        // document.getElementById('searchInput').addEventListener('input', function() {
        //     performSearch();
        // });

        // function performSearch() {
        //     var searchTerm = document.getElementById('searchInput').value.trim();

        //     if (searchTerm !== '') {
        //         fetch(`/admin/sponce/list?search=${searchTerm}`, {
        //             headers: {
        //                 'X-Requested-With': 'XMLHttpRequest'
        //             }
        //         })
        //         .then(response => {
        //             if (response.headers.get("content-type")?.indexOf("text/html") !== -1) {
        //                 return response.text();
        //             }
        //             throw new TypeError("Oops, we haven't got text/html!");
        //         })
        //         .then(data => {
        //             document.querySelector('#example3 tbody').innerHTML = data;
        //         })
        //         .catch(error => console.error('Error:', error));
        //     } else {
        //         window.location.reload();
        //     }
        // }
    </script>
@endsection
