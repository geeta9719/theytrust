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
                            <h3 class="card-title">CATEGORY</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Top Service</th>
                                        <!--<th>Status</th>-->
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @if($category->count() > 0)
                                    @foreach($category as $categories)
                                    <?php 
                                    if($categories->top_cat != 0){ 
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    } 
                                    ?>

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$categories->category}}</td>
                                        <td>{{$categories->description}}</td>
                                        <td>
                                            <input type="checkbox" name="top_cat" id="top_cat_{{$categories->id}}" class="top_cat" onclick="setPriority({{$categories->id}})" title="Make this as TOP Category" <?php echo $checked;?> >
                                        </td>
                                        <!--<td>{{$categories->status}}</td>-->
                                        <td>{{$categories->created_at}}</td>
                                        <td>{{$categories->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.category.edit',$categories)}}" class="btn btn-sm btn-primary" >Edit</a>
                                            <form method="post" action="{{route('admin.category.destroy',$categories)}}" id="sdel">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr><td colspan="11" style="text-align:center">{!! $category->links() !!}</td></tr>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var setPriority;
    jQuery(document).ready(function(){
        setPriority = function(idd){
            var value = jQuery('#top_cat_'+idd).is(':checked');
            if(value == true){
                var val = 1;
                var msg = 'Added to top Category list';
            }else{
                var val = 0;
                var msg = 'Removed from top Category list';
            }
            jQuery.ajax({
                url:"{{url('admin/category/set-priority')}}",
                type: "POST",
                data: {'id':idd,"top_cat":val,"_token": "{{ csrf_token() }}"},
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