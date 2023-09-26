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
                            <h3 class="card-title">About Bni Member</h3>
                            <span style="float:right;">
                                <!--<a class="btn btn-sm btn-warning" href="{{ route('export') }}">Export BNI Member Data</a>-->
                                <a href="{{route('admin.member.create')}}" class="btn btn-sm btn-primary"> Upload New List</a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Chapter</th>
                                        <th>Region</th>
                                        <th>Country</th>
                                        <th>deleted_at</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($member->count() > 0)
                                    @foreach($member as $aboutdirector)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$aboutdirector->fname}}</td>
                                        <td>{{$aboutdirector->lname}}</td>
                                        <td>{{$aboutdirector->mobile}}</td>
                                        <td>{{$aboutdirector->email}}</td>
                                        <td>{{$aboutdirector->chapter}}</td>
                                        <td>{{$aboutdirector->region}}</td>
                                        <td>{{$aboutdirector->country}}</td>
                                        <td>{{$aboutdirector->deleted_at}}</td>
                                        <td>{{$aboutdirector->created_at}}</td>
                                        <td>{{$aboutdirector->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.member.edit',$aboutdirector)}}" class="btn btn-sm btn-primary mt-2" >Edit</a>
                                            @if($aboutdirector->deleted_at !== NULL)
                                                <a href="{{ route('admin.member.restore',$aboutdirector) }}" class="btn btn-sm btn-success mt-2">Restore</a>
                                            @else
                                                <form method="post" action="{{route('admin.member.destroy',$aboutdirector)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mt-2 show_confirm">Delete</button> 
                                                </form> 
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
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

<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
@endsection