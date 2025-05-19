<div class="row align-items-center mb-4">
    <div class="col-md-3 text-center">
        <img src="{{ asset($company->logo ?? 'public/images/default-logo.png') }}" class="img-fluid border" style="max-height: 150px;" />
    </div>
    <div class="col-md-6">
        <h2 class="h3 font-weight-bold">{{ $company->name }}</h2>
        <h4 class="h5 text-muted">{{ $company->tagline }}</h4>
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
                    @if(auth()->user()->id === $company->user_id)
                        <a href="{{ route('comapany.reviews.request.index') }}" class="text-info">Request a Review</a>
                    @else
                        <a href="{{ url('company/' . $company->id . '/getReview') }}" class="text-info" target="_blank">Write a Review</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="mt-3 d-flex flex-wrap">
            <div class="mr-4"><strong>Hourly Rate:</strong> {{ $company->rate }}</div>
            <div class="mr-4"><strong># of Employees:</strong> {{ $company->size }}</div>
            <div><strong>Min Project Size:</strong> {{ $company->budget }}</div>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <img src="/front_components/images/logo.png" class="mb-2" style="max-width: 60px;" />
        <svg viewBox="0 0 36 18" class="w-100" style="height: 60px;">
            <path d="M2 16 a14 14 0 0 1 32 0" fill="none" stroke="#e6e6e6" stroke-width="2" />
            <path d="M2 16 a14 14 0 0 1 32 0" fill="none" stroke="#00bdd6" stroke-width="2" stroke-dasharray="{{ ($company->ttu_score / 100) * 50 }} 50" />
        </svg>
        <div class="mt-2 font-weight-bold">{{ number_format($company->ttu_score, 0) }} / 100</div>
    </div>
</div>

<div class="row border-top pt-4">
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
    <div class="col-md-3">
        <h4 class="mb-3">Target Industries</h4>
        <div class="d-flex flex-wrap">
            @foreach ($add_industry as $industry)
                <span class="badge badge-light border text-dark mb-2 mr-2">
                    {{ $industry->industry->name }}
                </span>
            @endforeach
        </div>
    </div>
</div>


<div class="border-top pt-4">
    <h4>Agency Profile</h4>
    <p class="mb-2 text-muted short-description">{{ $company->short_description }}</p>
    <a href="javascript:void(0);" id="read-more-btn" class="text-info text-decoration-underline">READ MORE</a>
</div>

<div class="border-top pt-4">
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
