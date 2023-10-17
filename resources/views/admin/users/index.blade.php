@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="col-md-4" id="msg" style="margin:0 auto;text-align:center">
                        @if(Session::has('message'))
                            <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                            <div class="alert alert-success">{{session('msg')}}</div>
                        @endif   
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">USERS</h3>
                           
                        </div>   

                        <!-- Search functionality -->
                        <div class="card-body">
                            <input type="text" id="searchInput" placeholder="Search users..." />
                            <button id="searchButton" class="btn btn-sm btn-primary">Search</button>
                        </div>
                        
                        <div class="card-body table-responsive p-0">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Image</th>
                                        <th>Company</th>
                                        <th>Bio</th>
                                        <th>Twitter</th>
                                        <th>Linkedin</th>
                                        <th>User Type</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.users.partial-table')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        var searchTerm = document.getElementById('searchInput').value;

        fetch(`/admin/users/list?search=${searchTerm}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            // Ensure the content type of the response is text/html
            if (response.headers.get("content-type")?.indexOf("text/html") !== -1) {
                return response.text();
            }
            throw new TypeError("Oops, we haven't got text/html!");
        })
        .then(data => {
            document.querySelector('#example3 tbody').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });
</script>

@endsection
