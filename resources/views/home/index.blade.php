@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />




<!-- contact section start -->

<!-- banner section start -->

<section class="container-fluid banner animatedParent hero-section">
        <div class="container">
            <div class="row   ">
                <div class="col-lg-7 pr-lg-5 animated fast go fadeInLeft  pt-md-5">
                    <div class="whitebox">
                     
                        <h3>Enabling Reviews <span>and Ratings for Top</span> </h3>
                        <h4><span>B2B companies</span></h4>
                        <p>They Trust Us is instrumental in helping millions of <span>B2B</span> firms establish their
                            trust and visibility for the prospective customers</p>
                        <a href="{{url('about')}}" class="btn btn-primary">They Trust Us</a>
                    </div>
                </div>
                <div
                    class="col-lg-5  text-center pl-lg-5  d-flex justify-content-end pt-5 pt-lg-0 animated fadeInRight fast go">
                    <img src="{{asset('front_components/images/hero-1.png')}}" alt="" class="img-fluid desktop-sec">

                   
                </div>
            </div>
        </div>
    </section>


   <section class="container-fluid">
    <div  class="provider-sec container">

        <form action="{{ url('companies') }}" method="POST" id="searchForm">
            @csrf
            <div class="inner">
                <p>I am looking for</p>

                <select class="form-control dropdown1 address" id="subcategories" name="services[]">
                    <option class="form-control" value=''>e.g. App Development, UX</option>
                    @foreach($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}" data-name="{{strtolower(str_replace(' ','-',$subcategory->subcategory))}}">
                        {{$subcategory->subcategory}}</option>
                    @endforeach
                </select>

               <div class="d-flex align-items-center location">
                <img src="{{asset('front_components/images/map1.png')}}" alt="" class="img-fluid mapcss">
                <!-- <i class="fa fa-map-marker mr-md-5" aria-hidden="true"></i> -->
                <select class="form-control address location dropdown2" id="locations" name="location[]"></select>
               </div>
                <button class="btn btn-secondary" onclick="setAction()">Find Provider</button>
            </div>
        </form>
    </div>
   </section>




    </div>
    </div>
    </div>

