@extends('layouts.home-master')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style type="text/css">
@import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
@import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

.rating {
    border: none;
    margin-right: 49px
}
.spanRating{
    padding: 5px;
    border-radius: 25px;
    background-color: red;
    width: 50px;
    height: 50px;
}
.myratings {
    font-size: 30px;
    color: white
}

.rating>label:before {
    margin: 5px;
    font-size: 2.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005"
}

.rating>.half:before {
    content: "\f089";
    position: absolute
}

.rating>label {
    color: #ddd;
    float: right
}

/********************************/
.rating>[id^="quality"] {
    display: none
}

.rating>[id^="quality"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="quality"]:checked+label:hover,
.rating>[id^="quality"]:checked~label:hover,
.rating>label:hover~[id^="quality"]:checked~label,
.rating>[id^="quality"]:checked~label:hover~label {
    color: #FFED85
}


.rating>[id^="scheduling"] {
    display: none
}

.rating>[id^="scheduling"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="scheduling"]:checked+label:hover,
.rating>[id^="scheduling"]:checked~label:hover,
.rating>label:hover~[id^="scheduling"]:checked~label,
.rating>[id^="scheduling"]:checked~label:hover~label {
    color: #FFED85
}

.rating>[id^="cost"] {
    display: none
}

.rating>[id^="cost"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="cost"]:checked+label:hover,
.rating>[id^="cost"]:checked~label:hover,
.rating>label:hover~[id^="cost"]:checked~label,
.rating>[id^="cost"]:checked~label:hover~label {
    color: #FFED85
}

.rating>[id^="refer_to_friend"] {
    display: none
}

.rating>[id^="refer_to_friend"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="refer_to_friend"]:checked+label:hover,
.rating>[id^="refer_to_friend"]:checked~label:hover,
.rating>label:hover~[id^="refer_to_friend"]:checked~label,
.rating>[id^="refer_to_friend"]:checked~label:hover~label {
    color: #FFED85
}

.rating>[id^="overall_rating"] {
    display: none
}

.rating>[id^="overall_rating"]:checked~label,
.rating:not(:checked)>label:hover,
.rating:not(:checked)>label:hover~label {
    color: #FFD700
}

.rating>[id^="overall_rating"]:checked+label:hover,
.rating>[id^="overall_rating"]:checked~label:hover,
.rating>label:hover~[id^="overall_rating"]:checked~label,
.rating>[id^="overall_rating"]:checked~label:hover~label {
    color: #FFED85
}

.reset-option {
    display: none
}

.reset-button {
    margin: 6px 12px;
    background-color: rgb(255, 255, 255);
    text-transform: uppercase
}

.btn:focus {
    outline: none
}
.btn {
    border-radius: 22px;
    text-transform: capitalize;
    font-size: 13px;
    padding: 8px 19px;
    cursor: pointer;
    color: #fff;
    background-color: #D50000
}
.btn:hover {
    background-color: #D32F2F !important
}
</style>

