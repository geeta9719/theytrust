@extends('layouts.home-master')
@section('content')

<style>
    .card-hover img {
        transition: transform 0.3s ease;
        max-height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card-hover:hover img {
        transform: scale(1.05);
    }

    .badge-category {
        background-color: #28a745;
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        text-transform: uppercase;
    }

    .read-more-btn {
        color: #28a745;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .read-more-btn:hover {
        text-decoration: underline;
        transform: translateX(3px);
    }

    .card-title {
        font-size: 1rem;
        min-height: 48px;
        overflow: hidden;
    }

    .card-text {
        font-size: 0.9rem;
        color: #333;
        min-height: 60px;
        overflow: hidden;
    }
</style>

<section class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-success">Knowledge Center</h2>

    <div class="row g-4">
        @foreach($posts as $post)
        <div class="col-md-6 col-lg-4 d-flex">
            <div class="card border-0 shadow-sm h-100 card-hover w-100 d-flex flex-column">
                @if($post['image'])
                <div class="position-relative">
                    <img src="{{ $post['image'] }}" class="card-img-top img-fluid" alt="{{ strip_tags($post['title']) }}" loading="lazy">
                    {{-- <span class="badge-category position-absolute top-0 start-0 m-2">Health Care</span> --}}
                </div>
                @endif

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <p class="text-muted small mb-2">
                            By <strong>{{ $post['author'] }}</strong> • {{ $post['date'] }}
                        </p>
                        <h5 class="card-title fw-bold">{!! Str::limit(strip_tags($post['title']), 70) !!}</h5>
                        <p class="card-text">{!! Str::limit(strip_tags($post['excerpt']), 100) !!}</p>
                    </div>

                    <a href="{{ url('/blog-summary/' . $post['slug']) }}" class="read-more-btn mt-3">
                        Read More <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($totalPages > 1)
    <div class="d-flex justify-content-center mt-5">
        <nav>
            <ul class="pagination">
                <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('blogs.list', ['page' => $page - 1]) }}" aria-label="Previous">
                        &laquo;
                    </a>
                </li>
                @for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('blogs.list', ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $page == $totalPages ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ route('blogs.list', ['page' => $page + 1]) }}" aria-label="Next">
                        &raquo;
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    @endif
</section>

@endsection
