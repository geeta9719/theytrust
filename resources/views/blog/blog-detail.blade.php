@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4">
                <h1 class="fw-bold mb-3">{!! $post['title']['rendered'] !!}</h1>
                <div class="d-flex align-items-center mb-2">
                    <i class="far fa-calendar-alt me-2"></i>
                    <span class="text-muted small">Published on {{ date('F j, Y', strtotime($post['date'])) }}</span>
                </div>
                @if(!empty($post['_embedded']['author'][0]['name']))
                <div class="d-flex align-items-center mb-2">
                    <i class="far fa-user me-2"></i>
                    <span class="text-muted small">Created by {{ $post['_embedded']['author'][0]['name'] }}</span>
                </div>
                @endif
                @if(!empty($post['_embedded']['wp:featuredmedia'][0]['source_url']))
                <img src="{{ $post['_embedded']['wp:featuredmedia'][0]['source_url'] }}" alt="{{ $post['title']['rendered'] }}" class="img-fluid rounded mb-4 w-100">
                @endif
                <hr>
            </div>

            <div class="blog-content">
                {!! $post['content']['rendered'] !!}
            </div>

            <div class="mt-5">
                <a href="{{ route('blogs.list') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Blog</a>
            </div>
        </div>
    </div>
</section>
@endsection