<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 mx-auto text-center">   
                    <h6>You are Reviewing</h6>
                    <img src="{{asset($company->logo)}}" style="width:40px;height:40px;"> <strong> {{ucfirst($company->name)}} </strong>
                    <h6>Please Note: We do not accept reviews from current employees, former employees, or anyone with a financial stake in the company being reviewed.</h6>
                    <p>If your company has already left a review about this project, please email us instead of submitting a new review.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="formbox container">
    <div class="row  ">
        <div class="col-lg-12">
            <div class="col-lg-12  form-size">  
                <form action="" method="POST" class="" id="form1"><!-- was-validated -->
                    <input type="hidden" name="company_id" value="{{$company->id}}">
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    
                    <div class="project step" id="project">
                        @csrf
                        <input type="hidden" name="form" value="form1">
                        <h5>The Project</h5>
                        <span>Basic information on the project to give buyers a sense of topic and scale.</span> 
                        
                        <div class="form-group pt-4">
                            <label for="project_type">Select the type of Project</label><strong style="color: red;"> *</strong>
                            <!--<input type="text" class="form-control" id="project_type"  name="project_type" required>-->
                            <select class="form-control rmvId" id="project_type" name="project_type" required>
                                <option value="">Select a value</option>
                                @foreach($category as $cat)
                                    @foreach($cat->subcategory as $c)
                                    <option value="{{$c->subcategory}}">{{$c->subcategory}}</option>
                                    @endforeach
                                 @endforeach
                            </select>
                            <div class="invalid-feedback project_type rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="project_title">Give the project a title</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control rmvId" id="project_title" placeholder="Enter Title" name="project_title" required>
                            <div class="invalid-feedback project_title rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="company_type">Give the type of company you work for</label><strong style="color: red;"> *</strong>
                            <!--<input type="text" class="form-control" id="company_type" name="company_type" required>-->
                            <select class="form-control rmvId" id="company_type" name="company_type" required>
                                <option value="">Select a value</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->category}}">{{$cat->category}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback company_type rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="title">Cost Range</label><strong style="color: red;"> *</strong>
                            <!--<input type="text" class="form-control" id="cost_range" name="cost_range" required>-->
                            <select class="form-control rmvId" id="cost_range" name="cost_range" required>
                                <option value="">Select a value</option>
                                @foreach($budget as $b)
                                    <?php 
                                    $bb = explode('-',$b['budget']);
                                    $bud = '$'.$bb[0].' - $'.$bb[1];
                                    ?>
                                    <option value="{{ $b['budget'] }}" >{{ $bud }}</option>
                                @endforeach

                                <?php /* $i = 1;?>
                                @foreach($budget as $k=>$v)
                                <?php 
                                $ii = "";
                                $b = "";
                                if($i == 1){
                                    $ii = 'Less Than ';
                                    $vv = $v;
                                }elseif(isset($budget[$k+1])){
                                    $vv = $v.' to ';
                                    $b = $budget[$k+1] - 1000;
                                }else{
                                    $vv = $v.' + ';
                                }
                                $i++;
                                
                                ?>
                                <!--<option value="{{$ii}}{{$vv}}{{$b}}">{{$ii}}{{$vv}}{{$b}}</option>-->
                                @endforeach
                                */?>
                            </select>
                            <div class="invalid-feedback cost_range rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="project_start">Project Start</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control date1 rmvId" id="project_start" placeholder="yyyy-mm-dd" name="project_start" required>
                            <div class="invalid-feedback project_start rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="project_end">Project End</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control date1 rmvId" id="project_end" placeholder="yyyy-mm-dd" name="project_end" required>
                            <div class="invalid-feedback project_end rmvCls" ></div>
                        </div>
                        <!--Project Start <input id="txtstartdate" />
                        Project End <input id="txtenddate" />-->
                        <button type="button" class="btn btn-primary" onclick="nextStep('review','next','1','project')">Next Section</button>
                    </div>
                
                    <div class="review step" id="review" style="display: none;">
                        @csrf
                        <input type="hidden" name="form" value="form2">
                        <h5>The Review</h5>
                        <span>Let’s get down to it!</span> 
                        
                        <div class="form-group pt-4">
                            <h4> Background </h4>
                            <div class="form-group pt-4">
                                <label for="company_position">Please describe your company and your position there.</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="company_position"  name="company_position" required></textarea>
                                <div class="invalid-feedback company_position rmvCls" ></div>
                            </div>
                        </div> 

                        <div class="form-group pt-4">   
                            <h4> Challenge </h4>
                            <div class="form-group">
                                <label for="for_what_project">For what projects/services did your company hire Hyperlink InfoSystem?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="for_what_project" placeholder="" name="for_what_project" required></textarea>
                                <div class="invalid-feedback for_what_project rmvCls" ></div>
                            </div>
                        </div>
                        <div class="form-group pt-4">
                            <h4> Solution </h4>
                            <div class="form-group pt-4">
                                <label for="how_select">How did you select this vendor and what were the deciding factors?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="how_select"  name="how_select" required></textarea>
                                <div class="invalid-feedback how_select rmvCls" ></div>
                            </div>
                            <div class="form-group">
                                <label for="scope_of_work">Describe the project in detail and walk through the stages of the project</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="scope_of_work" name="scope_of_work" required></textarea>
                                <div class="invalid-feedback scope_of_work rmvCls" ></div>
                            </div>
                            <div class="form-group pt-4">
                                <label for="team_composition">How many resources from the vendor's team worked with you, and what were their positions?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="team_composition"  name="team_composition" required></textarea>
                                <div class="invalid-feedback team_composition rmvCls" ></div>
                            </div>
                        </div>  
                        <div class="form-group pt-4">   
                            <h4> Results & Feedback </h4>  
                            <div class="form-group">
                                <label for="any_outcome">Can you share any outcomes from the project that demonstrate progress or success?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="any_outcome" placeholder="" name="any_outcome" required></textarea>
                                <div class="invalid-feedback any_outcome rmvCls" ></div>
                            </div>

                            <div class="form-group pt-4">
                                <label for="how_effective">How effective was the workflow between your team and theirs?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="how_effective"  name="how_effective" required></textarea>
                                <div class="invalid-feedback how_effective rmvCls" ></div>
                            </div>
                            <div class="form-group">
                                <label for="most_impressive">What did you find most impressive or unique about this company?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="most_impressive" placeholder="" name="most_impressive" required></textarea>
                                <div class="invalid-feedback most_impressive rmvCls" ></div>
                            </div>
                            <div class="form-group">
                                <label for="area_of_improvements">Are there any areas for improvement or something they could have done differently?</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="area_of_improvements" placeholder="" name="area_of_improvements" required></textarea>
                                <div class="invalid-feedback area_of_improvements rmvCls" ></div>
                            </div>
                        </div> 
                        <div class="form-group pt-4">   
                            <h4> Rating </h4>  
                            <?php
                            $arr = array('quality'=>'How was the quality of Hyperlink InfoSystem’s work?','scheduling'=>'How was scheduling with Hyperlink InfoSystem?','cost'=>'How was the cost of Hyperlink InfoSystem’s work?','refer_to_friend'=>'How likely are you to refer Hyperlink InfoSystem to a friend?','overall_rating'=>'Give Hyperlink InfoSystem an overall rating.');
                            ?>
                            @foreach($arr as $key => $val)
                            <div class="form-group">
                                <div><label for="{{$key}}">{{$val}}</label><strong style="color: red;"> *</strong></div>
                                <div class="rating" style="float:left;"> 
                                    <?php
                                    for($i=5;$i>0; $i--){
                                        if($i == 5){
                                            ?>
                                            <input type="radio" id="{{$key}}{{$i}}" name="{{$key}}" value="{{$i}}" onclick="addValue('{{$key}}{{$i}}')"/>
                                            <label class="full" for="{{$key}}{{$i}}" title="Awesome - {{$i}} stars"></label>
                                            <?php     
                                        }else{
                                            $j = $i + 0.5;
                                            ?>
                                            <input type="radio" id="{{$key}}{{$i}}half" name="{{$key}}" value="{{$j}}" onclick="addValue('{{$key}}{{$i}}half')"/>
                                            <label class="half" for="{{$key}}{{$i}}half" title="Pretty good - {{$j}} stars"></label> 
                                            <input type="radio" id="{{$key}}{{$i}}" name="{{$key}}" value="{{$i}}" onclick="addValue('{{$key}}{{$i}}')"/>
                                            <label class="full" for="{{$key}}{{$i}}" title="Pretty good - {{$i}} stars"></label>
                                            <?php
                                        }
                                    }
                                    /*<input type="radio" id="{{$key}}half" name="{{$key}}" value="0.5" onclick="addValue('{{$key}}half')"/>
                                    <label class="full" for="{{$key}}half" title="Awesome - 0.5 stars"></label>*/
                                    ?>
                                </div>
                                <div class="spanRating" style="float:left;"> <span class="myratings {{$key}}" style="margin:0 auto;">0</span></div>
                                 
                                <div class="invalid-feedback {{$key}} rmvCls" ></div>
                                <input type="text" class="form-control rmvId" id="{{$key}}_review" name="{{$key}}_review" required placeholder="Explain your rating">
                                <div class="invalid-feedback {{$key}}_review rmvCls" ></div>
                            </div>
                            @endforeach
                        </div>    
                        
                        <button type="button" class="btn btn-primary" onclick="nextStep('project','back','2','review')"> < </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep('reviewer','next','2','review')">Next Section</button>
                    </div>
                
                    <div class="reviewer step" id="reviewer" style="display: none;">
                        @csrf
                        <input type="hidden" name="form" value="form3">
                        <h5>The Reviewer</h5>
                        <span>Basic information about you, the reviewer.</span> 
                        
                        <div class="form-group pt-4">
                            <label for="full_name">Full Name</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="full_name"  name="full_name" value="{{auth()->user()->name}}" required>
                            <div class="invalid-feedback full_name rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="attribution">Attribution</label><strong style="color: red;"> *</strong>
                            <select class="form-control" id="attribution" name="attribution" required>
                                <option value="">Select a value</option>
                                @foreach($attribution as $val)
                                    <option value="{{$val->id}}">{{$val->name}}-{{$val->description}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback attribution rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="position_title">Position Title</label>
                            <input type="text" class="form-control" id="position_title" name="position_title">
                            <div class="invalid-feedback position_title rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name">
                            <div class="invalid-feedback company_name rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="company_size">Company Size</label><strong style="color: red;"> *</strong>
                            <select class="form-control" id="company_size" name="company_size" required>
                                <option value="">Select a value</option>
                                @foreach($size as $k=>$v)
                                    <option value="{{json_decode($v)->size}}">{{json_decode($v)->size}} Employees</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback company_size rmvCls" ></div>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="country" name="country" required>
                                <option value="">Select a value</option>
                                @foreach( $countries as $country )
                                    <option value="{{$country->iso2}}">{{$country->name}}</option>
                                @endforeach;
                            </select>

                            <div class="invalid-feedback country rmvCls" ></div>
                        </div>

                        <div class="form-group">
                            <label for="city_country">State</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="state" name="state" required>
                                <option value="">Select a value</option>
                            </select>
                            
                            <div class="invalid-feedback state rmvCls" ></div>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="city" name="city" required>
                                <option value="">Select a value</option>
                                <option value="delhi">delhi</option>
                                <option value="mumbai">mumbai</option>
                                <option value="kolkata">kolkata</option>
                                <option value="varanasi">varanasi</option>
                                <option value="Confidential">Confidential</option>
                            </select>
                            
                            <div class="invalid-feedback city rmvCls" ></div>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="nextStep('review','back','3','reviewer')"> < </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep('verify','next','3','reviewer')">Next Section</button>
                    </div>
                
                    <div class="verify step" id="verify" style="display: none;">
                        @csrf
                        <input type="hidden" name="form" value="form4">
                        <h5>Verify and Submit</h5>
                        <span>Basic information on the project to give buyers a sense of topic and scale.</span> 
                        
                        <div class="form-group pt-4">
                            <label for="company_email">Company Email</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="company_email" name="company_email" value="{{auth()->user()->email}}" required>
                            <div class="invalid-feedback company_email rmvCls" ></div>
                        </div>
                        <div class="form-group pt-4">
                            <label for="phone_number">Phone Number</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                            <div class="invalid-feedback phone_number rmvCls" ></div>
                        </div>
                        <div class="form-group pt-4">
                            <label for="linkedin_url">Linkedin Url</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control" id="linkedin_url" name="linkedin_url" required placeholder="https://example.com">
                            <div class="invalid-feedback linkedin_url rmvCls" ></div>
                        </div>
                        <div class="form-group pt-4">
                            <label for="company_url">Company Url(https://example.com/)</label>
                            <input type="text" class="form-control" id="company_url" name="company_url" placeholder="https://example.com">
                            <div class="invalid-feedback company_url rmvCls" ></div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep('reviewer','back','4','verify')"> < </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep('success','next','4','verify')">Submit</button>
                    </div>
                </form>

                <div class="success step" id="success" style="display: none;">
                    <h5>Successfully Submitted!</h5>
                    <span>Thank Yoy for leaving a review! Your feedback helps buyers like you, find the right service provider.</span> 
                    <a href="{{url('/')}}" class="btn btn-primary">Back to TheyTrustUs</a>
                    <button type="button" class="btn btn-primary" onclick="nextStep('verify','back','5','success')"> < </button>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>



<script type="text/javascript">
    $("#country").change( function(){
        
        var iso2 = $(this).val();

         $('#state').empty();

        $.ajax({
                
                url:"{{ url( 'review/company/states' ) }}",
                type: "GET",
                data: { iso2:iso2,  _token : "{{ csrf_token() }}"},
                
                success: function( result )
                {
                    console.log( result );
                    $.each( result, function( key, val ){
                       $('#state').append( $("<option value='"+key+"'>"+val+"</option>" ) );
                    });
                }

            });
    });
</script>


<script type="text/javascript">
    $("#state").change( function(){
        
        var iso2 = $(this).val();

         $('#city').empty();

        $.ajax({
                
                url:"{{ url( 'review/company/cities' ) }}",
                type: "GET",
                data: { iso2:iso2,  _token : "{{ csrf_token() }}"},
                
                success: function( result )
                {
                    console.log( result );
                    $.each( result, function( key, val ){
                       $('#city').append( $("<option value='"+key+"'>"+val+"</option>" ) );
                    });
                }

            });
    });
</script>





<script type="text/javascript">
/*
$('.date').datepicker({  
   format: 'yyyy-mm-dd',
   minDate: '2022-01-02',   
   autoclose:true,            
}); 
*/    
/*
var d = '2012/3/4';
var parts = d.split('/');
var date = new Date(+parts[0], +parts[1] - 1, +parts[2]);
date.setDate(date.getDate() + 5);
var result = date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
var dates = $( "#from, #to" ).datepicker({
    dateFormat: 'yy/mm/dd',
    changeMonth: true,
    minDate: result,
    onSelect: function() { 
       var d1=new Date($('#from').val());
       var d2=new Date($('#to').val());
       $('#quantity').val((Math.ceil((d2-d1)/86400000)));
    }
});
*/    
$("#project_start").datepicker({
    //minDate: 0,
    dateFormat: 'yy-mm-dd',
    onSelect: function(date) {
        //alert(date);
        var parts = date.split('-');
        var date = new Date(+parts[0], +parts[1] - 1, +parts[2]);
        date.setDate(date.getDate() + 1);
        var result = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
        //alert(result);
        $("#project_end").datepicker('option', 'minDate', result);
    }
});

$("#project_end").datepicker({
    dateFormat: 'yy-mm-dd',
});
</script>


<script type="text/javascript">   
    var selectDate;
    var nextStep;
    var addValue;
    $(document).ready(function(){
        nextStep = function(idd,nxt,step,iddd){
            if(nxt == 'next'){
                var ser = $('#'+iddd+' :input').serialize();
                //console.log(ser);
                jQuery.ajax({
                    url:"{{url('get-review-validation-step')}}",
                    type: "post",
                    data: ser,
                    dataType : 'json',
                    success: function(result){
                        //console.log(result);
                        $(".rmvCls").html('');
                        $(".rmvId").removeClass('is-invalid');
                        var count = Object.keys(result).length;
                        //console.log(count);
                        if(count > 0){
                            $.each(result, function (key, value) {
                                //console.log(key);
                                //console.log(value);
                                $("."+key).html(value).show();
                                $("#"+key).addClass('is-invalid');
                            });
                            //$("html, body").animate({ scrollTop: "0" }); 
                            //window.history.pushState('', '', 'companies?'+ser);
                        }else{
                            if(step == 4){
                                var ser = $("#form1").serialize();
                                //console.log(ser);
                                jQuery.ajax({
                                    url:"{{url('get-review-save')}}",
                                    type: "POST",
                                    data: ser,
                                    dataType : 'json',
                                    success: function(result){
                                        console.log(result);
                                    }
                                });    
                            }
                            $(".step").hide();
                            $("#"+idd).show();
                        }    
                    }
                });
            }else{
                $(".step").hide();
                $("#"+idd).show();  
            }
            $("html, body").animate({ scrollTop: "0" });    
        }

        //star rating
        /*$("input[type='radio']").click(function(){
            var sim = $("input[type='radio']:checked").val();
            var name = $("input[type='radio']:checked").attr('name');
            alert(name);
            if (sim<3) { 
                $('.myratings').css('color','white'); 
                $(".myratings").text(sim); 
            }else{ 
                $('.myratings').css('color','white'); 
                $(".myratings").text(sim); 
            } 
        });*/

        addValue = function(idd){
            var sim = $("#"+idd).val();
            var name = $("#"+idd).attr('name');
            //alert(name);
            $("."+name).css('color','white'); 
            $("."+name).text(sim); 
        } 
    });

</script>

@endsection