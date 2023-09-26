@extends('layouts.home-master')

@section('content')

        <link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}"/>

		<section class="container-fluid banner animatedParent hero-section">
            <div class="row container mx-auto align-items-center px-0">
                <div class="col-lg-6 pr-lg-5 animated fadeInLeft slower">
                    <div class="whitebox">
                        <img src="{{asset('front_components/images/circle1.png')}}" alt="" class="circle1 animated growIn delay-1000">
                        <img src="{{asset('front_components/images/circle2.png')}}" alt="" class="circle2 animated growIn delay-1250">
                        <h3>Enabling Reviews and</br> Ratings for Top <span>B2B </br>companies</span> </h3>
                        <p><span>They Trust Us</span> is instrumental in helping millions of B2B firms
                            establish their trust and visibility for the prospective customers</p>
                        <a href="#" class="btn btn-primary">They Trust Us</a>
                    </div>
                </div>
                <div class="col-lg-6  text-center pl-lg-5  d-flex justify-content-end pt-5 pt-lg-0 animated fadeInRight slower">
                    <div class="bannerright w-100">
                        <h3> I am looking for</h3>
                        <form action="{{ url('companies') }}" method="POST" id="searchForm">
                            <!--{{ url('companies') }}-->
							@csrf
	                        <div class="form-group my-3">
                                <div class="location-bg">
    	                            <!--<input type="" class="form-control post" placeholder="e.g. App Development, UX">-->
    	                            <select class="form-control address"  id="subcategories" name="services[]">
    									<option value=''>e.g. App Development, UX</option>
    									@foreach($subcategories as $subcategory)
    									<option value="{{$subcategory->id}}" data-name="{{strtolower(str_replace(' ','-',$subcategory->subcategory))}}">{{$subcategory->subcategory}}</option>
    									@endforeach
    								</select>
                                </div>    
	                        </div>
	                        <h3> In</h3>
	                        <div class="form-group my-3">
                                <div class="location-bg">
	                               <select class="form-control address location" id="locations" name="location[]"></select>
                                </div>   
	                        </div>
                            <!--<button class="btn btn-primary">Find Provider</button>-->
	                        <span class="btn btn-primary" onclick="setAction()">Find Provider</span>
	                    </form>    
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid agencies text-center animatedParent">
            <div class="container animated fadeInUp slowest">
                <div class="row">
                    <div class="col-12 ">
                        <h3>150,000+ Agencies in 500+ Categories</h3>
                        <p>Explore top services and solutions across industries to find the</br>
                            right resource for your business.</p>
                    </div>
                </div>
                <div class="row pt-5 mt-4 equal">
                    <?php $j = 0;?>
                    @foreach($category as $categories)
                    <div class="col-lg-3 col-md-6 px-4 px-md-1">
                        <div class="agenciesbox">
                            <img src="{{asset('front_components/images/icons.png')}}" alt="">
                            <h3>{{ ucfirst($categories->category)}}</h3>
                            <?php $i = 0;?>
                            @foreach($categories->subcategory as $subcategories)
                                @if($subcategories->top_subcat == 1)
                                <hr><h4><a href="{{url('directory',$subcategories->subcategory)}}">{{$subcategories->subcategory}}</a></h4>
                                <p>{{$subcategories->description}}</p>
                                @endif
                                <?php 
                                $i++;
                                if($i == 3){break;}
                                ?>
                            @endforeach
                        </div>
                    </div>
                    <?php 
                    $j++;
                    if($j == 4){break;}
                    ?>
                    @endforeach

                </div>
            </div>
            <div class="container trust-row animatedParent">
                <div class="row">
                    <div class="col-lg-6 pr-md-5 animated fadeInLeft slower">
                        <img src="{{asset('front_components/images/imgleft.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6   text-left pt-lg-5 mt-5 animated fadeInRight slower">
                        <h3 class="mb-4">They Trust.us Story So Far...</h3>
                        <p class="mb-lg-5">Hear the idea that got us started, the experiences that shape our path, and the
                            values that
                            influence our approach.</p>
                        <span class="btn btn-primary">They Trust.us <span style="margin-left: 3px; font-weight: 900;">></span></span>
                    </div>
                </div></div>
        </section>
        <!-- <section class="container-fluid  trust-row animatedParent">
            <div class="container trust-row animatedParent">
                <div class="row">
                    <div class="col-lg-6 pr-md-5 animated fadeInLeft slower">
                        <img src="images/imgleft.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6   text-left pt-lg-5 mt-5 animated fadeInRight slower">
                        <h3 class="mb-4">They Trust.us Story So Far...</h3>
                        <p class="mb-lg-5">Hear the idea that got us started, the experiences that shape our path, and the
                            values that
                            influence our approach.</p>
                        <button class="btn btn-primary">They Trust.us <span style="margin-left: 3px; font-weight: 900;">></span></button>
                    </div>
                </div></div>
        </section> -->
        <section class="container-fluid testimonial pb-5 animatedParent">
            <div class="container animated fadeInUp slower">
                <h3 class="text-center">Why Top Firms & Decision Makers Trust <span>They Trust.us </span></h3>
                <p class="text-center"> Hear what companies have to say about their experience using <span>They Trust.us
                    </span></p>
                <div class="row pt-4">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <div class="testimonialbox">
                            <h3>They Trust.us is the best way to reach our audience and validate our commitment to providing
                                exceptional service.”</h3>
                            <img src="{{asset('front_components/images/comment-left.png')}}" alt="">
                        </div>
                        <div class="row testimonialname pt-5 align-items-center">
                            <div class="col-md-2 col-4 ">
                                <img src="{{asset('front_components/images/circlebg.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-5 col-8">
                                <p>Jason Perry</p>
                                <span>Engagency</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5 mb-md-0">
                        <div class="testimonialbox">
                            <h3>They Trust.us is the best way to reach our audience and validate our commitment to providing
                                exceptional service.”</h3>
                            <img src="{{asset('front_components/images/comment-left.png')}}" alt="">
                        </div>
                        <div class="row testimonialname pt-5 align-items-center">
                            <div class="col-md-2 col-4 ">
                                <img src="{{asset('front_components/images/circlebg.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-5 col-8">
                                <p>Jason Perry</p>
                                <span>Engagency</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('front_components/js/select2.min.js')}}"></script>
<script>
    var setAction;
    jQuery(document).ready(function(){
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        jQuery('#subcategories').on('change', function(){

            var subcategory_id = jQuery(this).val();
            //alert(subcategory_id)
            jQuery.ajax({
                url:"{{ url('get-location') }}",
                method:"POST",
                data:{subcategory_id:subcategory_id},
                success:function(res){
                    jQuery('#locations').empty();
                    jQuery('#locations').append(res);
                    //console.log(res);
                }
            });
        });

        /**/
        setAction = function(){
            var service = $("#subcategories").find(':selected').data('name')
            var location = $("#locations").find(':selected').attr('data-name')
            if(location == undefined || location == ''){
                $('#searchForm').attr("action","{{url('directory')}}/"+service);
            }else{
                $('#searchForm').attr("action","{{url('directory')}}/"+service+'/'+location); 
            }
            
            $('#searchForm').submit();
        }

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#subcategories').select2();
    });
</script>
@endsection