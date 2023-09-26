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
                            <h3 class="card-title">USERS LIST</h3>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!--<th></th>-->
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
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @if($users->count() > 0)
                                    @foreach($users as $user)
                                    <?php 
                                    if($user->is_publish != 0){ 
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
                                        <!--<td>
                                            <input type="checkbox" name="is_publish[]" class="publishChk" data-id="{{$user->id}}" id="publishChk_{{$user->id}}" value="{{$published}}"> 
                                        </td>-->
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td><img src="{{$user->avatar}}" alt="avatar" width="50px"></td>
                                        <td>{{$user->company}}</td>
                                        <td>{{$user->bio}}</td>
                                        <td>{{$user->twitter}}</td>
                                        <td>{{$user->linkedin}}</td>
                                        <td>{{$user->slug}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <!--<td nowrap>
                                            <a href="{{url('user/'.$user->id.'/dashboard')}}" class="btn btn-sm btn-primary" >View</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary publishBtn" id="publishBtn_{{$user->id}}" onclick="publish({{$user->id}})">{{$btnText}}</a>
                                        </td>-->
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <!--<td colspan="3">
                                            <input type="checkbox" id="selectAll" class="selectAll" name="selectAll" onchange="selectAll()"> 
                                            &nbsp;&nbsp;<label for="selectAll">Select All</label>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(1)">Publish</a>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(0)">UnPublish</a>
                                        </td>-->
                                        <td colspan="8" style="text-align:center">{!! $users->links() !!}</td>
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
                var msg = 'User Published successfully';
                var published = 0;
            }else{
                var btnText = 'Publish';
                var msg = 'User UnPublished successfully';
                var published = 1;
            }
            jQuery.ajax({
                url:"{{url('admin/publish-user')}}",
                type: "POST",
                data: {'id':idd,"is_publish":value,"_token": "{{ csrf_token() }}"},
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
                    $(this).prop('checked',true);
                });
            }else{
                $(".publishChk").each(function(){
                    $(this).prop('checked',false);
                });
            }
        } 
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
                       ser = ser+'&is_publish[]='+idd+'&id[]='+id; 
                    }
                    ser = ser+'&is_publish[]='+idd+'&id[]='+id;
                }
            });
            jQuery.ajax({
                url:"{{url('admin/publish-all-user')}}",
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