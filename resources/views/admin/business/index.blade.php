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
                            <h3 class="card-title">Business Detail</h3>
                            <span style="float:right;">
                                <!--<a class="btn btn-sm btn-warning" href="{{ route('export') }}">Export BNI Member Data</a>-->
                                <a href="{{route('admin.business.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Business Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>GST</th>
                                        <th>Website</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($business->count() > 0)
                                    @foreach($business as $aboutdirector)
                                    
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$aboutdirector->name}}</td>
                                        <td>{{$aboutdirector->email}}</td>
                                        <td>{{$aboutdirector->mobile}}</td>
                                        <td>{{$aboutdirector->address}}</td>
                                        <td>{{$city[$aboutdirector->city]}}</td>
                                        <td>{{$state[$aboutdirector->state]}}</td>
                                        <td>{{$country[$aboutdirector->country]}}</td>
                                        <td>{{$aboutdirector->gst}}</td>
                                        <td>{{$aboutdirector->website}}</td>

                                        <td>{{$aboutdirector->status}}</td>
                                        <td>{{$aboutdirector->created_at}}</td>
                                        <td>{{$aboutdirector->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.business.edit',$aboutdirector)}}" class="btn btn-sm btn-primary" >Edit</a>
                                            <form method="post" action="{{route('admin.business.destroy',$aboutdirector)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2 show_confirm">Delete</button> 
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" style="text-align:center">No Record Found</td>
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