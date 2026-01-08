<!DOCTYPE html>
<html lang="en">
<head>
    <title id="meta-title">{{ $meta_title ?? 'TheyTrust - Find Top Providers' }}</title>
    <meta name="description" content="{{ $meta_description ?? 'Find trusted providers for all industries.' }}" id="meta-description">
    <meta property="og:title" content="{{ $meta_title ?? 'TheyTrust - Find Top Providers' }}" id="meta-og-title">
    <meta property="og:description" content="{{ $meta_description ?? 'Find trusted providers for all industries.' }}" id="meta-og-description">
    <meta property="og:type" content="website" id="meta-og-type">
    <meta property="og:url" content="{{ url()->current() }}" id="meta-og-url">
    
        @yield('meta')


    <script>
        window.APP = {
            azureUrl: "{{ config('filesystems.disks.azure.url') }}",
            debug: true
        };
    </script>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "q61lnt6ajy");
    </script>
    
    <script src="{{ asset('livewire/livewire.js') }}"></script>


    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    @stack('styles')
   
    @livewireStyles

    @include('home.partials._header')
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NWJHXHZP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    @include('home.partials._navbar')

    @yield('content')

    <!-- jQuery (Only One Version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS Bundle (Includes Popper.js) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Libraries -->
    <script src="{{ asset('public/front_components/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/front_components/js/css3-animate-it.js') }}"></script>
    <script src="{{ asset('public/front_components/js/slick.js') }}"></script>
    <script src="{{ asset('public/front_components/js/custom.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>

    <!-- Form Validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/livewire-v2"></script>


    @livewireScripts
    @include('home.partials._foot')
    @include('home.partials._footer')
    
    <!-- Header Search Enhancement (standalone, no Vue conflict) -->
    <script src="{{ asset('js/header-search.js') }}"></script>

    @yield('script')
</body>
</html>
