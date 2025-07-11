@extends('layouts.home-master')
@section('title', strip_tags($post['title']['rendered']))
@section('content')

<style>
  .blog-hero {
    position: relative;
    height: 420px;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 2rem;
  }
  .blog-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(60%);
  }
  .blog-hero-content {
    position: absolute;
    bottom: 20px;
    left: 30px;
    z-index: 2;
    color: #fff;
  }
  .blog-hero-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
  }
  .blog-hero-content .meta {
    font-size: 0.95rem;
    font-weight: 400;
    color: #e0e0e0;
  }
  .blog-content-area {
    font-size: 1.125rem;
    line-height: 1.9;
    color: #212529;
  }
  .blog-content-area img {
    max-width: 100%;
    border-radius: 10px;
    margin: 1.5rem 0;
  }
  .blog-content-area h2, .blog-content-area h3, .blog-content-area h4 {
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1c1c1c;
  }
  .blog-content-area p {
    margin-bottom: 1.25rem;
  }
  .blog-content-area blockquote {
    border-left: 4px solid #28a745;
    padding-left: 15px;
    color: #555;
    font-style: italic;
    background: #f9f9f9;
    margin: 1.5rem 0;
  }
  .blog-toc {
    background: #f8f9fa;
    padding: 15px;
    border-left: 4px solid #28a745;
    margin: 2rem 0;
  }
  .blog-toc h5 {
    color: #28a745;
    margin-bottom: 10px;
  }
  .blog-toc ul {
    padding-left: 1rem;
  }
  .blog-toc ul li a {
    text-decoration: none;
    color: #343a40;
  }
  .blog-toc ul li a:hover {
    color: #28a745;
  }
</style>

<section class="container py-5">
  @if(!empty($post['_embedded']['wp:featuredmedia'][0]['source_url']))
    <div class="blog-hero">
      <img src="{{ $post['_embedded']['wp:featuredmedia'][0]['source_url'] }}" alt="Featured Image">
      <div class="blog-hero-content">
        <h1>{!! $post['title']['rendered'] !!}</h1>
        <div class="meta">
          {{ \Carbon\Carbon::parse($post['date'])->format('F d, Y') }}
          @if(!empty($post['_embedded']['author'][0]['name']))
            &nbsp;| {{ $post['_embedded']['author'][0]['name'] }}
          @endif
        </div>
      </div>
    </div>
  @endif

  <div class="row justify-content-center">
    <div class="col-lg-10">

      {{-- Optional Table of Contents if present --}}
      @if(str_contains($post['content']['rendered'], 'id="ez-toc-container"'))
        <div class="blog-toc">
          <h5>Table of Contents</h5>
          {!! $post['content']['rendered'] ? Str::of($post['content']['rendered'])->after('id=\"ez-toc-container\"')->before('</nav></div>') : '' !!}
        </div>
      @endif

      <div class="blog-content-area">
        {!! $post['content']['rendered'] !!}
      </div>

      <div class="mt-5">
        <a href="{{ route('blogs.list') }}" class="btn btn-outline-success">
          <i class="fas fa-arrow-left me-2"></i> Back to Blog
        </a>
      </div>

    </div>
  </div>
</section>
@endsection
