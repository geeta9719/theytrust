<!DOCTYPE html>
<html lang="en">
    @include('home.partials._header')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <body>
        @stack('styles')
        <!-- Navbar -->
        @include('home.partials._navbar')
        <!-- /.navbar -->

        @yield('content')


        
        @include('home.partials._foot')
        
        @include('home.partials._footer')
        
        @yield('script')

    </body>
</html>