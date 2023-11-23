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
                            <h3 class="card-title">REVIEWS</h3>
                            <!--<span style="float:right;">
                                <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>-->
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>company Name</th>
                                        <th>Project Type</th>
                                        <th>Reviewer</th>
                                        <th>Reviewer Email</th>
                                        <th>Reviewer phone</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($reviews->count() > 0)
                                    @foreach($reviews as $review)
                                    <?php 
                                    if($review->published != 0){ 
                                        $published = 0;
                                        $checked = 'checked';
                                        $btnText = 'Unpublish';
                                    }else{
                                        $checked = '';
                                        $published = 1;
                                        $btnText = 'Publish';
                                    } 
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="published[]" class="publishChk" data-id="{{$review->id}}" id="publishChk_{{$review->id}}" value="{{$published}}"> 
                                        </td>
                                        <td>{{$i++}}</td>
                                        <!-- <td>{{$review->company->name}}</td> -->
                                        <td>{{$review->project_type}}</td>
                                        <td>{{$review->full_name}}</td>
                                        <td>{{$review->company_email}}</td>
                                        <td>{{$review->phone_number}}</td>
                                        <td>{{$review->overall_rating}}</td>
                                        <td>{{$review->overall_rating_review}}</td>
                                        <td>{{date('d-m-Y H:i:s',strtotime($review->created_at))}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.company.viewreview', $review->id)}}" class="btn btn-sm btn-primary" id="vuew_reviews">View</a>
											<a href="{{route('admin.review.edit',$review->id)}}" class="btn btn-sm btn-primary viewBtn" id="viewhBtn_{{$review->id}}">Update</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary publishBtn" id="publishBtn_{{$review->id}}" onclick="publish({{$review->id}})">{{$btnText}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            <input type="checkbox" id="selectAll" class="selectAll" name="selectAll" onchange="selectAll()"> 
                                            &nbsp;&nbsp;<label for="selectAll">Select All</label>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(1)">Publish</a>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(0)">UnPublish</a>
                                        </td>
                                        <td colspan="7" style="text-align:center">{!! $reviews->links() !!}</td>
                                    </tr>
                                @else
                                    <tr><td colspan="11" style="text-align:center">No Record Found</td></tr>    
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
    var publish;
    var selectAll;
    var publishAll;
    jQuery(document).ready(function(){
        publish = function(idd){
            var value = jQuery('#publishChk_'+idd).val();
            //alert(value);
            if(value == 1){
                var btnText = 'Unpublish';
                var msg = 'Review Published successfully';
                var published = 0;
            }else{
                var btnText = 'Publish';
                var msg = 'Review UnPublished successfully';
                var published = 1;
            }
            jQuery.ajax({
                url:"{{url('admin/publish-review')}}",
                type: "POST",
                data: {'id':idd,"published":value,"_token": "{{ csrf_token() }}"},
                success: function(result){
                    console.log(result);
                    $("#publishBtn_"+idd).text(btnText);
                    $("#publishChk_"+idd).val(published);
                    $("#msg").html('<span class="alert alert-success">'+msg+'</span>');
                    $(".publishChk").prop('checked',false);
                    $('.selectAll').prop('checked', false);
                    $("html, body").animate({ scrollTop: "0" }); 
                }
            });
        }  

        selectAll = function(){
            var value = jQuery('#selectAll').is(':checked');
            //alert(value);
            if(value == true){
                $(".publishChk").each(function(){
                    //$(this).attr('checked','checked');
                    $(this).prop('checked',true);
                });
            }else{
                $(".publishChk").each(function(){
                    //$(this).removeAttr('checked');
                    $(this).prop('checked',false);
                });
            }
        } 
        /*publishAll = function(){
            var ser = "_token={{ csrf_token() }}";
            var i = 0;
            var msg = 'Review Published successfully';
            $(".publishChk").each(function(){
                i++;
                var value = $(this).is(':checked');
                if(value == true){
                    var id = $(this).attr('data-id');
                    if(i == 1){
                       ser = ser+'&published[]=1&id[]='+id; 
                    }
                    ser = ser+'&published[]=1&id[]='+id;
                }
            });
            jQuery.ajax({
                url:"{{url('admin/publish-all-review')}}",
                type: "POST",
                data: ser,
                success: function(result){
                    console.log(result);
                    $.each(result,function(key,val){
                        //alert(val);
                        $("#publishBtn_"+val).text('Unpublish');
                        $("#publishChk_"+val).val('0');
                    });
                    
                    $(".publishChk").prop('checked',false);
                    $('.selectAll').prop('checked', false);
                    $("#msg").html('<span class="alert alert-success">'+msg+'</span>');
                    $("html, body").animate({ scrollTop: "0" }); 
                }
            });
        }*/

        publishAll = function(idd){
            var ser = "_token={{ csrf_token() }}";
            var i = 0;
            if(idd == 1){
                var msg = 'Review Published successfully';
                var publishBtn = "Unpublish";
                var publishChk = 0;
                
            }else{
                var msg = 'Review UnPublished successfully';
                var publishBtn = "Publish";
                var publishChk = 1;
            }

            $(".publishChk").each(function(){
                i++;
                var value = $(this).is(':checked');
                if(value == true){
                    var id = $(this).attr('data-id');
                    if(i == 1){
                       ser = ser+'&published[]='+idd+'&id[]='+id; 
                    }
                    ser = ser+'&published[]='+idd+'&id[]='+id;
                }
            });

            jQuery.ajax({
                url:"{{url('admin/publish-all-review')}}",
                type: "POST",
                data: ser,
                success: function(result){
                    console.log(result);
                    $.each(result,function(key,val){
                        //alert(val);
                        $("#publishBtn_"+val).text(publishBtn);
                        $("#publishChk_"+val).val(publishChk);
                    });
                    
                    $(".publishChk").prop('checked',false);
                    $('.selectAll').prop('checked', false);
                    $("#msg").html('<span class="alert alert-success">'+msg+'</span>');
                    $("html, body").animate({ scrollTop: "0" }); 
                }
            });
        }
    });
</script>
@endsection