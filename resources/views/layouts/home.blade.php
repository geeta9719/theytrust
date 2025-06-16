<!DOCTYPE html>
<html lang="en">
    @include('home.partials._header')
    <body>
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NWJHXHZP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- Navbar -->
        @include('home.partials._navbar-condition')
        <!-- /.navbar -->

        @yield('content')

        @include('home.partials._foot2')
        @include('home.partials._footer')

        @yield('script')
    </body>
</html>
