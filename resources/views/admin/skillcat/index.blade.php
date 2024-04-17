@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="col-md-4 mx-auto">
                        @if(Session::has('message'))
                            <div class="alert alert-danger text-center">{{ Session::get('message') }}</div>
                        @elseif(session('msg'))
                            <div class="alert alert-success text-center">{{ session('msg') }}</div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SKILL</h3>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <h1 class="text-center mb-3">SKILLS</h1>
                            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary mb-3">Create Skill</a>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subcategory Child ID</th>
                                        <th>Skill</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($skills as $skill)
                                        <tr>
                                            <td>{{ $skill->id }}</td>
                                            {{-- <td>{{ $skill->subcat_child_id }}</td> --}}
                                            <td>{{ $skill->subcat_child->name }}</td>
                                            <td>{{ $skill->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection 

@section('script')
<script>
    function editRec(id){
        $("#"+id).toggle();
    }
</script>
@endsection
