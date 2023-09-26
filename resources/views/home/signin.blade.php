<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>They Trust Us</title>
        <link rel="icon" type="image/x-icon" href="{{asset('front/assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('front/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top">They Trust Us</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <!--<li class="nav-item"><a class="nav-link" href="#!">Sign Up</a></li>-->
                        @if(!Auth::check()) 
                        <li class="nav-item"><a class="nav-link" href="{{ url('signin') }}">Sign In</a></li>
                        @else
                        <li class="nav-item">
                            <img src=" @if(auth()->user()->avatar){{auth()->user()->avatar}}@else 
                                {{asset('bower_components/admin-lte/dist/img/AdminLTELogo.png')}}@endif " class="img-circle elevation-2" alt="Admin" width="30" height="30" style="border-radius: 25px;"> 
                            <strong class="text-white">
                                @if(auth()->user()->first_name) Welcome {{auth()->user()->first_name}} @else Me @endif
                            </strong>&nbsp;
                        </li>    
                        <li class="nav-item">
                            <form method="post" action="/logout">
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit">Logout</button>
                            </form> 
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header masthead-->
        <header class=" text-center text-black" style="position: relative;
  overflow: hidden;
  padding-top: calc(7rem + 72px);
  padding-bottom: 7rem;
  background: linear-gradient(0deg, #ccc 0%, #eee 100%);
  background-repeat: no-repeat;
  background-position: center center;
  background-attachment: scroll;
  background-size: cover;">
            <div class="masthead-content">
                <div class="container px-5">
                    @if(!Auth::check())
                    <a href="{{ url('auth/linkedin') }}" class="btn btn-primary text-black"><strong>Login In With LinkedIn</strong></a>
                    <br/><br/>
                    @else
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('user.personal') }}" class="text-black">My User Account</a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <br/><br/><br/><br/><br/><br/><br/><br><br/><br>
                </div>
            </div>
        </header>
        <!-- Content section 1-->
        <!-- Footer-->
        <footer class="py-5 bg-black">
            @if(Auth::check())
            <div class="container px-5">
                <p class="m-0 text-center  small">
                    <a href="{{ route('user.basicInfo',auth()->user()->id) }}" class="text-white">Get Listed</a>
                </p>    
            </div>
            @endif
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('front/js/scripts.js')}}"></script>
    </body>
</html>