<!-- banner section end -->




    <section class="container-fluid agencies text-center animatedParent">
        <div class="container animated fadeInUp slowest">
            <div class="row">
                <div class="col-12 ">
                    <h3>150,000+ Agencies in 500+ Categories</h3>
                    <p>Explore top services and solutions across industries to find the</br>
                        right resource for your business.</p>
                </div>
            </div>
            <div class="row pt-4 equal">
                <div class="col-md-10 d-md-flex d-block mx-auto">
                    <div class="col-lg-6 col-md-6 px-md-1 px-0">
                        <div class="agenciesbox">
                            <img src="{{asset('front_components/images/speaker.png')}}" alt="" class="img-fluid iconimg">
                            <h3><a href="/directory/advertising-&-marketing">Advertising &
                                Marketing Advertising</a></h3>
                            <hr>
                            <h4><a href="/directory/advertising">Advertising</a></h4>
                            <p>Drive business growth and increase brand visibility through targeted advertising
                                strategies and campaigns.</p>
                            <hr>
                            <h4><a href="/directory/branding">Branding</a></h4>
                            <p>Establish a unique and memorable brand identity that reflects your values and resonates
                                with your target audience.
                            </p>
                            <hr>
                            <h4><a href="/directory/content%20marketing">Content Marketing</a></h4>
                            <p>Create and distribute relevant, engaging content to attract, educate, and convert
                                potential customers.</p>
                            <a href="/directory/advertising-&-marketing"><img src="{{asset('front_components/images/btn.png')}}" alt="" class="img-fluid iconbtn"></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 px-md-1 px-0">
                        <div class="agenciesbox">
                            <img src="{{asset('front_components/images/icon2.png')}}" alt="" class="img-fluid iconimg">
                            <h3><a href="/directory/development">Development</a></h3>
                            <hr>
                            <h4><a href="/directory/ar%20&%20vr%20development">AR and VR Development</a></h4>
                            <p>Unlock the potential of Augmented Reality (AR) and Virtual Reality (VR) with our expert
                                AR/VR development services.
                            </p>
                            <hr>
                            <h4><a href="/directory/android%20app%20development">Android App Development</a></h4>
                            <p>Establish a unique and memorable brand identity that reflects your values and resonates
                                with your target audience.</p>
                            <hr>
                            <h4><a href="/directory/artificial%20intelligence">Artificial Intelligence</a></h4>
                            <p>Harness the power of AI to revolutionise your business and drive innovation.
                            </p>
                            <a href="/directory/development"><img src="{{asset('front_components/images/btn.png')}}" alt="" class="img-fluid iconbtn mt-0"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-2 mt-0 equal">
                <div class="col-md-10 d-md-flex d-block mx-auto">
                    <div class="col-lg-6 col-md-6 px-md-1 px-0">
                        <div class="agenciesbox">
                            <img src="{{asset('front_components/images/icon3.png')}}" alt="" class="img-fluid iconimg">
                            <h3><a href="/directory/supply-chain-&-logistics">Supply Chain and
                                Logistics</a></h3>
                            <hr>
                            <h4><a href="/directory/air%20freight">Air Freight</a></h4>
                            <p>Fast and reliable transportation of goods by air to meet urgent delivery requirements and
                                optimise supply chain efficiency.
                            </p>
                            <hr>
                            <h4><a href="/directory/container%20shipping">Container Shipping</a></h4>
                            <p>Secure and efficient shipping of goods in standardised containers, providing
                                cost-effective and scalable logistics solutions.
                            </p>
                            <hr>
                            <h4><a href="/directory/custom%20brokerage">Custom Brokerage</a></h4>
                            <p>Expert assistance navigating complex customs regulations and procedures, ensuring smooth
                                clearance and compliance for international trade transactions.</p>
                            <a href="/directory/supply-chain-&-logistics"><img src="{{asset('front_components/images/btn.png')}}" alt="" class="img-fluid iconbtn"></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 px-md-1 px-0">
                        <div class="agenciesbox">
                            <img src="{{asset('front_components/images/icon4.png')}}" alt="" class="img-fluid iconimg">
                            <h3> <a href="/directory/accounting-&-finance">Accounting and
                                Finance</a></h3>
                            <hr>
                            <h4> <a href="/directory/accounting">Accounting</a></h4>
                            <p>Comprehensive financial management and reporting solutions for businesses of all sizes.

                            </p>
                            <hr>
                            <h4> <a href="/directory/bookkeeping">Bookkeeping</a></h4>
                            <p>Accurate and efficient tracking of financial transactions to ensure precise financial
                                records.</p>
                            <hr>
                            <h4> <a href="/directory/forensic%20accounting">Forensic Accounting</a></h4>
                            <p>Expert analysis and investigation to uncover financial fraud and provide litigation
                                support.
                            </p>
                            <a href="/directory/accounting-&-finance"><img src="{{asset('front_components/images/btn.png')}}" alt="" class="img-fluid iconbtn mt-0 mt-md-0"></a>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="container-fluid  trust-row animatedParent">
        <div class="container trust-row animatedParent">
            <div class="row">
                <div class="col-lg-6 pr-md-5 animated fadeInLeft slower">
                    <div class=" col-md-9 mx-auto">
                        <img src="{{asset('front_components/images/storymen.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6   text-left pt-lg-5 mt-5 animated fadeInRight slower">
                    <div class="storybox col-md-9 mx-auto">
                        <h3 class="mb-4">They Trust.us Story So Far...</h3>
                        <p class="mb-lg-5">Hear the idea that got us started, the experiences that shape our path, and
                            the
                            values that
                            influence our approach.</p>
                            <a href="/about/"> <button class="btn btn-primary">They Trust.us</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid testimonial pb-5 animatedParent">
        <div class="container animated fadeInUp slower">
            <h3 class="text-center">Why Top Firms & Decision Makers  <span>Trust They Trust.us </span></h3>
            <p class="text-center"> Hear what companies have to say about their experience using They Trust.us
            </p>
            <div class="row pt-5">
                <div class="col-md-12 mb-5 mb-md-0">
                    <div class="testimonialbox">

                        <img src="{{asset('front_components/images/testi-icon.png')}}" alt="" class="img-fluid">
                    
                    <div class="col-md-8 mx-auto">
                        <div class="testimonials-slider">

                            <div>
                                <h4>Jason Perry
                                <span>Engagency</span></h4>
                                <p>They Trust.us is the best way to reach our audience and validate our commitment to providing
                                    exceptional service.”</p>
                               </div>
        
                              
                            <div>
                                <h4>Jason Perry
                                <span>Engagency</span></h4>
                                <p>They Trust.us is the best way to reach our audience and validate our commitment to providing
                                    exceptional service.”</p>
                               </div>
        
                              
                            <div>
                                <h4>Jason Perry
                                <span>Engagency</span></h4>
                                <p>They Trust.us is the best way to reach our audience and validate our commitment to providing
                                    exceptional service.”</p>
                               </div>
        
                         </div>
                    </div>
                    </div>
                  
                </div>

            </div>
        </div>
    </section>

    <section class="container-fluid profile pt-5  animatedParent">
        <div class=" text-center container">
            <h3 class="animated fadeInLeft slower">Create a Company Profile</h3>
            <p class="text-white my-4 animated fadeInLeft slower">Get your company in front of
                 <span>500,000+ buyers in <br class="d-inline d-md-none">
                    20 minutes or less.</span></p>
            <div class="d-md-flex d-block align-items-center" style="justify-content: center;"><button
                    class="btn btn-primary animated fadeInRight slower">They Trust us </button> <button
                    class="btnb btnb-primary animated fadeInRight slower">Learn More </button></div>


        </div>
    </section>
    <!-- contact section -->


   
    <!-- contact section end-->









@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('front_components/js/select2.min.js')}}"></script>
<script>
    var setAction;
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        jQuery('#subcategories').on('change', function () {
            var subcategory_id = jQuery(this).val();
            //alert(subcategory_id)
            jQuery.ajax({
                url: "{{ url('get-location') }}",
                method: "POST",
                data: {
                    subcategory_id: subcategory_id
                },
                success: function (res) {
                    jQuery('#locations').empty();
                    jQuery('#locations').append(res);
                    //console.log(res);
                }
            });
        });
        /**/
        setAction = function () {
            var service = $("#subcategories").find(':selected').data('name')
            var location = $("#locations").find(':selected').attr('data-name')
            if (location == undefined || location == '') {
                $('#searchForm').attr("action", "{{url('directory')}}/" + service);
            } else {
                $('#searchForm').attr("action", "{{url('directory')}}/" + service + '/' + location);
            }
            $('#searchForm').submit();
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#subcategories').select2();
    });
</script>
@endsection