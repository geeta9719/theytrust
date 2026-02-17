@php
    use Carbon\Carbon;
@endphp

<style>
    .portfolio .ptitle button {
        color: #00bdd6;
        background-color: #ebfdff !important;
        border-color: #00bdd6 !important;
    }
</style>
<div class="row case">
    <div class="col-md-6 mb-3 details">
        <div class="d-md-flex pb-md-1 pl-md-3 mb-0 text-center text-md-left">
            <div class="ptitle"><button>Project Title</button></div>
            <p>{{ $portfolio->project_title }}</p>
        </div>
        <div class="d-md-flex pb-md-1 pl-md-3 mb-0 text-center text-md-left">
            <div class="ptitle"><button>Client Name</button></div>
            <p>{{ $portfolio->client_name }}</p>
        </div>
        <div class="d-md-flex pb-md-1 pl-md-3 mb-0 text-center text-md-left">
            <div class="ptitle"><button>Country / Location</button></div>
            <p>{{ $portfolio->country_location }}</p>
        </div>
        <div class="d-md-flex pb-md-1 pl-md-3 mb-0 text-center text-md-left">
            <div class="ptitle"><button>Services Provided</button></div>
            <p>{{ is_array($portfolio->services_provided) ? implode(', ', $portfolio->services_provided) : $portfolio->services_provided }}</p>
        </div>
        <div class="d-md-flex pb-md-1 pl-md-3 mb-0 text-center text-md-left">
            <div class="ptitle"><button>Project Duration</button></div>
            <p>
                {{ $portfolio->engagement_start_date->format('F Y') }} -
                {{ $portfolio->engagement_end_date->format('F Y') }}
            </p>
        </div>
        <div class="d-md-flex p-2 mb-2 text-md-left">
            <div class="ptitle mb-2 mb-md-0">
                <button>Project Description</button>
            </div>
        
            <div class="pl-md-3 flex-fill text-left" style="max-width: 900px; word-break: break-word; line-height: 1.6;">
                {!! $portfolio->short_description !!}
            </div>
        </div>
        
    </div>
    <div class="col-md-6 mb-3">
        <div class="p-2 mb-2">
            @if (is_array($portfolio->media) && count($portfolio->media) > 0)
                {{-- {{ dd($portfolio->media) }} --}}
                @foreach ($portfolio->media as $media)
                    @php
                        $extension = pathinfo($media, PATHINFO_EXTENSION);
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png']);
                        $isPDF = $extension === 'pdf';
                        // {{dd($media);}}
                        $isYouTube = strpos($media, 'youtube.com') !== false || strpos($media, 'youtu.be') !== false;

                        // Build correct image URL: Azure path vs local vs full URL
                        if (Str::startsWith($media, ['http://', 'https://'])) {
                            $mediaUrl = $media;
                        } elseif (Str::startsWith($media, 'portfolio/') || Str::startsWith($media, 'logos/')) {
                            $mediaUrl = rtrim(env('AZURE_STORAGE_URL', ''), '/') . '/' . env('AZURE_STORAGE_CONTAINER', 'company-logos') . '/' . $media;
                        } else {
                            $mediaUrl = asset('storage/' . $media);
                        }
                    @endphp

                    @if ($isImage)
                        <img src="{{ $mediaUrl }}" alt="" class="w-100 mb-3" />
                    @elseif ($isPDF)
                        <embed
                            src="{{ $mediaUrl }}"
                            width="100%"
                            height="500px"
                            type="application/pdf"
                            class="mb-3"
                        />
                    @elseif ($isYouTube)
                        @php
                            // Extract YouTube video ID
                            if (strpos($media, 'youtu.be') !== false) {
                                $videoId = substr(parse_url($media, PHP_URL_PATH), 1);
                            } else {
                                parse_str(parse_url($media, PHP_URL_QUERY), $queryParams);
                                $videoId = $queryParams['v'] ?? null;
                            }
                        @endphp

                        @if (isset($videoId))
                            <iframe
                                width="100%"
                                height="315"
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                class="mb-3"
                            ></iframe>
                        @endif
                    @endif
                @endforeach
            @else
                <p>No media available.</p>
            @endif
        </div>
    </div>
</div>
{{-- </div> --}}
