<div class="row align-items-center company-profile-sec mb-4">
    <div class="col-md-2 text-left pl-0">
        <img src="{{ asset($company->logo ?? 'public/images/default-logo.png') }}" class="img-fluid border" style="max-height: 150px;" />
    </div>
    <div class="col-md-7">
        <h2 class="h3 font-weight-bold company-name">{{ $company->name }}</h2>
        <h4 class="h5 text-muted tagline">{{ $company->tagline }}</h4>
        <div class="d-flex align-items-center flex-wrap mt-2">
            <div class="mr-3 d-flex align-items-center">
                <h3 class="bg-info text-white rounded-circle p-3 mb-0">{{ number_format($rate_review->rating, 1) }}</h3>
                <div class="ml-2">{!! generateStarRating($rate_review->rating) !!}</div>
            </div>
            <div>
                @if ($reviews_count > 0)
                    {{-- <a href="{{ url('review/' . $company->id) }}" target="_blank" class="text-info"> --}}
                        <strong>{{ $reviews_count }} Reviews</strong>
                    {{-- </a> --}}
                @else
                    <span class="text-muted">No Reviews</span>
                @endif
                <br />
                @auth
                @if(auth()->id() === $company->user_id)
                    <a href="{{ route('comapany.reviews.request.index') }}" class="text-info">
                        Request a Review
                    </a>
                @else
                    <a href="{{ url('company/' . $company->id . '/getReview') }}" class="text-info" target="_blank">
                        Write a Review
                    </a>
                @endif
            @else
            <a href="javascript:void(0);" 
            class="text-info" 
            data-toggle="modal" 
            data-target="#login-modal">
             Write a Review
         </a>
            @endauth
            
            </div>
        </div>
        <div class="mt-3 d-flex flex-wrap">
            <div class="mr-4 rate-box"><strong>Hourly Rate:</strong><span> {{ $company->rate }}</span></div>
            <div class="mr-4  rate-box"><strong># of Employees:</strong><span> {{ $company->size }}</span></div>
            <div class="rate-box"><strong>Min Project Size:</strong> <span>{{ $company->budget }}</span></div>
        </div>
    </div>
    <div class="col-md-3 text-left pl-0 graph">
       <div class="d-flex justify-content-center align-items-center"><img src="/front_components/images/logo1.png" class="mb-2 graph-img"  /><span class=" font-weight-bold">{{ number_format($company->ttu_score, 0) }} / 100</span> </div> 
        <svg viewBox="0 0 36 18" class="w-100" style="height: 60px;">
            <path d="M2 16 a14 14 0 0 1 32 0" fill="none" stroke="#e6e6e6" stroke-width="2" />
            <path d="M2 16 a14 14 0 0 1 32 0" fill="none" stroke="#00bdd6" stroke-width="2" stroke-dasharray="{{ ($company->ttu_score / 100) * 50 }} 50" />
        </svg>
        <!-- <div class="font-weight-bold">{{ number_format($company->ttu_score, 0) }} / 100</div> -->
    
    </div>
</div>

