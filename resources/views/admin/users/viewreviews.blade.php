@extends('layouts.admin-master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 mt-4">
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">VIEW REVIEWS</h3>
                            <!--<span style="float:right;">
                                <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-primary"> Add New</a>
                            </span>-->
                        </div>                           

                        <div class="card-body table-responsive p-0">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>{{$reviews->company->name}}</th>
									</tr>
									<tr>
                                        <th>Project Type</th>
                                        <th>{{$reviews->project_type}}</th>
									</tr>
									<tr>
                                        <th>Project Title</th>
                                        <th>{{$reviews->project_title}}</th>
									</tr>
									<tr>
                                        <th>Company Type</th>
                                        <th>{{$reviews->company_type}}</th>
									</tr>
									<tr>
                                        <th>Coast Range</th>
                                        <th>{{$reviews->cost_range}}</th>
                                    </tr>
									<tr>
                                        <th>Project Start</th>
                                        <th>{{$reviews->project_start}}</th>
                                    </tr>
									<tr>
                                        <th>Project End</th>
                                        <th>{{$reviews->project_end}}</th>
                                    </tr>
									<tr>
                                        <th>Company Position</th>
                                        <th>{{$reviews->company_position}}</th>
                                    </tr>
									<tr>
                                        <th>For What Project</th>
                                        <th>{{$reviews->for_what_project}}</th>
                                    </tr>
									<tr>
                                        <th>How Select</th>
                                        <th>{{$reviews->how_select}}</th>
                                    </tr>
									<tr>
                                        <th>Scope Of Work</th>
                                        <th>{{$reviews->scope_of_work}}</th>
                                    </tr>
									<tr>
                                        <th>Team Composition</th>
                                        <th>{{$reviews->team_composition}}</th>
                                    </tr>
									<tr>
                                        <th>Any Outcomes</th>
                                        <th>{{$reviews->any_outcomes}}</th>
                                    </tr>
									<tr>
                                        <th>How Effective</th>
                                        <th>{{$reviews->how_effective}}</th>
                                    </tr>
									<tr>
                                        <th>Most Impressive</th>
                                        <th>{{$reviews->most_impressive}}</th>
                                    </tr>
									<tr>
                                        <th>Area Of Improvements</th>
                                        <th>{{$reviews->area_of_improvements}}</th>
                                    </tr>
									<tr>
                                        <th>Quality</th>
                                        <th>{{$reviews->quality}}</th>
                                    </tr>
									<tr>
                                        <th>Quality Review</th>
                                        <th>{{$reviews->quality_review}}</th>
                                    </tr>
									<tr>
                                        <th>Scheduling</th>
                                        <th>{{$reviews->scheduling}}</th>
                                    </tr>
									<tr>
                                        <th>Scheduling Review</th>
                                        <th>{{$reviews->scheduling_review}}</th>
                                    </tr>
									<tr>
                                        <th>Coast</th>
                                        <th>{{$reviews->cost}}</th>
                                    </tr>
									<tr>
                                        <th>Coast Review</th>
                                        <th>{{$reviews->cost_review}}</th>
                                    </tr>
									<tr>
                                        <th>Refer To Friend</th>
                                        <th>{{$reviews->refer_to_friend}}</th>
                                    </tr>
									<tr>
                                        <th>Refer To Friend Review</th>
                                        <th>{{$reviews->refer_to_friend_review}}</th>
                                    </tr>
									<tr>
                                        <th>Overall Rating</th>
                                        <th>{{$reviews->overall_rating}}</th>
                                    </tr>
									<tr>
                                        <th>Overall Rating Review</th>
                                        <th>{{$reviews->overall_rating_review}}</th>
                                    </tr>
									<tr>
                                        <th>Full Name</th>
                                        <th>{{$reviews->full_name}}</th>
                                    </tr>
									<tr>
                                        <th>Attribution</th>
                                        <th>{{$reviews->attribution}}</th>
                                    </tr>
									<tr>
                                        <th>Position Title</th>
                                        <th>{{$reviews->position_title}}</th>
                                    </tr>
									<tr>
                                        <th>Company Name</th>
                                        <th>{{$reviews->company_name}}</th>
                                    </tr>
									<tr>
                                        <th>Company Size</th>
                                        <th>{{$reviews->company_size}}</th>
                                    </tr>
									<tr>
                                        <th>City Country</th>
                                        <th>{{$reviews->city_country}}</th>
                                    </tr>
									<tr>
                                        <th>Company Email</th>
                                        <th>{{$reviews->company_email}}</th>
                                    </tr>
									<tr>
                                        <th>Phone Number</th>
                                        <th>{{$reviews->phone_number}}</th>
                                    </tr>
									<tr>
                                        <th>Linkedin Url</th>
                                        <th>{{$reviews->linkedin_url}}</th>
                                    </tr>
									<tr>
                                        <th>Company Url</th>
                                        <th>{{$reviews->company_url}}</th>
                                    </tr>
									<tr>
                                        <th>Status</th>
                                        <th>{{$reviews->status}}</th>
                                    </tr>
									<tr>
                                        <th>Project Summary</th>
                                        <th>{{$reviews->project_summary}}</th>
                                    </tr>
									<tr>
                                        <th>Feedback Summary</th>
                                        <th>{{$reviews->feedback_summary}}</th>
                                    </tr>
									<tr>
                                        <th>Published</th>
                                        <th>{{$reviews->published}}</th>
                                    </tr>
									<tr>
                                        <th>Created At</th>
                                        <th>{{$reviews->created_at}}</th>
                                    </tr>
									<tr>
                                        <th>Updated At</th>
                                        <th>{{$reviews->updated_at}}</th>
                                    </tr>
                                </thead>
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