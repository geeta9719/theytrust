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
                            <h3 class="card-title font-weight-bold">COMPANY LIST</h3>
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Website</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @php $i = 1 @endphp

                                @if( $companies->count() > 0 )
                                    
                                    @foreach($companies as $company)
                                        
                                        <?php 
                                            if( $company->is_publish != 0 )
                                            { 
                                                $published  = 0;
                                                $checked    = 'checked';
                                                $btnText    = 'Unpublish';
                                            }
                                            else
                                            {
                                                $checked    = '';
                                                $published  = 1;
                                                $btnText    = 'Publish';
                                            } 

                                            $flag_btn_text  = ( $company->is_flagged === 1 ) ? 'Unflag' : 'Flag';
                                        ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="is_publish[]" class="publishChk" data-id="{{$company->id}}" id="publishChk_{{$company->id}}" value="{{$published}}"> 
                                        </td>
                                        <td>{{$company->id}}</td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->website}}</td>
                                        <td>{{$company->mobile}}</td>
                                        <td>{{$company->email}}</td>
                                        <td nowrap>
                                            
                                            <a href="{{url('company/'.$company->id.'/dashboard')}}" class="btn btn-sm btn-primary" >View</a>
                                            
                                            <a href="{{route('admin.company.add', [ $company->user_id, $company->id] )}}" class="btn btn-sm btn-primary publishBtn">Edit</a>
                                            
                                            <a href="javascript:void(0)" data-cid="{{$company->id}}" data-flag="{{$company->is_flagged}}" class="btn btn-sm btn-danger isFlag"><span id="flag_{{$company->id}}">{{$flag_btn_text}}</span></a>

                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary publishBtn" id="publishBtn_{{$company->id}}" onclick="publish({{$company->id}})">{{$btnText}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                            <input type="checkbox" id="selectAll" class="selectAll" name="selectAll" onchange="selectAll()"> 
                                            &nbsp;&nbsp;<label for="selectAll">Select All</label>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(1)">Publish</a>
                                            | <a href="javascript:void(0)" class="publishAll" onclick="publishAll(0)">UnPublish</a>
                                        </td>
                                        <td colspan="8" style="text-align:center">{!! $companies->links() !!}</td>
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


        jQuery('.isFlag').click(function(){

            var id          = jQuery(this).data('cid');
            var flag_text   = jQuery(this).text();
            var is_flag     = jQuery(this).data('flag') == 1  ? 0 : 1; 
            var flg_msg     = "Company has been "+flag_text+"ged.";

            $("#msg").html('');


            if( confirm('Are you sure you want to '+flag_text+' ?') == true  )
            {
                jQuery.ajax({
                    url:"{{url('admin/flag-company')}}",
                    type: "POST",
                    data: { id:id,  is_flag : is_flag, _token : "{{ csrf_token() }}"},
                    
                    success: function(result)
                    {
                        $("#msg").html('<span class="alert alert-success">'+flg_msg+'</span>');
                        $("html, body").animate({ scrollTop: "0" });
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500 );
                    }
                });
            }
            else
            {
                return false;
            }
        });


        publish = function(idd){
            var value = jQuery('#publishChk_'+idd).val();
            //alert(value);
            if(value == 1){
                var btnText = 'Unpublish';
                var msg = 'Company Published successfully';
                var published = 0;
            }else{
                var btnText = 'Publish';
                var msg = 'Company UnPublished successfully';
                var published = 1;
            }
            jQuery.ajax({
                url:"{{url('admin/publish-company')}}",
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
                url:"{{url('admin/publish-all-company')}}",
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