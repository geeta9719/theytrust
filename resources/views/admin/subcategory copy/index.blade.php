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
                            <h3 class="card-title">SUBCATEGORY</h3>
                            <span style="float:right;">
                                <a href="{{route('admin.subcategory.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>
                        </div>                           
<p>hello</p>
                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>skill</th>
                                        <th>Subcategory</th>
                                       
                                       
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($subcategorychild->count() > 0)
                                    @foreach($subcategorychild as $subcategories)
                                    <?php 
                                    if($subcategories->top_subcat != 0){ 
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    } 
                                    ?>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        {{-- <td>{{$subcategories->category->category}}</</td> --}}
                                        <td>{{$subcategories->skill}}</td>
                                        <td>{{$subcategories->subchild_cat}}</td>
                                       
                                        <td>
                                            <input type="checkbox" name="top_subcat" id="top_subcat_{{$subcategories->id}}" class="top_subcat" onclick="setPriority({{$subcategories->id}})" title="Make this as TOP Subcategory" <?php echo $checked;?> >
                                        </td>
                                      
                                        <td>{{$subcategories->created_at}}</td>
                                        <td>{{$subcategories->updated_at}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.subcategory.edit',$subcategories)}}" class="btn btn-sm btn-primary" >Edit</a>
                                            <form method="post" action="{{route('admin.subcategory.destroy',$subcategories)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</button> 
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr><td colspan="11" style="text-align:center">{!! $subcategory->links() !!}</td></tr> --}}
                                @else
                                    <tr>
                                        <td colspan="14" style="text-align:center">No Record Found</td>
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
            var value = jQuery('#top_subcat_'+idd).is(':checked');
            if(value == true){
                var val = 1;
                var msg = 'Added to top Subategory list';
            }else{
                var val = 0;
                var msg = 'Removed from top Subategory list';
            }
            jQuery.ajax({
                url:"{{url('admin/subcategory/set-priority')}}",
                type: "POST",
                data: {'id':idd,"top_subcat":val,"_token": "{{ csrf_token() }}"},
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