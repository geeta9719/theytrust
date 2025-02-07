<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "q61lnt6ajy");
    </script>
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    @stack('styles')
    @livewireStyles
    @include('home.partials._header')
</head>
<body>

    @include('home.partials._navbar')

    @yield('content')

    <!-- jQuery (Only One Version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS Bundle (Includes Popper.js) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Libraries -->
    <script src="{{ asset('front_components/js/select2.min.js') }}"></script>
    <script src="{{ asset('front_components/js/css3-animate-it.js') }}"></script>
    <script src="{{ asset('front_components/js/slick.js') }}"></script>
    <script src="{{ asset('front_components/js/custom.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Form Validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    @livewireScripts
    @include('home.partials._foot')
    @include('home.partials._footer')
    

    @yield('script')
</body>
</html>