<div class="row border-top pt-4 target-service-area-sec">
    <div class="col-md-9">
        <h4 class="mb-3">Target Services Area</h4>
        <div class="row">
            @foreach ($service_lines as $service)
                <div class="col-sm-6 d-flex align-items-center mb-3">
                    <div class="d-inline-block mr-3">
                        <canvas class="progress-circle" width="60" height="60" data-percentage="{{ $service->percent }}"></canvas>
                    </div>
                    <div>
                        <strong>{{ $service->category->category }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3 target-box">
        <h4 class="mb-3">Target Industries</h4>
        <div class="d-flex flex-wrap">
            @forelse ($add_industry as $ind)
                @php
                    // Adjust these property names if needed:
                    $indName = $ind->industry->name ?? ($ind->name ?? 'Industry');
                    $indPct  = (int) ($ind->percent ?? ($ind->percent ?? 40));
                @endphp
                <div class="ttu-pill d-flex align-items-center mb-3 ">
                    <canvas class="progress-circle" data-percentage="{{ $indPct }}"></canvas>
                    <span class="ttu-pill-text ml-2">{{ $indName }}</span>
                </div>
            @empty
                <div class="text-muted">No industries added.</div>
            @endforelse
        </div>
 <h4 class="mb-3">Market Size</h4>
    <div class="d-flex flex-wrap">
        @forelse ($market_sizes as $ms)
            @php
                $msName = $ms->name
                          ?? ($ms->market_size->name ?? 'Market Size'); // e.g., "1-10", "11-50", etc.
                $msPct  = (int) ($ms->percent
                          ?? ($ms->pivot->percent ?? 40));           // default 40 if missing
            @endphp
            <div class="ttu-pill d-flex align-items-center mb-3 ">
                <canvas class="progress-circle" data-percentage="{{ $msPct }}"></canvas>
                <span class="ml-2 ttu-pill-text">{{ $msName }}</span>
            </div>
        @empty
            <div class="text-muted">No market size data.</div>
        @endforelse
    </div>
    </div>
    <!-- <div class="col-md-6 mb-4">
      <h4 class="mb-3">Market Size</h4>
      <div class="d-flex flex-wrap">
        @forelse ($market_sizes as $ms)
            @php
                $msName = $ms->name
                          ?? ($ms->market_size->name ?? 'Market Size'); // e.g., "1-10", "11-50", etc.
                $msPct  = (int) ($ms->percent
                          ?? ($ms->pivot->percent ?? 40));           // default 40 if missing
            @endphp
            <div class="ttu-pill d-flex align-items-center mb-3 mr-4">
                <canvas class="progress-circle" data-percentage="{{ $msPct }}"></canvas>
                <span class="ml-2">{{ $msName }}</span>
            </div>
        @empty
            <div class="text-muted">No market size data.</div>
        @endforelse
     </div>
    </div> -->
</div>


<div class="border-top agency-profile-sec pt-4 my-md-2">
    <h4>Agency Profile</h4>
    <p class="mb-2 text-muted short-descriptio">{!! nl2br(e($company->short_description)) !!}
    </p>
    {{-- <a href="javascript:void(0);" id="read-more-btn" class="text-info text-decoration-underline">READ MORE</a> --}}
</div>

<div class="border-top pt-4 locations-sec">
    <h4>Locations</h4>
    <div class="row">
        <div class="col-md-5">
            @foreach ($addresses as $address)
                <p class="mb-1"><strong>{{ $address->city }}</strong></p>
                <p class="mb-3 text-muted">{{ $address->autocomplete }}</p>
            @endforeach
        </div>
        <div class="col-md-7">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3265.698617944585!2d-80.71237452423959!3d35.064273372792705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x885425c5285ababf%3A0x6980335b83dbd955!2s1003%20Sultana%20Ln%2C%20Matthews%2C%20NC%2028104%2C%20USA!5e0!3m2!1sen!2sin!4v1722940683978!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="container mt-3 mt-md-3 p-0 reviews-sec web-sec greybox border-bottom">
    <h2 class="my-heading">Reviews</h2>

    @if($reviews->count() > 0)
        @foreach ($reviews->take(1) as $review)
            <x-review :review="$review" />
        @endforeach
    @else
        <p class="text-muted">This is a new company, so the user has not given a review for this company.</p>
    @endif
</div>

<div class="container mt-3 mt-md-3 p-0 reviews-sec greybox case-sec border-bottom">
    <h4 class="">Portfolio / Case Studies</h4>

    @if($caseStudies->count() > 0)
        @foreach ($caseStudies->take(1) as $caseStudy)
            <x-portfolio :portfolio="$caseStudy" />
        @endforeach
    @else
        <p class="text-muted">No portfolio or case study has been added for this company yet.</p>
    @endif
</div>


