@extends('layouts.home-master')
@section('content')
<div class="container py-4">
    <h1>Sitemap</h1>

    <h2>Pages</h2>
    <ul>
        @foreach($pages as $page)
            <li><a href="{{ url($page['url']) }}">{{ ucfirst(str_replace(['-', '/'], ' ', trim($page['url'], '/'))) ?: 'Home' }}</a></li>
        @endforeach
    </ul>

    <h2>Companies</h2>
    <ul>
        @foreach($companies as $company)
            <li><a href="{{ url('/profile/' . $company->slug) }}">{{ $company->name }}</a></li>
        @endforeach
    </ul>

    <h2>Categories</h2>
    <ul>
        @foreach($categories as $cat)
            <li><a href="{{ url('/companies/' . $cat->slug) }}">{{ $cat->category }}</a></li>
        @endforeach
    </ul>

    <h2>Subcategories</h2>
<ul>
    @foreach($subcategories as $sub)
        <li>
            <a href="{{ url('/companies/' . $sub->cat_slug . '/' . $sub->sub_slug) . '?order=asc' }}">
                {{ $sub->sub_name }}
            </a>
        </li>
    @endforeach
</ul>

<h2>Sub-Subcategories</h2>
<ul>
    @foreach($subsubcategories as $child)
        <li>
            <a href="{{ url('/companies/' . $child->cat_slug . '/' . $child->sub_slug . '/' . $child->subchild_slug) . '?order=asc' }}">
                {{ $child->subchild_name }}
            </a>
        </li>
    @endforeach
</ul>

<h2>Skills</h2>
<ul>
    @foreach($skills as $skill)
        <li>
            <a href="{{ url('/companies/' . $skill->cat_slug . '/' . $skill->sub_slug . '/' . $skill->subchild_slug . '/' . $skill->skill_slug) . '?order=asc' }}">
                {{ $skill->skill_name }}
            </a>
        </li>
    @endforeach
</ul>


</div>
@endsection
