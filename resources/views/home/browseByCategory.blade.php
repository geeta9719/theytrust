@extends('layouts.home-master')

@section('content')
    <style>
        .maincard .collapse {
            background-color: #fff;
        }

        .inner-subcat h3 {
            color: #2cc8dd;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
        }

        .card-body {
            padding: 0;
        }

        .card {
            border: 0;
        }

        .card-body a {
            color: #5b6371;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            padding: 5px 0px 5px 51px;
            text-decoration: none;
            display: flex;
            width: 100%;
        }

        .innercard .collapsed a::after {
            display: none;
        }

        a.collapsed::after {
            transform: rotate(-90deg);
        }

        .innercard a::after,
        .heading-bg a::after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            background-image: url('https://theytrust-us.developmentserver.info/front_components/images/arrow.png');
            background-size: contain;
            background-repeat: no-repeat;
            margin-left: 5px;
            position: relative;
        }

        .inner-subcat ul {
            margin: 0;
            padding: 0;
        }

        .inner-subcat ul li {
            color: #828892;
            list-style: none;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
        }

        .heading-bg {
            background-color: #ebfdff;
            padding: 8px 0 !important;
            margin-bottom: 4px;
        }

        .card-header {
            border: 0;
            padding: 0;
        }

        .innercard a {
            color: #5b6371;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            margin-left: 0;
            text-decoration: none;
            width: 100%;
            display: flex;
            padding: 11px 25px;
            align-items: center;
        }

        .innercard {
            margin-bottom: 0px;
            background-color: #a6f5ff;
            margin-top: 4px;
        }

        .innercard .d-flex {
            width: 100%;
        }

        .innercard .category-link,
        .heading-bg .subcategory-link {
            flex: 1;
            text-decoration: none;
        }

        .accordion-arrow {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 15px;
            font-size: 14px;
            color: #5b6371;
            display: flex;
            align-items: center;
        }

        .accordion-arrow::after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            background-image: url('https://theytrust-us.developmentserver.info/front_components/images/arrow.png');
            background-size: contain;
            background-repeat: no-repeat;
        }

        .accordion-arrow.collapsed::after {
            transform: rotate(-90deg);
        }

        .innercard a::after,
        .heading-bg a::after {
            display: none;
        }
    </style>

    <div class="container">
        <div id="accordion">
            @foreach ($categories as $index => $category)
                @if ($category->subcategories->count())
                    <div class="card maincard">
                        <div class="card-header innercard" id="heading-{{ $category->id }}">
                            <h5 class="mb-0 d-flex align-items-center justify-content-between">
                                <a class="category-link" href="/companies/{{ $category->slug }}">
                                    {{ $category->category }}
                                </a>
                                <button
                                    class="accordion-arrow {{ $index !== 0 ? 'collapsed' : '' }}"
                                    data-toggle="collapse"
                                    data-target="#collapse-{{ $category->id }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse-{{ $category->id }}"
                                ></button>
                            </h5>
                        </div>
                        <div
                            id="collapse-{{ $category->id }}"
                            class="collapse {{ $index === 0 ? 'show' : '' }}"
                            data-parent="#accordion"
                            aria-labelledby="heading-{{ $category->id }}"
                        >
                            <div class="card-body">
                                <div id="accordion-{{ $category->id }}">
                                    @foreach ($category->subcategories as $subcategory)
                                        @if ($subcategory->subcat_child->count())
                                            <div class="card">
                                                <div
                                                    class="card-header heading-bg"
                                                    id="heading-{{ $category->id }}-{{ $subcategory->id }}"
                                                >
                                                    <h5 class="mb-0 d-flex align-items-center justify-content-between">
                                                        <a class="subcategory-link" href="/companies/{{ $category->slug }}/{{ $subcategory->slug }}">
                                                            {{ $subcategory->subcategory }}
                                                        </a>
                                                        <button
                                                            class="accordion-arrow collapsed"
                                                            data-toggle="collapse"
                                                            data-target="#collapse-{{ $category->id }}-{{ $subcategory->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $category->id }}-{{ $subcategory->id }}"
                                                        ></button>
                                                    </h5>
                                                </div>
                                                <div
                                                    id="collapse-{{ $category->id }}-{{ $subcategory->id }}"
                                                    class="collapse"
                                                    data-parent="#accordion-{{ $category->id }}"
                                                    aria-labelledby="heading-{{ $category->id }}-{{ $subcategory->id }}"
                                                >
                                                    <div class="card-body">
                                                        <div id="accordion-{{ $category->id }}-{{ $subcategory->id }}">
                                                            <div class="inner-subcat">
                                                                <div class="row px-md-5 my-md-4 mx-md-3">
                                                                    @foreach ($subcategory->subcat_child as $subcat_child)
                                                                        @if ($subcat_child->skill->count())
                                                                            <div class="col-md-2 col-4 mt-3 mt-md-0">
                                                                                <h3>
                                                                                    <a href="/companies/{{ $category->slug }}/{{ $subcategory->slug }}/{{ $subcat_child->slug }}">
                                                                                        {{ $subcat_child->name }}
                                                                                    </a>
                                                                                </h3>
                                                                                <ul>
                                                                                    @foreach ($subcat_child->skill as $skill)
                                                                                        <li>
                                                                                            <a href="/companies/{{ $category->slug }}/{{ $subcategory->slug }}/{{ $subcat_child->slug }}/{{ $skill->slug }}">
                                                                                                {{ $skill->name }}
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

{{-- Scripts already loaded via home-master layout (jQuery 3.6.0 + Bootstrap 4.5.2 bundle) --}}
