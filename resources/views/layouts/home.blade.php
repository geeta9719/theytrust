<!DOCTYPE html>
<html lang="en">
    @include('home.partials._header')
    <body>
        
        <!-- Navbar -->
        @include('home.partials._navbar-condition')
        <!-- /.navbar -->

        @yield('content')
        
        @include('home.partials._foot2')
        @include('home.partials._footer')
        
        @yield('script')

    </body>
</html>