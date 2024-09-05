@extends('layouts.home-master')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
    @import url(https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
    @import url(https://fonts.googleapis.com/css?family=Calibri:400,300,700);
    .rating {
        border: none;
        margin-right: 49px
    }
    .spanRating {
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
    /* .rating>[id^="scheduling"] {
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
    } */
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
    /* .rating>[id^="refer_to_friend"] {
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
    } */
/* sneha */
.rating>[id^="timeliness"] {
        display: none
    }
    .rating>[id^="timeliness"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }
    .rating>[id^="timeliness"]:checked+label:hover,
    .rating>[id^="timeliness"]:checked~label:hover,
    .rating>label:hover~[id^="timeliness"]:checked~label,
    .rating>[id^="timeliness"]:checked~label:hover~label {
        color: #FFED85
    }


    .rating>[id^="communication"] {
        display: none
    }
    .rating>[id^="communication"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }
    .rating>[id^="communication"]:checked+label:hover,
    .rating>[id^="communication"]:checked~label:hover,
    .rating>label:hover~[id^="communication"]:checked~label,
    .rating>[id^="communication"]:checked~label:hover~label {
        color: #FFED85
    }


    .rating>[id^="expertise"] {
        display: none
    }
    .rating>[id^="expertise"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }
    .rating>[id^="expertise"]:checked+label:hover,
    .rating>[id^="expertise"]:checked~label:hover,
    .rating>label:hover~[id^="expertise"]:checked~label,
    .rating>[id^="expertise"]:checked~label:hover~label {
        color: #FFED85
    }

    .rating>[id^="ease_of_working"] {
        display: none
    }
    .rating>[id^="ease_of_working"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }
    .rating>[id^="ease_of_working"]:checked+label:hover,
    .rating>[id^="ease_of_working"]:checked~label:hover,
    .rating>label:hover~[id^="ease_of_working"]:checked~label,
    .rating>[id^="ease_of_working"]:checked~label:hover~label {
        color: #FFED85
    }

    .rating>[id^="refer_ability"] {
        display: none
    }
    .rating>[id^="refer_ability"]:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #FFD700
    }
    .rating>[id^="refer_ability"]:checked+label:hover,
    .rating>[id^="refer_ability"]:checked~label:hover,
    .rating>label:hover~[id^="refer_ability"]:checked~label,
    .rating>[id^="refer_ability"]:checked~label:hover~label {
        color: #FFED85
    }


/* sneha */

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
    .tag-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 2px 10px;
    margin-right: 5px;
    border-radius: 3px;
    font-size: 0.875em;
}

.tag-label .remove-tag {
    margin-left: 5px;
    font-weight: bold;
    cursor: pointer;
}
</style>
<section class="container-fluid signin-banner animatedParent hero-section ">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
             
            </div>
        </div>
    </div>
</section>

<section class="formbox container">

    <div class="row  ">

        <div class="col-lg-12">
        
            <div class="col-lg-12  form-size">

                <form action="" method="POST" class="" id="form1">

                    <!-- was-validated -->

                    <input type="hidden" name="company_id" value="{{$company->id}}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <!-- Step 1 Start -->
                    
                    <div class="project step" id="project">
                        
                        @csrf

                        {{-- <input type="hidden" name="form" value="form1"> --}}
                        
                        <h5>About Project</h5>

                        <span>Provide some preliminary information about the project you are reviewing</span>
                        
                        <div class="form-group pt-4">

                            <label for="project_type">Choose project type</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control rmvId" id="project_type" name="project_type" required>
                                <option value="">Select a value</option>
                                @foreach($category as $cat)
                                @foreach($cat->subcategory as $c)
                                <option value="{{$c->subcategory}}">{{$c->subcategory}}</option>
                                @endforeach
                                @endforeach
                            </select>

                            <div class="invalid-feedback project_type rmvCls"></div>

                        </div>

                        <div class="form-group">

                            <label for="project_title">Write a title for the project</label><strong style="color: red;">*</strong>
                            <input type="text" class="form-control rmvId" id="project_title" placeholder="Enter Title" name="project_title" required />
                            <div class="invalid-feedback project_title rmvCls"></div>

                        </div>



                        <div class="form-group">

                            <label for="company_type">Choose your company type</label><strong style="color: red;">*</strong>
                            
                            <select class="form-control rmvId" id="company_type" name="company_type" required>

                                <option value="">Select a value</option>
                                
                                @foreach($category as $cat)
                                    <option value="{{$cat->category}}">{{$cat->category}}</option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback company_type rmvCls"></div>
                        </div>

                        <div class="form-group">
                            
                            <label for="title">Project value range</label><strong style="color: red;"> *</strong>
            
                            <select class="form-control rmvId" id="cost_range" name="cost_range" required>
                                
                                <option value="">Select a value</option>
                                
                                @foreach($budget as $b)
                                <?php 
                                    $bb = explode('-',$b['budget']);
                                    $bud = '$'.$bb[0].' - $'.$bb[1];
                                   
                                    ?>
                                <option value="{{ $b['budget'] }}">{{ $bud }}</option>
                                @endforeach
                            
                            </select>

                            <div class="invalid-feedback cost_range rmvCls"></div>

                        </div>
                        
                        
                        <div class="form-group">
                            <label for="project_start">Project start date</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control date1 rmvId" id="project_start" placeholder="yyyy-mm-dd" name="project_start" required />
                            <div class="invalid-feedback project_start rmvCls"></div>
                        </div>


                        <div class="form-group">
                            <label for="project_end">Project finish date</label><strong style="color: red;"> *</strong>
                            <input type="text" class="form-control date1 rmvId" id="project_end" placeholder="yyyy-mm-dd" name="project_end" required />
                            <div class="invalid-feedback project_end rmvCls"></div>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="nextStep('review','next','1','project')">Next Section</button>

                    </div>

                    <!-- Step 1 END -->

                    <!-- Step 1 Start -->

                    <div class="review step" id="review" style="display: none;">
                        
                        @csrf
                        
                        <input type="hidden" name="form" value="form2">
                        
                        <h5>Detailed Information about the project</h5>
                        
                        <div class="form-group pt-4">
                            <h5> Company information </h5>
                            <div class="form-group ">
                                <label for="company_position"> Please tell us about your business and what is your role</label><strong style="color: red;"> * </strong>
                                <textarea class="form-control rmvId" id="company_position" name="company_position" required></textarea>
                                <div class="invalid-feedback company_position rmvCls"></div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <h5> Problem Statement </h5>
                            <div class="form-group">
                                
                                <label for="for_what_project">What specific challenges were you facing before working with {{$company->name}}                             </label>
                                
                                <strong style="color: red;"> *</strong>

                                <textarea class="form-control rmvId" id="for_what_project" placeholder="" name="for_what_project" required></textarea>
                                
                                <div class="invalid-feedback for_what_project rmvCls"></div>
                            </div>
                        </div>

                        <div class="form-group">
                                
                            <label for="area_of_improvements">What were your main concerns or pain points related to your project?
                            </label>
                            
                            <strong style="color: red;"> *</strong>
                            
                            <textarea class="form-control rmvId" id="area_of_improvements" placeholder="" name="area_of_improvements" required></textarea>
                            
                            <div class="invalid-feedback area_of_improvements rmvCls"></div>

                        </div>

                        <div class="form-group pt-4">

                            <h5> Engagement </h5>

                            <div class="form-group">
                                <label for="scope_of_work">Tell us about the project in detail</label><strong style="color: red;"> *</strong>
                                <textarea class="form-control rmvId" id="scope_of_work" name="scope_of_work" required></textarea>
                                <div class="invalid-feedback scope_of_work rmvCls"></div>
                            </div>
                            
                            <div class="form-group ">
                                <label for="how_select">What services did you receive from <b>{{$company->name}}? <b>  for eg. Digital Marketing, Web design, Mobile App development)
                                </label><strong style="color: red;"> *</strong>
                                <select id="how_select" name="how_select[]" class="form-control" multiple="multiple"></select>
                                <span class="error-message">Please enter 2 or more characters</span>
                            </div>

                            
                            {{-- <input type="text" id="how_select" class="form-control" placeholder="Type to search or create a tag"> --}}

                            <div class="form-group pt-4">
                                
                                <label for="team_composition">What factors led to the selection of the vendor
                                </label>
                                
                                <strong style="color: red;"> *</strong>

                                <textarea class="form-control rmvId" id="team_composition" name="team_composition" required/></textarea>

                                <div class="invalid-feedback team_composition rmvCls"></div>
                            </div>

                        </div>

                        <div class="form-group pt-4">

                            <h5> Success Story / Solution Provided
                            </h5>
                            
                            <div class="form-group">
                                
                                <label for="any_outcome">Talk about how the vendor made this project a success</label>
                                
                                <strong style="color: red;"> *</strong>
                                
                                <textarea class="form-control rmvId" id="any_outcome" placeholder="" name="any_outcome" required></textarea>

                                <div class="invalid-feedback any_outcome rmvCls"></div>
                            </div>
                            
                            <div class="form-group pt-4">
                                
                                <label for="how_effective">In what ways have the services positively impacted your business? (eg. increased sales, improved brand awareness, Enhanced user engagement)
                                </label>

                                <strong style="color: red;"> *</strong>
                                
                                <textarea class="form-control rmvId" id="how_effective" name="how_effective" required></textarea>
                                
                                <div class="invalid-feedback how_effective rmvCls"></div>
                            </div>

                            <div class="form-group">
                                
                                <label for="most_impressive">What were the top 3 things that impressed you the most about the vendor (eg. communication, expertise, creativity, process etc)Is there anything else you would like to share about your experience</label>
                                <strong style="color: red;"> *</strong>
                                
                                <textarea class="form-control rmvId" id="most_impressive" placeholder="" name="most_impressive" required></textarea>

                                <div class="invalid-feedback most_impressive rmvCls"></div>

                            </div>


                        </div>

                        <div class="form-group pt-4">
                            
                            <h4> Rate the vendor on a 5 point scale for the following parameters </h4>
                            
                            <?php
                                
                                $arr = array(       'quality'           => 'Quality', 
                                                    'timeliness'        => 'Timeliness',
                                                    'cost'              => 'Cost',
                                                    'communication'     => 'Communication',
                                                    'expertise'         => 'Expertise', 
                                                    'ease_of_working'   => 'Ease of working', 
                                                    'refer_ability'     => 'Refer-ability', 
                                                    'overall_rating'    => 'Overall rating'
                                            );
                            ?>

                            @foreach( $arr as $key => $val )

                            <div class="form-group">

                                <div>
                                    
                                    <label for="{{$key}}">{{$val}}</label>
                                    
                                    <strong style="color: red;"> *</strong>

                                </div>

                                <div class="rating" style="float:left;">
                                    
                                    <?php

                                    for( $i=5; $i>0; $i-- )
                                    {
                                        if( $i == 5 )
                                        {
                                        ?>
                                            <input type="radio" id="{{$key}}{{$i}}" name="{{$key}}" value="{{$i}}" onclick="addValue('{{$key}}{{$i}}')" />
                                            <label class="full" for="{{$key}}{{$i}}" title="Awesome - {{$i}} stars"></label>
                                    <?php     
                                        }
                                        else
                                        {
                                            $j = $i + 0.5;
                                        ?>
                                            <input type="radio" id="{{$key}}{{$i}}half" name="{{$key}}" value="{{$j}}" onclick="addValue('{{$key}}{{$i}}half')" />
                                            <label class="half" for="{{$key}}{{$i}}half" title="Pretty good - {{$j}} stars"></label>
                                            <input type="radio" id="{{$key}}{{$i}}" name="{{$key}}" value="{{$i}}" onclick="addValue('{{$key}}{{$i}}')" />
                                            <label class="full" for="{{$key}}{{$i}}" title="Pretty good - {{$i}} stars"></label>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="spanRating" style="float:left;"> <span class="myratings {{$key}}" style="margin:0 auto;">0</span></div>

                                <div class="invalid-feedback {{$key}} rmvCls"></div>

                                <input type="text" class="form-control rmvId" id="{{$key}}_review" name="{{$key}}_review" required placeholder="Explain your rating">

                                <div class="invalid-feedback {{$key}}_review rmvCls"></div>

                            </div>

                            @endforeach

                        </div>

                        <button type="button" class="btn btn-primary" onclick="nextStep('project','back','2','review')"> < </button> 
                        <button type="button" class="btn btn-primary" onclick="nextStep('reviewer','next','2','review')">Next Section</button>

                    </div>

                    <!-- Step 2 END -->


                    <!-- Step 1 Start -->

                    <div class="reviewer step" id="reviewer" style="display: none;">
                        
                        @csrf
                        
                        <input type="hidden" name="form" value="form3">

                        <h5>Tell us about yourself.</h5>
                      
                        <div class="form-group pt-4">
                            
                            <label for="full_name">Full Name</label>

                            <strong style="color: red;"> *</strong>
                            
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{auth()->user()->name}}" required>
                            
                            <div class="invalid-feedback full_name rmvCls"></div>
                        </div>


                        <div class="form-group">
                            <label for="position_title">Position</label>
                            <input type="text" class="form-control" id="position_title" name="position_title" />
                            <div class="invalid-feedback position_title rmvCls"></div>
                        </div>


                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" />
                            <div class="invalid-feedback company_name rmvCls"></div>
                        </div>


                        <div class="form-group">
                            
                            <label for="company_size">Company Size</label>

                            <strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="company_size" name="company_size" required>

                                <option value="">Select a value</option>

                                @foreach($size as $k=>$v)
                                    <option value="{{json_decode($v)->size}}">{{json_decode($v)->size}} Employees</option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback company_size rmvCls"></div>
                        </div>

                        <div class="form-group">

                            <label for="country">Country</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="country" name="country" required >
                                
                                <option value="">Select a country.</option>
                                
                                @foreach( $countries as $country )
                                    <option value="{{$country->iso2}}">{{$country->name}}</option>
                                @endforeach;

                            </select>
                            
                            <div class="invalid-feedback country rmvCls"></div>

                        </div>

                        {{-- <div class="form-group">

                            <label for="city_country">State</label>

                            <strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="state" name="state" required>
                                <option value="">Select a state.</option>
                            </select>

                            <div class="invalid-feedback state rmvCls"></div>

                        </div>

                        <div class="form-group">
                            
                            <label for="city">City</label><strong style="color: red;"> *</strong>
                            
                            <select class="form-control" id="city" name="city" required>
                                <option value="">Select a city.</option>
                            </select>
                            
                            <div class="invalid-feedback city rmvCls"></div>

                        </div>
                        --}}
                        <button type="button" class="btn btn-primary" onclick="nextStep('review','back','3','reviewer')"> < </button> 
                        <button type="button" class="btn btn-primary" onclick="nextStep('verify','next','3','reviewer')">Next Section</button>

                    </div>


                    <!-- Step 3 END -->


                    <!-- Step 4 Start -->

                    <div class="verify step" id="verify" style="display: none;">
                       
                        @csrf
                        
                        <input type="hidden" name="form" value="form4">

                        <h5>Contact details</h5>


                        <div class="form-group pt-4">

                            <label for="company_email">Company email</label><strong style="color: red;"> *</strong>
                            
                            <span class="color:red;">The email must match the company URL</span>
                            
                            <input type="text" class="form-control" id="company_email" name="company_email" value="{{auth()->user()->email}}" required />
                            
                            <div class="invalid-feedback company_email rmvCls"></div>

                        </div>

                        <div class="form-group pt-4">
                            <label for="phone_number">Mobile number</label>

                            <strong style="color: red;"> *</strong>
                            
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required />

                            <div class="invalid-feedback phone_number rmvCls"></div>
                        </div>

                        <div class="form-group pt-4">

                            <label for="linkedin_url">Linkedin URL</label>

                            <strong style="color: red;"> *</strong>
                            
                            <input type="text" class="form-control" id="linkedin_url" name="linkedin_url" required placeholder="https://example.com" />

                            <div class="invalid-feedback linkedin_url rmvCls"></div>

                        </div>

                        <div class="form-group pt-4">
                            <label for="company_url">Company URL</label>
                            
                            <input type="text" class="form-control" id="company_url" name="company_url" placeholder="https://example.com" />
                            
                            <div class="invalid-feedback company_url rmvCls"></div>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="nextStep('reviewer','back','4','verify')"> < </button> 
                        <button type="button" class="btn btn-primary" onclick="nextStep('success','next','4','verify')">Submit</button>

                    </div>

                </form>

            <div class="success step" id="success" style="display: none;">
                    
                <h5>Successfully Submitted!</h5>
                    
                <span>Thank you for submitting your review. It is under moderation right now, you will receive an email once it is approved</span>

                <a href="{{url('/')}}" class="btn btn-primary">Back to TheyTrustUs</a>
                    
                <button type="button" class="btn btn-primary" onclick="nextStep('verify','back','5','success')"> < </button> 

            </div> 
        </div> 
    
    </div>
    
    </div> 

</section> 

@endsection 

@section('script') 

<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.css" rel="stylesheet" />

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script type="text/javascript">

    $("#country").change( function () {

        var iso2 = $(this).val();
        
        $('#state').empty();
        
        $.ajax({
            url: "{{ url( '/review/states' ) }}",
            type: "GET",
            data: { iso2: iso2,_token: "{{ csrf_token() }}"},
            success: function (result) {
                $.each(result, function (key, val) {
                    $('#state').append($("<option value='" + key + "'>" + val + "</option>"));
                });
            }
        });
    });
</script>

<script type="text/javascript">

    $("#state").change(function () {
        var state_code   = $(this).val();
        var country_code = $('#country').val();
        $('#city').empty();
        $.ajax({
            url: "{{ url( '/review/cities' ) }}",
            type: "GET",
            data: { state_code: state_code, country_code : country_code, _token: "{{ csrf_token() }}" },
            success: function (result) 
            {
                $.each(result, function (key, val) {
                    $('#city').append( $( "<option value='" + val +"'>" + val + "</option>" ) );
                });
            }
        });
    });
</script>

<script type="text/javascript">

    $("#project_start").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (date) 
        {
            var parts = date.split('-');
            var date = new Date(+parts[0], +parts[1] - 1, +parts[2]);
            date.setDate(date.getDate() + 1);
            var result = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
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

    $(document).ready(function () 
    {
        nextStep = function (idd, nxt, step, iddd) 
        {
            if (nxt == 'next') 
            {
                var ser = $('#' + iddd + ' :input').serialize();
                jQuery.ajax({
                    url: "{{url('get-review-validation-step')}}",
                    type: "post",
                    data: ser,
                    dataType: 'json',
                    success: function (result) 
                    {
                        $(".rmvCls").html('');
                        $(".rmvId").removeClass('is-invalid');
                        var count = Object.keys(result).length;
                        
                        if (count > 0) 
                        {
                            $.each(result, function (key, value) 
                            {
                                $("." + key).html(value).show();
                                $("#" + key).addClass('is-invalid');
                            });
                        } 
                        else 
                        {
                            if (step == 4) 
                            {
                                var ser = $("#form1").serialize();
                                jQuery.ajax({
                                    url: "{{url('get-review-save')}}",
                                    type: "POST",
                                    data: ser,
                                    dataType: 'json',
                                    success: function (result) 
                                    {
                                        console.log(result);
                                    }
                                });
                            }
                            $(".step").hide();
                            $("#" + idd).show();
                        }
                    }
                });
            } 
            else 
            {
                $(".step").hide();
                $("#" + idd).show();
            }
            $("html, body").animate({
                scrollTop: "0"
            });
        }

        addValue = function (idd) 
        {
            var sim = $("#" + idd).val();
            var name = $("#" + idd).attr('name');
            $("." + name).css('color', 'white');
            $("." + name).text(sim);
        }
    });
    $(document).ready(function() {
    // Initialize Select2 with AJAX search and tag creation functionality
    $("#how_select").select2({
      tags: true, // Allow new tags to be created
      placeholder: "Type to search or create a tag",
      minimumInputLength: 2, // Start searching after 2 characters
      multiple: true, // Enable multiple selections
      ajax: {
        url: "{{ route('admin.service-provider.search') }}", // URL for fetching existing tags
        dataType: 'json',
        delay: 250, // Delay to prevent too many requests
        data: function(params) {
          return {
            q: params.term // Send the search term to the server
          };
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              return {
                id: item.id,
                text: item.name
              };
            })
          };
        },
        cache: true
      },
      createTag: function(params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }

        return {
          id: term, // Temporary ID before it's saved on the server
          text: term,
          newTag: true // Mark it as a new tag
        };
      }
    }).on('select2:select', function(e) {
      var data = e.params.data;

      if (data.newTag) {
        // If it's a new tag, send it to the server
        $.ajax({
          url: "{{ route('admin.service-provider.store') }}", // URL to create a new tag
          type: 'POST',
          data: {
            name: data.text, // The new tag name
            _token: '{{ csrf_token() }}' // CSRF token for security
          },
          success: function(response) {
            console.log(response);
            // Replace the temporary ID with the real ID from the server
            var newOption = new Option(response.name, response.id, true, true);
            $('#how_select').find('option[value="' + data.id + '"]').remove(); // Remove the temporary option
            $('#how_select').append(newOption).trigger('change'); // Add the new option with the correct ID
          },
          error: function(xhr, status, error) {
            console.error("Tag creation failed: ", error);
          }
        });
      }
    });

    // Handle removing tags correctly
    $('#how_select').on('select2:unselect', function(e) {
        
      var data = e.params.data;

      // Remove only the selected option
      $('#how_select option[value="' + data.id + '"]').remove();
    });
});

</script>
</script>


@endsection