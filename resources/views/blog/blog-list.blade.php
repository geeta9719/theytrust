@extends('layouts.home-master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<section class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Latest Blog Posts</h2>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">{!! $post['title']['rendered'] !!}</h5>
                    <p class="card-text">{!! Str::limit(strip_tags($post['excerpt']['rendered']), 100) !!}</p>
                    <a href="{{ url('blog/' . $post['id']) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($totalPages > 1)
    <div class="d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                @for ($i = 1; $i <= $totalPages; $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('blogs.list', ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    </div>
    @endif
</section>
@endsection
