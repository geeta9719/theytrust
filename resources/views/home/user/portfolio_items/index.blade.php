@extends('layouts.home-master')

@section('content')

<head>
    <title>Portfolio Listing</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portfolioimage/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('portfolioimage/js/jquery.js') }}"></script>
<script src="{{ asset('portfolioimage/js/tab.js') }}"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Portfolio Items for {{ $company->name }}</h2>
    </div>

    <div class="container portfolio">
        @foreach($portfolioItems as $item)
            <div class="container mt-5 reviews-sec greybox">
                <div class="row case">
                    <div class="col-md-6 mb-3 details order-2 order-md-1">
                        <div class="d-md-flex p-2 mb-2 text-center text-md-left">
                            <div class="ptitle"><button>{{ $item->project_title }}</button></div>
                            <p>{!! $item->client_name !!}</p>
                        </div>
                        <div class="d-md-flex p-2 mb-2 text-center text-md-left">
                            <div class="ptitle"><button>Country / Location</button></div>
                            <p>{!! $item->country_location !!}</p>
                        </div>
                        <div class="d-md-flex p-2 mb-2 text-center text-md-left">
                            <div class="ptitle"><button>Services Provided</button></div>
                            <p>{!! $item->services_provided !!}</p>
                        </div>
                        <div class="d-md-flex p-2 mb-2 text-center text-md-left">
                            <div class="ptitle"><button>Project Duration</button></div>
                            <p>{{ $item->engagement_start_date->format('F Y') }} - {{ $item->engagement_end_date->format('F Y') }}</p>
                        </div>
                        <div class="d-md-flex p-2 mb-2 text-center text-md-left">
                            <div class="ptitle"><button>Project Description</button></div>
                            <p>{!! $item->short_description !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 order-1 order-md-2">
                        <div class="p-2 mb-2">
                            <div class="media-preview">
                                @if($item->media)
                                    @if($item->media['type'] == 'file')
                                        @if(Str::endsWith($item->media['path'], ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/'.$item->media['path']) }}" alt="Current Image">
                                        @elseif(Str::endsWith($item->media['path'], '.pdf'))
                                            <object data="{{ asset('storage/'.$item->media['path']) }}" type="application/pdf" width="100%" height="500px">
                                                <p>Your browser does not support PDFs. <a href="{{ asset('storage/'.$item->media['path']) }}">Download the PDF</a>.</p>
                                            </object>
                                        @elseif(Str::endsWith($item->media['path'], ['.mp4', '.avi']))
                                            <video src="{{ asset('storage/'.$item->media['path']) }}" controls width="100%"></video>
                                        @endif
                                    @elseif($item->media['type'] == 'youtube')
                                        <iframe src="https://www.youtube.com/embed/{{ explode('v=', $item->media['url'])[1] }}" width="100%" height="500px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $portfolioItems->links() }}
        </div>
    </div>
    
    
    
</body>
@endsection
