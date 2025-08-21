@extends('layouts.home-master')
@section('title', ($company->name ?? 'Agency').' – Reviews')

@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('portfolioimage/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('portfolioimage/css/style.css') }}">
<style>
  .starbox{margin-top:-8px}
  .topsec h3{margin-top:-2px}
  .short-description{overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;line-height:1.5;max-height:3em;position:relative}
  .short-description.expanded{-webkit-line-clamp:unset;max-height:none}
  .reviewuppercase{color:#000}
  .writereview{align-items:baseline}
  .write{text-decoration:underline;color:#3ed1f2 !important;font-size:14px;font-weight:400;font-family:"Inter",sans-serif}
  .btn-group.review-tabs{display:flex;justify-content:space-between;gap:8px;flex-wrap:wrap}
  .btn-group .btnbox{width:100%;text-align:center;border:1px solid #fff;font-size:13px;font-family:"Inter",sans-serif;font-weight:400;color:#fff;display:flex;align-items:center;justify-content:center;padding:7px 12px}
  .btn-group .fa{font-size:15px;color:#fff;margin-right:5px}
  .btng{background:#00bdd6 !important}
  .btndg{background:#0095a9 !important}
  .btnp{background:#b9a8e4 !important}
  .review-portfolio-sec .bluestar{color:#3ed1f2}
  .writereview h3{background:#006d7c;padding:11px;border-radius:63%;color:#fff !important;margin:0}
  .writereview a{font-size:17px;font-weight:700;font-family:"Epilogue",sans-serif}
  @media (max-width:767px){
    .writereview a{font-size:14px}
    .portfolio .reviewrate{display:block!important;font-size:15px;margin-top:-17px!important}
    .sidebar-review-box .userbox{display:block}
    .review-portfolio-sec .write{font-size:12px}
    .btn-group.review-tabs{display:block}
    .btn-group .btnbox{padding:7px 12px;margin-bottom:8px}
  }
  .badge-limit{background:#ffe9a8;color:#7a5700;border:1px solid #f2cf6e}
</style>
@endpush

@push('scripts')
<script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
<script src="{{ asset('portfolioimage/js/tab.js') }}"></script>
@endpush

@section('content')
<div class="container mb-3">
  {{-- breadcrumb --}}
  <nav aria-label="breadcrumb" class="mt-2">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/listing') }}">Listing</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/profile/'.$company->id) }}">{{ $company->name ?? 'Agency' }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Reviews</li>
    </ol>
  </nav>

  {{-- top tabs --}}
  <div class="btn-group review-tabs mb-4">
    <a href="{{ url('/profile/'.$company->id) }}" class="btng btnbox"><i class="fa fa-user-o"></i> PROFILE</a>
    <a href="{{ url('/company/'.$company->id.'/reviews') }}" class="btndg btnbox"><i class="fa fa-star-o"></i> REVIEWS</a>
    <a href="{{ url('/company/'.$company->id.'/portfolio') }}" class="btng btnbox"><i class="fa fa-briefcase"></i> PORTFOLIO</a>
    <a href="{{ url('/company/'.$company->id.'/bundles') }}" class="btng btnbox"><i class="fa fa-gift"></i> BUNDLES</a>
    <a href="{{ url('/company/'.$company->id.'/projects') }}" class="btng btnbox"><i class="fa fa-laptop"></i> PROJECTS</a>
    <a href="{{ url('/request-quote/'.$company->id) }}" class="btnp btnbox"><i class="fa fa-usd"></i> REQUEST A QUOTE</a>
    <a href="{{ $company->website ?? '#' }}" @if(!empty($company->website)) target="_blank" rel="nofollow" @endif class="btnp btnbox"><i class="fa fa-globe"></i> WWW</a>
  </div>
</div>

<div class="container portfolio review-portfolio-sec">
  <div class="row">
    <div class="col-lg-12 shadow bg-white py-3">
      <div class="row topsec mb-3">
        <div class="col-md-7">
          <div class="row text-center text-md-left">
            <div class="col-md-3">
              <img src="{{ $company->logo_url ?? 'https://theytrust.us/storage/images/logo/JPs1fNEQ5UCGh1xu2NqD54a4QIlN4BIErWAy9NF0.png' }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-8 mt-2 mt-md-0">
              <div class="d-flex mt-3 writereview">
                {{-- avg rating (replace $avgRating if you pass it) --}}
                @php
                  $avg = isset($avgRating) ? $avgRating : round(\App\Models\CompanyReview::where('company_id',$company->id)->avg('rating') ?? 0, 1);
                  $full = floor($avg); $half = ($avg - $full) >= 0.5 ? 1 : 0; $empty = 5 - $full - $half;
                  $total = method_exists($reviews,'total') ? $reviews->total() : $reviews->count();
                @endphp
                <h3>{{ number_format($avg,1) }}</h3>
                <div class="px-3 starbox">
                  @for($i=0;$i<$full;$i++) <i class="fa fa-star bluestar"></i> @endfor
                  @if($half) <i class="fa fa-star-half-o bluestar"></i> @endif
                  @for($i=0;$i<$empty;$i++) <i class="fa fa-star-o bluestar"></i> @endfor
                </div>
                <a href="{{ url('/profile/'.$company->id.'#reviewsec') }}" target="_blank" class="mr-2 reviewuppercase">
                  {{ $total }} Reviews
                  @if(!($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator))
                    <span class="badge badge-limit ml-1">With Limit</span>
                  @endif
                </a>
                <a href="{{ url('/company/'.$company->id.'/getReview') }}" class="write">Write a Review</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5 text-md-right">
          <div class="reviews-row text-center">
            <img src="https://theytrust.us/front_components/images/score.png" alt="Score" class="img-fluid">
          </div>
        </div>
      </div>

      <div class="container mt-1 reviews-sec greybox">
        @forelse ($reviews as $review)
          <x-review :review="$review" />
        @empty
          <div class="text-center py-4 text-muted">No reviews yet.</div>
        @endforelse

        @if ($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator)
          <div class="d-flex justify-content-center">
            {{ $reviews->onEachSide(1)->links() }}
          </div>
        @endif
      </div>

    </div>
  </div>
</div>
@endsection
