<!DOCTYPE html>
<html lang="en">

@livewireStyles
    @include('home.partials._header')
    <body>
        @stack('styles')
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('front_components/js/select2.min.js') }}"></script>
        <script src="{{asset('front_components/js/css3-animate-it.js')}}"></script>
        <script src="{{asset('front_components/js/slick.js')}}"></script>
        <script src="{{asset('front_components/js/custom.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
      
        @include('home.partials._navbar')

        @yield('content')
   



        @livewireScripts
        @include('home.partials._foot')
        
        @include('home.partials._footer')
        
        @yield('script')

    </body>
</html>