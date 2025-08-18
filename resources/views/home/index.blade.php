@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://theytrust.us/front_components/css/custom.css">

<!-- Hero Section -->
<section class="container-fluid banner animatedParent hero-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12  animated fast go fadeInLeft text-center">
                {{-- <div class="whitebox"> --}}
                <h3>Enabling Decision Making for <span>B2B Customers</span></h3>
                <!-- <h4><span>Discover Real Businesses with Real Reviews</span> to Choose Your Next Service Provider</h4> -->
                <p>Discover <span>Real Businesses</span> with <span>Real Reviews<span> to Choose Your Next <span>Service
                                Provider<span></p>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>
<!-- Provider Search Section -->
<section class="container-fluid provider-sec-box">
    <div class="provider-sec container">
        <form action="{{ url('listing') }}" method="get" id="searchForm">
            <div class="inner">
                <select class="form-control dropdown1 address" id="subcategories" name="services[]">
                    <option value="">I am looking for…</option>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                            data-name="{{ $subcategory->category->slug . '/' . $subcategory->slug }}">
                            {{ $subcategory->subcategory }}
                        </option>
                    @endforeach
                </select>
                
                <div class="d-flex align-items-center location">
                    <select class="form-control address location dropdown2" id="locations" name="location">
                        <option value="">Select location…</option>
                    </select>
                </div>
                
                <button type="button" class="btn btn-secondary circle-button" id="searchBtn">
                    <i class="icon fa fa-search"></i>
                </button>
                
            </div>
        </form>
    </div>
