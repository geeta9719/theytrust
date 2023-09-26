@extends('layouts.admin-master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<link rel="stylesheet" href="{{asset('front_components/css/focusStyle.css')}}">

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5 mx-auto text-center">   
                    <p> @if(Session::has('message'))
                        <div class="alert alert-danger">{{Session::get('message')}}</div>
                        @elseif(session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="formbox container focuspage pb-5 mb-5">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size"> 
                
                <form role="form" name="focus" id="focus" action="{{route('admin.company.savefocus')}}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <input type="hidden" name="company_id" value="{{$company->id}}"> 

                    <div id="msg" class="col-md-5 mx-auto text-center"></div>

                    <div class="row focuspage brdtop brdbottom" >
                        
                        <div class="col-md-4 focusleftbox">
                            <h4 class="mb-4 pb-2"><strong class="card-title font-weight-bold"style="
    font-size: 1.5rem;">Add Service Line</strong></h4>
                            @foreach($category as $partent_cat)
                            <div class="dropdown">
                                <button class=" dropdown-toggle" type="button" data-toggle="dropdown">{{$partent_cat->category}}</button>
                                <ul class="dropdown-menu">
                                    @foreach($partent_cat->subcategory as $sub_cat)
                                    <li class="subcategory_list" id="sub_{{$sub_cat->id}}" data-has-class="" data-first="" data-id="{{$sub_cat->id}}" data-category="{{$partent_cat->id}}"><a href="javascript:void(0);">{{$sub_cat->subcategory}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach   
                        </div>

                        <div class="col-md-8 focusleftbox">
                            <h4><strong class="card-title font-weight-bold" style="
    font-size: 20px;">Service Lines</strong><span style="float:right;">Total = <span id="p1">0</span>%</span></h4>
                            <div class="appendService">
                                @php $percent = 0; @endphp
                                @if(!empty($serviceLine))
                                    @foreach($serviceLine as $service)
                                        <?php $percent += $service->percent;?>
                                        <script> 
                                            $("#sub_{{$service->subcategory_id}}").attr('data-first','nowHide'); 
                                            $("#sub_{{$service->subcategory_id}}").css('background','#00aff2');
                                        </script>
                                        <input type="hidden" name="service[{{$service->category_id}}][{{$service->subcategory_id}}][]" value="{{$service->id}}">
                                        <div class="serviceA{{$service->subcategory_id}}">
                                            <input type="hidden" name="service[{{$service->category_id}}][{{$service->subcategory_id}}][]" value="{{$service->id}}">
                                            <div class="row mt-4 ml-2">    
                                                <input type="text" name="service[{{$service->category_id}}][{{$service->subcategory_id}}][]" class="service" value="{{$service->percent}}" id="input_service{{$service->subcategory_id}}" onkeyup="addPercent('service',{{$service->subcategory_id}},'p1','{{$service->subcategory->subcategory}}')"> &nbsp;% &nbsp;&nbsp; <strong>{{$service->subcategory->subcategory}}</strong>
                                            </div>
                                        </div>
                                    @endforeach 
                                    <script> $("#p1").html({{$percent}}); </script>
                                @endif  
                            </div>
                        </div>
                    
                        <div class="col-md-4 focusleftbox"  >
                        <h4 class="mb-4 pb-2"><strong class="card-title font-weight-bold" style="
    font-size: 1.5rem;">Add Focus Area</strong></h4>
                            @if(!empty($serviceLine))
                                @foreach($serviceLine as $service)
                                    @if( $service->percent >= 10 )
                                        <?php 
                                            if(!empty($add_focus[$service->subcategory_id][0]))
                                            {
                                                $sid = $service->subcategory_id;
                                            }
                                            else
                                            {
                                                $sid = 0;
                                            } 
                                        ?>
                                        <div class="dropdown ff focus_{{$service->subcategory_id}}" >
                                            <a href="javascript:void(0)" class=" focuseFirst text-white" data-have-val="{{$sid}}" data-has-class="" data-first="" id="focus_{{$service->subcategory_id}}" onclick="addValue({{$service->subcategory_id}},'appendFocus')">{{$service->subcategory->subcategory}} Focus</a>
                                        </div>    
                                    @endif
                                @endforeach
                                <div class="drop1"></div>
                            @endif   
                        </div>
                        <div class="col-md-8 focusleftbox" >
                            <div class="focusPrimary">
                                <h4><strong class=" card-title">Focus Areas</strong></h4><!--headF-->
                                <span class="">Focus areas help you elaborate on the services your company offers. Choose a focus group to the left to start adding focuses.</span><!--headT-->
                            </div>
                            <div class="appendFocus">
                                @if(!empty($add_focus))
                                    @foreach($add_focus as $key => $adf)
                                        <div class="appendFocus_{{$key}} appendFocus_all" style="display: none;">
                                            <h4 class="focusA_{{$key}}">
                                            <?php $percent = 0; $i =0;?>
                                            @foreach($adf as $f)
                                                <?php $i++; ?>
                                                <strong class="headF_{{$key}} card-title">{{$f->subcategory->subcategory}} Focus</strong>
                                                <span style="float:right;">Total = <span id="p2_{{$key}}">0</span>%</span>
                                                <?php if($i == 1){ break;}?>
                                            @endforeach 
                                            </h4>
                                            @foreach($adf as $f)  
                                                <?php $percent += $f->percent; ?>
                                                <input type="hidden" name="focus[{{$f->subcategory_id}}][{{$f->subcat_child_id}}][]" value="{{$f->id}}">
                                                <div class="focusA focusA_{{$f->subcategory_id}} focusA{{$f->id}}">
                                                    <input type="hidden" name="focus[{{$f->subcategory_id}}][{{$f->subcat_child_id}}][]" value="{{$f->id}}">
                                                    <div class="row mt-4 ml-2">
                                                        <input type="text" name="focus[{{$f->subcategory_id}}][{{$f->subcat_child_id}}][]" class="focus input_focus{{$f->subcategory_id}}" data-class="{{$f->subcategory_id}}" value="{{$f->percent}}" id="input_focus{{$f->subcategory_id}}_{{$f->id}}" onkeyup="addPercent('input_focus{{$f->subcategory_id}}',{{$f->subcategory_id}},'p2_{{$key}}','')">&nbsp;% &nbsp;&nbsp; <strong>{{$f->subcat_child->name}}</strong>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <script> $("#p2_{{$key}}").html({{$percent}}); </script>
                                        </div>    
                                    @endforeach 
                                @endif   
                            </div>
                        </div>
                    
                        <div class="col-md-4 focusleftbox">
                            <h4 class="">Add Industry Focus</h4>
                            @foreach($industry as $ind)
                            <div class="dropdown industry_{{$ind->id}}">
                                <a href="javascript:void(0)" class="text-white" data-has-class="" data-first="" data-name="industry" id="industry_{{$ind->id}}" onclick="addInd({{$ind->id}},'industry_{{$ind->id}}','ind_{{$ind->id}}','appendIndustry')">{{$ind->name}}</a>
                            </div>
                            @endforeach   
                        </div>
                        <div class="col-md-8 focusleftbox">
                            <h4><strong class="headI">Industry Focus</strong><span style="float:right;">Total = <span id="p3">0</span>%</span></h4>
                            <div class="appendIndustry">
                                @if(!empty($addIndustry))
                                    <?php $percent=0; ?>
                                    @foreach($addIndustry as $addI)
                                        <?php $percent += $addI->percent;?>
                                        <script> 
                                            $("#industry_{{$addI->industry_id}}").attr('data-first','nowHide'); 
                                            $(".industry_{{$addI->industry_id}}").css('background','#00aff2');
                                        </script>
                                        <input type="hidden" name="industry[{{$addI->industry_id}}][]" value="{{$addI->id}}">
                                        <div class="ind_{{$addI->industry_id}}">
                                            <input type="hidden" name="industry[{{$addI->industry_id}}][]" value="{{$addI->id}}">
                                            <div class="row mt-4 ml-2">
                                                <input type="text" name="industry[{{$addI->industry_id}}][]" class="industry" value="{{$addI->percent}}" id="input_industry{{$addI->industry_id}}" onkeyup="addPercent('industry',{{$addI->industry_id}},'p3','')">&nbsp;% &nbsp;&nbsp; <strong> {{$addI->industry->name}}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                    <script> $("#p3").html({{$percent}}); </script>
                                @endif    
                            </div>
                        </div>
                    
                        <div class="col-md-4  focusleftbox" >
                            <h4 class="">Add Client Size</h4>
                            @foreach($clientSize as $client)
                            <div class="dropdown clientSize_{{$client->id}}">
                                <a href="javascript:void(0)" class="text-white" data-has-class="" data-first="" data-name="clientSize" id="clientSize_{{$client->id}}" onclick="addInd({{$client->id}},'clientSize_{{$client->id}}','client_{{$client->id}}','appendClient')">{{$client->name}}</a>
                            </div>
                            @endforeach   
                        </div>

                        <div class="col-md-8 focusleftbox">
                            <h4><strong class="headC">Client Size</strong><span style="float:right;">Total = <span id="p4">0</span>%</span></h4>
                            <div class="appendClient">
                                @if(!empty($addClientSize))
                                    <?php $percent=0; ?>
                                    @foreach($addClientSize as $addI)
                                        <?php $percent += $addI->percent;?>
                                        <script> 
                                            $("#clientSize_{{$addI->client_size_id}}").attr('data-first','nowHide'); 
                                            $(".clientSize_{{$addI->client_size_id}}").css('background','#00aff2');
                                        </script>
                                        <input type="hidden" name="clientSize[{{$addI->client_size_id}}][]" value="{{$addI->id}}">
                                        <div class="client_{{$addI->client_size_id}}">
                                            <input type="hidden" name="clientSize[{{$addI->client_size_id}}][]" value="{{$addI->id}}">
                                            <div class="row mt-4 ml-2">
                                                <input type="text" name="clientSize[{{$addI->client_size_id}}][]" class="clientSize" value="{{$addI->percent}}" id="input_clientSize{{$addI->client_size_id}}" onkeyup="addPercent('clientSize',{{$addI->client_size_id}},'p4','')">&nbsp;% &nbsp;&nbsp; <strong>{{$addI->client_size->name}}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                    <script> $("#p4").html({{$percent}}); </script>
                                @endif 
                            </div>
                        </div>
                    </div>

                    <div class="mt-5"> 
                        <a href="{{ route( 'admin.company.location', [ $company->id , $company->user_id ] )}}" class="btn btn-md btn-primary"> < </a> 

                        <button type="button" class="btn btn-md btn-primary" onclick="checkValue()">Save Focus</button>
                        <button type="submit" class="btn btn-md btn-primary" id="frm" style="display:none">Next</button>

                        <a href="{{ route( 'admin.company.admininfo', $company->id )}}" class="btn btn-md btn-primary"> > </a>
                    </div>  

                </form>
            </div>
        </div>        
    </div>
</section>                        
@endsection

@section('script')
<script>
    var addValue;
    var addInd;
    var checkValue;
    var addPercent;
    $(document).ready(function(){      
        
        $('.subcategory_list').click(function(){
            var sub_cat_id = $(this).attr('data-id');
            var sub_cat_name = $(this).find('a').text();
            var category_id = $(this).attr('data-category');
            var hasclass = $(this).attr('data-has-class');
            var hasFirst = $(this).attr('data-first');
            if(hasclass == 'nowHide' || hasFirst == 'nowHide'){
                $('.serviceA'+sub_cat_id).remove();
                $("#sub_"+sub_cat_id).css('background','');
                addPercent('service',sub_cat_id,'p1',sub_cat_name);
                $(this).attr('data-has-class','');
                $(this).attr('data-first','');
            }else{
                $(this).attr('data-has-class', 'nowHide');
                var html='';
                var html = '<div class="serviceA'+sub_cat_id+'"><input type="hidden" name="service['+category_id+']['+sub_cat_id+'][]" value="0"><div class="row mt-4 ml-2"> <input type="text" name="service['+category_id+']['+sub_cat_id+'][]" class="service" id="input_service'+sub_cat_id+'" onkeyup="addPercent(\'service\','+sub_cat_id+',\'p1\',\''+sub_cat_name+'\')" >&nbsp;% &nbsp;&nbsp; <strong>'+sub_cat_name+'</strong></div></div>';
                $('.appendService').append(html);
                $("#sub_"+sub_cat_id).css('background','#00aff2');
            }
        });

        addValue = function(idd,cls){
            var dataHaveVal = $("#focus_"+idd).attr('data-have-val');
            var hasclass = $("#focus_"+idd).attr('data-has-class');
            var hasFirst = $("#focus_"+idd).attr('data-first');
            var focus_name = $("#focus_"+idd).text();
            
            if(hasclass == 'nowHide' || hasFirst == 'nowHide'){
                $(".focusPrimary").show();
                $(".appendFocus_all").hide();
                $(".focus_"+idd).css('background','');
                $("#focus_"+idd).attr('data-has-class','');
                $("#focus_"+idd).attr('data-first','');
                addPercent('focus',idd,'p2'+idd,'');
            }else{
                $(".focuseFirst").attr('data-has-class', '');
                $(".focuseFirst").attr('data-first', '');
                //$(".ff").css('background','');
                if(dataHaveVal == 0){                    
                    $.ajax({
                        url:"{{url('get-subcat-children')}}",
                        type: "POST",
                        data: { subcategory_id: idd, _token: '{{csrf_token()}}' },
                        success: function(result){
                            console.log(result);
                            $("."+cls).append(result);
                            $('#focus_'+idd).attr('data-have-val', idd);
                        }
                    });
                }
                $(".focusPrimary").hide();
                $(".appendFocus_all").hide();
                $(".appendFocus_"+idd).show();
                $(".focus_"+idd).css('background','#00aff2');
                $("#focus_"+idd).attr('data-has-class', 'nowHide');
                $("#focus_"+idd).attr('data-first','nowHide');
                addPercent('focus',idd,'p2'+idd,'');    
            }        
        }

        addInd = function(idd,idd1,cls,cls1){
            var hasclass = $("#"+idd1).attr('data-has-class');
            var hasFirst = $("#"+idd1).attr('data-first');
            var arrName = $("#"+idd1).attr('data-name');
            if(arrName == 'industry'){var p = 'p3';}else if(arrName == 'clientSize'){var p = 'p4';}else if(arrName == 'specialization'){var p = 'p5';}
            var name = $("#"+idd1).text();
            if(hasclass == 'nowHide' || hasFirst == 'nowHide'){
                $('.'+cls).remove();
                $("."+idd1).css('background','');
                addPercent(arrName,idd,p,'');
                $("#"+idd1).attr('data-has-class','');
                $("#"+idd1).attr('data-first','');
            }else{
                $("#"+idd1).attr('data-has-class', 'nowHide');
                $("."+idd1).css('background','#00aff2');
                var html = '';
                html +='<div class="'+cls+'"><input type="hidden" name="'+arrName+'['+idd+'][]" value="0"><div class="row mt-4 ml-2"><input type="text" class="'+arrName+'" name="'+arrName+'['+idd+'][]" id="input_'+arrName+''+idd+'" onkeyup="addPercent(\''+arrName+'\','+idd+',\''+p+'\',\'\')">&nbsp;% &nbsp;&nbsp; <strong>'+name+'</strong></div></div>';
                $("."+cls1).append(html);
            }    
        }

        addPercent = function(cls,idd,idd1,name){
            var ss = 0;
            var s = 0;
            $("."+cls).each(function() {
                if($(this).val() != ''){
                    if($.isNumeric($(this).val())){
                        s = ss += parseInt($(this).val());
                    }else{
                        ss='';
                        ss = 'Only Numeric Value Allowed';
                    }
                }
            });
            $('#'+idd1).html(ss);
            
            if(cls == 'service'){
                var val = $("#input_"+cls+idd).val();
                var a = '<div class="dropdown ff focus_'+idd+'" ><a class=" focuseFirst" style="text-decoratin:none;color:#fff;" data-has-class="" data-first="" data-have-val="0" id="focus_'+idd+'" onclick="addValue('+idd+',\'appendFocus\')">'+name+' Focus</a></div>';
                if(s <= 100 && val >= 10){
                    $('.drop1').append(a);
                }else{
                    $('#focus_'+idd).remove('');
                    $('.focus_'+idd).remove('');
                    $('.focusA_'+idd).html('');
                    $('.headA_'+idd).html('');
                    $(".focusPrimary").show();
                }
            }
        }

        checkValue = function(){
            var ar = ['service','focus','industry','clientSize','specialization'];
            var arr = [];
            var arrr = [];
            var ar2 = [];
            var msg = '';
            $.each(ar,function(key,val){
                var ss = 0;
                if(val == 'focus'){
                    var sss = 0;
                    $("."+val).each(function() {
                        var attr = $(this).attr('data-class');
                        var v = $(this).val();
                        if(v != ''){
                            if($.isNumeric(v)){
                                arrr[attr] = sss += parseInt(v);
                            }else{
                                arrr[attr] = sss = 101;
                            }
                        }else{
                            $(this).val(0);
                        }
                    });
                    console.log(arrr.sort());
                    var i = 0;
                    $.each(arrr,function(k,value){
                        if(value != undefined){
                            i++;
                            if(i != 1){
                                value = value - parseInt(arrr[parseInt(k)-1]);
                            }
                            if(value != 100){
                                ar2[key] = parseInt(value);
                            } 
                        }
                    });
                    console.log(ar2);
                    if(ar2.length == 0){
                        arr[key] = 100;
                    }else{
                        arr[key] = ar2[key];
                    }
                    console.log(arr[key]);
                }else{
                    $("."+val).each(function() {
                        if($(this).val() != ''){
                            if($.isNumeric($(this).val())){
                                arr[key] = ss += parseInt($(this).val());
                            }else{
                                arr[key] = ss = 101;
                            }
                        }else{
                            $(this).val(0);
                        }
                    });
                }
            });
            
            $.each(arr,function(key,val){
                if(val != 100 && val != 0){
                    msg += ar[key].toUpperCase()+' sum must be hundred<br/>';

                }
            });                    
            if(msg != ''){
                $('#msg').html(msg);
                $('#msg').addClass('alert alert-danger');
                $("html, body").animate({ scrollTop: "0" });
            }else{
                $("#frm").click();
            }   
        }
        
    });
    
</script>
@endsection