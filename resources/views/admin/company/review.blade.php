@extends('layouts.admin-master')

@section('content')
    
<!-- Main content -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                            <h3 class="card-title font-weight-bold" style="font-size:1.5rem;text-transform: capitalize;">REVIEWS</h3>
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
                                        <td>{{ optional($review->company)->name ?? '' }}</td>
                                        <td>{{$review->project_type}}</td>
                                        <td>{{$review->full_name}}</td>
                                        <td>{{$review->company_email}}</td>
                                        <td>{{$review->phone_number}}</td>
                                        <td>{{$review->overall_rating}}</td>
                                        <td>{{$review->overall_rating_review}}</td>
                                        <td>{{date('d-m-Y H:i:s',strtotime($review->created_at))}}</td>
                                        <td nowrap>
                                            <a href="{{route('admin.company.viewreview', $review->id)}}" class="btn btn-sm btn-primary" id="vuew_reviews">View</a>
                                            
                                            <a href="{{ route('admin.company.editreview', $review->id) }}" class="btn btn-sm btn-warning" id="edit_review">Edit</a>
				                            <a href="{{route('admin.review.edit',$review->id)}}" class="btn btn-sm btn-primary viewBtn" id="viewhBtn_{{$review->id}}">Update</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary publishBtn" id="publishBtn_{{$review->id}}" onclick="publish({{$review->id}})">{{$btnText}}</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary send-email-model" data-email="{{$review->company_email}}">Reply</button>
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


    <div class="modal" id="send-email-model" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Send Email To Reviewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <div class="modal-body">
                    <p id="notification"></p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email_subject" id="email_subject" placeholder="Enter the email subject here." /><br>
                        <input type="hidden" name="email" id="email" />
                        <textarea id="editor"></textarea>
                    </div>
              </div>

              <div class="modal-footer">
                <button class="form-control btn-sm btn-primary" id="send_reviewer_email" type="button" name="send_email">Send Email</button>
              </div>
            </div>
      </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>


<script type="text/javascript">
    $('.send-email-model').click(function(){
        var email = $(this).data('email');
        $('#email').val( email );
        $('#send-email-model').modal('show'); 
    });
</script>

<script>  
    let editor;
    ClassicEditor.create( document.querySelector( '#editor' ) ).then( newEditor => {
        editor = newEditor;
    });
</script>


<script type="text/javascript">
    
    $('#send_reviewer_email').click( function(){
        
        var email           = $('#email').val();
        var email_subject   = $('#email_subject').val(); 
        var email_content   = editor.getData(); 

        $('#notification').html('');

        if( email_subject == '' )
        {
            alert('Email Subject can\'t be empty.');
        }
        else if( email_content == '' )
        {
            alert('Email Body can\'t be empty.');
        }
        else
        {

            $.ajax({
                    url:"{{url('admin/send-reviwer-mail')}}",
                    type: "POST",
                    data: { email: email, email_subject: email_subject, email_content: email_content, _token: "{{ csrf_token() }}" },
                    success: function(result)
                    {
                        if( result.status == 'success' )
                        {
                            $('#email_subject').val('');
                            editor.setData('');
                            $('#notification').append('<div class="alert alert-success">Email sent successfully.</div>');
                        }
                    }
            });
        }
    });
</script>


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
                success: function(result){                data: ser,

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