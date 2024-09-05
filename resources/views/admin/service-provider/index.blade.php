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
                            <h3 class="card-title">SERVICE PROVIDERS</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.service-provider.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Top Service Provider</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @if($serviceProviders->count() > 0)
                                    @foreach($serviceProviders as $serviceProvider)
                                    <?php 
                                    $checked = $serviceProvider->top_service != 0 ? 'checked' : ''; 
                                    ?>

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$serviceProvider->name}}</td>
                                        <td>
                                            <input type="checkbox" name="top_service" id="top_service_{{$serviceProvider->id}}" class="top_service" onclick="setPriority({{$serviceProvider->id}})" title="Make this as TOP Service Provider" {{$checked}} >
                                        </td>
                                        <td>{{$serviceProvider->created_at}}</td>
                                        <td>{{$serviceProvider->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.service-provider.edit',$serviceProvider)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <form method="post" action="{{route('admin.service-provider.destroy',$serviceProvider)}}" id="sdel" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr><td colspan="6" style="text-align:center">{!! $serviceProviders->links() !!}</td></tr>
                                @else
                                    <tr>
                                        <td colspan="6" style="text-align:center">No Record Found</td>
                                    </tr>    
                                @endif    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var setPriority;
    jQuery(document).ready(function(){
        setPriority = function(idd){
            var value = jQuery('#top_service_'+idd).is(':checked');
            var val = value ? 1 : 0;
            var msg = value ? 'Added to top Service Provider list' : 'Removed from top Service Provider list';
            
            jQuery.ajax({
                url:"{{url('admin/service-provider/set-priority')}}",
                type: "POST",
                data: {'id':idd,"top_service":val,"_token": "{{ csrf_token() }}"},
                success: function(result){
                    console.log(result);
                    $("#msg").html('<span class="alert alert-success">'+msg+'</span>');
                    $("html, body").animate({ scrollTop: "0" }); 
                }
            });
        }
    });      
</script>
@endsection
