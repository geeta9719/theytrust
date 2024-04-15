@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
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
                            <h3 class="card-title">SUBCATEGORY CHILD </h3>
                            <span style="float:right;">
                                <a href="{{route('admin.subcategory-child.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Subcategory</th>
                                        <th>Name</th>
                                        <th>status</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($subcategorychild->count() > 0)
                                   
                                    @foreach($subcategorychild as $aboutdirector)
  
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ optional($aboutdirector->subcategory)->subcategory }}
                                    </td>
    
                                    
                                        <td>{{$aboutdirector->name}}</td>
                                        <td>{{$aboutdirector->status}}</td>
                                        <td>{{$aboutdirector->created_at}}</td>
                                        <td>{{$aboutdirector->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.subcategory-child.edit',$aboutdirector)}}" class="btn btn-sm btn-primary" >Edit</a>
                                            <form method="post" action="{{route('admin.subcategory-child.destroy',$aboutdirector)}}" id="sdel">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr><td colspan="11" style="text-align:center">{!! $subcategorychild->links() !!}</td></tr>
                                @else
                                    <tr>
                                        <td colspan="11" style="text-align:center">No Record Found</td>
                                    </tr>    
                                @endif    
                                </tbody>
                                <!--<tfoot>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                </tfoot>-->
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