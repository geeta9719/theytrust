<div class="container portfolio review-portfolio-sec">
    <div class="row">
      <div class="col-lg-12 shadow bg-white py-3">
  
        <div class="row topsec mb-3">
          <div class="col-md-7">
            <div class="row text-center text-md-left">
              <div class="col-md-3">
                <img src="{{ asset($company->logo ?? 'public/images/default-logo.png') }}"
                     class="img-fluid border" style="max-height:150px;" />
              </div>
              <div class="col-md-8 mt-2 mt-md-0">
                <div class="d-flex mt-3 writereview">
                  <h3 class="bg-info text-white rounded-circle p-3 mb-0">
                    {{ number_format($rate_review->rating ?? 0, 1) }}
                  </h3>
                  <div class="ml-2">
                    {!! generateStarRating($rate_review->rating ?? 0) !!}
                  </div>
  
                  {{ $reviews->total() }}
  
                  @auth
                    @if(auth()->id() === $company->user_id)
                      <a href="{{ route('comapany.reviews.request.index') }}" class="text-info ml-2">Request a Review</a>
                    @else
                      <a href="{{ url('company/' . $company->id . '/getReview') }}" class="text-info ml-2" target="_blank">
                        Write a Review
                      </a>
                    @endif
                  @else
                    <a href="javascript:void(0);" class="text-info ml-2" data-toggle="modal" data-target="#login-modal">
                      Write a Review
                    </a>
                  @endauth
                </div>
              </div>
            </div>
          </div>
  
          {{-- Score graph (unchanged) --}}
          <div class="col-md-3 text-left pl-0 graph">
            <div class="d-flex justify-content-center align-items-center">
              <img src="/front_components/images/logo1.png" class="mb-2 graph-img" />
              <span class="font-weight-bold">{{ number_format($company->ttu_score, 0) }} / 100</span>
            </div>
            <svg viewBox="0 0 36 18" class="w-100" style="height: 60px;">
              <path d="M2 16 a14 14 0 0 1 32 0" fill="none" stroke="#e6e6e6" stroke-width="2" />
              <path d="M2 161 a14 14 0 0 1 32 0" fill="none" stroke="#00bdd6" stroke-width="2"
                    stroke-dasharray="{{ ($company->ttu_score / 100) * 50 }} 50" />
            </svg>
          </div>
        </div>
  
        {{-- FILTER BAR (no button, instant apply) --}}
        {{-- FILTER BAR --}}
<div class="d-flex align-items-center gap-2 mb-3">
  <i class="fa fa-filter mr-2"></i>

  {{-- was: $services (id/name) -> now: $serviceOptions (plain strings) --}}
  <select wire:model.live="service" class="form-control form-control-sm mr-2" style="max-width:220px;">
    <option value="">Services</option>
    @foreach($serviceOptions as $opt)
      <option value="{{ $opt }}">{{ $opt }}</option>
      {{-- if you want to be extra-safe for special chars: --}}
      {{-- <option value="{{ $opt }}">{{ e($opt) }}</option> --}}
    @endforeach
  </select>

  <select wire:model.live="sort" class="form-control form-control-sm" style="max-width:220px;">
    <option value="recent">Most Recent</option>
    <option value="highest">Highest Rated</option>
    <option value="lowest">Lowest Rated</option>
  </select>
</div>

  
        <div wire:loading.block class="text-muted small mb-2">Loading…</div>
  
        {{-- Reviews list --}}
        <div class="container mt-1 reviews-sec greybox">
          @foreach ($reviews as $review)
            <x-review :review="$review" />
          @endforeach
  
          <div class="d-flex justify-content-center mt-3">
            {{ $reviews->links() }}
          </div>
        </div>
  
      </div>
    </div>
  </div>
  