</section> 
<!-- Recent Reviews Section -->
<section class="container-fluid recent-reviews ">
    <div class="container">
        <h3 class="text-center">Recent Reviews</h3>
        <p class="text-center they">They Cared to Share their Experiences.</p>
        <div class="row">
            
            @foreach($reviews as $review)
            <div class="col-md-6 col-lg-4 reviewby recent mx-auto">
                <div class="greybox">
                    <div class="d-lg-flex userbox brd-line">
                        
                        {{-- <div class="d-lg-flex user-img">

                            <img src="{{ isset($review->company) && $review->company->logo 
                            ? asset($review->company->logo) 
                            : asset('img/black-image.png') }}" 
                            alt=""
                            class="img-fluid d-md-inline d-table mx-auto">
                            <div class="user-name text-center text-md-left">
                                 <h2>
                                    @if(isset($review->company))
                                    <a href="{{ url('profile/' . $review->company->slug) }}">
                                        {{ ucwords(strtolower($review->company->name)) }}
                                    </a>
                                @else
                                    <span>No Company</span>
                                @endif
                                
                            </h2>
                            </div>
                        </div> --}}

                        <div class="d-lg-flex user-img">
                            @php
                                $hasCompany = isset($review->company);
                                $logo = $hasCompany && !empty($review->company->logo)
                                    ? $review->company->logo
                                    : asset('img/black-image.png');
                        
                                // Placeholder image for broken URLs
                                $fallback = asset('img/black-image.png');
                            @endphp
                        
                            <img
                                src="{{ $logo }}"
                                alt="{{ $hasCompany ? $review->company->name : 'No Company' }}"
                                class="img-fluid d-md-inline d-table mx-auto"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ $fallback }}';"
                            >
                        
                            <div class="user-name text-center text-md-left">
                                <h2>
                                    @if($hasCompany)
                                        <a href="{{ url('profile/' . $review->company->slug) }}">
                                            {{ ucwords(strtolower($review->company->name)) }}
                                        </a>
                                    @else
                                        <span>No Company</span>
                                    @endif
                                </h2>
                            </div>
                        </div>
                        
                        <!-- <div class="text-center text-md-left reviewrate">
                            <br> {!! generateStarRating($review['overall_rating']) !!}
                        </div> -->
                    </div>
                    <!-- <p class="dotted"></p> -->
                    <div class="d-lg-flex reviewedbybox review-brd">
                        <p class="dotted"></p>
                        <div class="d-lg-flex user-img ">
                            <h4> <i style="font-size:19px" class="fa"></i> Reviewed By </h4>
                        </div>
                    </div>
                    <div class="d-lg-flex userbox">
                        <div class="d-lg-flex user-img ">
                @php
                       $avatarUrl = $review->user->avatar ??
                       "https://theytrust.us/front_components/images/logo.png";
                       if (!Str::startsWith($avatarUrl, ['http://', 'https://'])) {
                       $avatarUrl = url($avatarUrl);
                    }

                @endphp
                            <img src="{{ $avatarUrl }}" alt=""
                                class="img-fluid d-md-inline d-table mx-auto">
                            <div class="user-name userboxes text-center text-md-left">
                                <h2>{{ $review->full_name }}</h2>
                                <h3>{{ $review->company_name }} | {{ $review->country }}</h3>
                                <h4>{{ $review->position_title }} </h4>
                            </div>
                        </div>
                        <div class="text-center text-md-left reviewrate">
                            <br> {!! generateStarRating($review['overall_rating']) !!}
                        </div>
                    </div>
                    <div class="user-col">
                        <div class="d-lg-flex reviewby pt-2">
                            <div class="ptitle mb-2 mb-lg-0"><button>Project Type</button></div>
                            <div>
                                <p>{{ $review['project_type'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Services Provided</button></div>
                            <div>
                                <p>{{  $review->how_effective }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Project Value</button></div>
                            <div>
                                <p>{{ $review['cost_range'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Client Size</button></div>
                            <div>
                                <p>{{ $review['company_size'] }}</p>
                            </div>
                        </div>
                        <div class="d-lg-flex reviewby pt-1">
                            <div class="ptitle mb-2 mb-lg-0"><button>Client Industry</button></div>
                            <div>
                                <p>{{ $review['client_industry'] }}</p>
                            </div>
                        </div>
                    </div>
                     <p class="dotted "></p>
                    <div class="d-flex reviewby">
                        <div class="ptitle"><button>Detailed Rating</button></div>
                    </div>
                    <div class="qualitybox row">
                        <div class="pt-4 qualityreview">
                            <button>Quality</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['quality']) !!}
                            </div>
                            <button>{{ $review['quality'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Timeliness</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['timeliness']) !!}
                            </div>
                            <button>{{ $review['timeliness'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Cost</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['cost']) !!}
                            </div>
                            <button>{{ $review['cost'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Expertise</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['expertise']) !!}
                            </div>
                            <button>{{ $review['expertise'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Communication</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['communication']) !!}
                            </div>
                            <button>{{ $review['communication'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Ease of Working</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['ease_of_working']) !!}
                            </div>
                            <button>{{ $review['ease_of_working'] }}</button>
                        </div>
                        <div class="pt-4 qualityreview">
                            <button>Referability</button>
                            <div class="star d-flex">
                                {!! generateStarRating($review['refer_ability']) !!}
                            </div>
                            <button>{{ $review['refer_ability'] }}</button>
                        </div>
                    </div>
                    <p class="text-md-right text-center">
                        <a href="{{ url('/profile/' . $review->company->slug) }}#reviews">Read Full Review</a>
                    </p>
                    
                    <!-- <p class="text-right"><a href="#">Read Full Review</a></p> -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="container-fluid categories-section">
    <div class="container">
        <h3 class="">Browse Providers by Category</h3>
        <p class="">Explore service providers in just a click</p>
        <div class="row explorebox ">
            @foreach($categories as $category)
            @if($category->subcategory->isNotEmpty())
            <div class="exploreinner ">
                <div class="col-md-12 ">
                    <h4>{{ $category->category }}</h4>
                    <ul>
                        @foreach($category->subcategory->take(5) as $subcategory)
                        <li><a
                                href="{{ url('companies/'.$category->slug.'/'.$subcategory->slug) }}">{{ $subcategory->subcategory }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <p class="text-md-right text-center browse my-4"><a href="{{ url('providers/category/') }}">Browse All Providers ></a></p>
       </section>
    <section class="container-fluid skills-section">
        <div class="container">
            <h3 class="">Browse Providers by Skills</h3>
            <p class="">Explore service providers with specific skills in a click</p>
            <div class="row ">
                @foreach($subcategories as $subcategory)
                @if($subcategory->subcat_child->isNotEmpty())
                <div class="skill-box">
                    <div class="col-md-12 px-0">
                        <h4>{{ $subcategory->subcategory }}</h4>
                        <ul>
                            @foreach($subcategory->subcat_child->take(5) as $child)
                            <li><a
                                    href="{{ url('companies/'.$subcategory->category->slug.'/'.$subcategory->slug.'/'.$child->slug) }}">{{ $child->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <p class="text-md-right text-center browse my-4"><a href="{{ url('skills') }}">Browse All Skills ></a></p>
        </div>
    </section>
    <section class="container-fluid movers-section">
       <div class="container">
           <h3 class="text-center">Movers & Shakers - Popular Skills</h3>
           <p class="text-center">Explore businesses from some of the most popular service categories</p>
           <div class="row mt-5">
               <div class="col-lg-3 col-md-6">
                   <div class="moversbox">
                       <div class="col-md-12 moverscol1">
                           @foreach($modelReferences as $reference)
                           <div class="ptitle mb-2 mb-lg-0">
                               <button class="foreign-key-btn" data-key="{{ $reference['foreign_key_name'] }}">{{ $reference['foreign_key_name'] }}</button>
                           </div>
                           @endforeach
                       </div>
                   </div>
               </div>
               <div class="col-lg-9 col-md-6 ">
                   {{-- <h3>List of Digital Marketing Agencies</h3> --}}
                   <div class="row" id="companies-list">
                       <!-- Companies will be loaded here via AJAX -->
                   </div>
               </div>
           </div>
       </div>
   </section>

    @endsection


    @section('script')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('front_components/js/select2.min.js')}}"></script>
   
 {{-- <script> --}}
 <script>
  var setAction;

  // simple slugify
  function slugify(str) {
    return (str || "")
      .toString()
      .trim()
      .toLowerCase()
      .normalize('NFKD').replace(/[\u0300-\u036f]/g,'')
      .replace(/[^a-z0-9]+/g,'-')
      .replace(/^-+|-+$/g,'');
  }

  jQuery(function ($) {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

    // load locations on subcategory change
    $('#subcategories').on('change', function () {
      var subcategory_id = $(this).val();
      if (!subcategory_id) {
        $('#locations').html('<option value="">Select location…</option>');
        return;
      }
      $.post("{{ url('get-location') }}", { subcategory_id }, function (res) {
        $('#locations').empty().append(res);
        if ($('#locations').data('select2')) $('#locations').select2('destroy');
        $('#locations').select2 && $('#locations').select2();
        $('#locations').prop('selectedIndex', 0);
      });
    });

    // init selects
    $('#subcategories').select2 && $('#subcategories').select2();
    $('#subcategories').trigger('change');

    // click handler (prevents accidental submit)
    $('#searchBtn').on('click', function () { setAction(); });

    // only submits when both are valid
    setAction = function () {
      const $sub = $('#subcategories').find(':selected');
      const subName = ($sub.data('name') || '').toString().trim();
      const $loc = $('#locations').find(':selected');

      // validate subcategory
      if (!$sub.val() || !subName) {
        alert('Please select a service first.');
        $('#subcategories').focus();
        return false;
      }
      // validate location
      if (!$loc.length || !$loc.val()) {
        alert('Please select a location.');
        $('#locations').focus();
        return false;
      }

      const type    = ($loc.data('type') || '').toString();     // 'country' | 'city'
      const country = ($loc.data('country') || '').toString().trim();
      const city    = ($loc.data('city') || '').toString().trim();

      if (!country || !type) {
        alert('Invalid location option. Please reselect.');
        return false;
      }

      // optional extra segments (if you later add these selects)
      const getSeg = (sel) => $(sel).length ? ( $(sel).find(':selected').data('name') || '' ) : '';
      const category    = getSeg('#categories');
      const subcategory = subName; // from #subcategories
      const skill       = getSeg('#skills');
      const subskill    = getSeg('#subskills');

      const tail = [category, subcategory, skill, subskill]
                    .filter(Boolean).map(slugify).join('/');

      let action = '';
      if (type === 'country') {
        action = `/${country}/companies`;
      } else if (type === 'city') {
        const locationSlug = slugify(city);
        action = `/${country}/${locationSlug}/companies`;
      } else {
        alert('Unsupported location type.');
        return false;
      }

      if (tail) action += `/${subcategory}`;
      window.location.assign(action);
      return false; // safety


    //   $('#searchForm').attr('action', action).trigger('submit');
      return true;
    };
  });
</script>

    @endsection