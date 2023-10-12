<!DOCTYPE html>
<html lang="en">
    @include('home.partials._header')
    <body>
        
@include('home.partials._navbar')
<link rel="stylesheet" href="{{asset('front_components/css/select2.min.css')}}" />

<section class="d-flex align-items-center justify-content-center" style="height:60vh !important" >
    <div class="container my-5 ">
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    </div>
</section>

@include('home.partials._foot-end')

   

    </body>
</html>

