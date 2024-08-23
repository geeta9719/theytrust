<?php
use App\Models\Category;
use App\Models\Company;
use App\Models\Subcategory;
// $categories = Category::where('top_cat', 1)->get();
$categories = Category::with("subcategory")->where('top_cat', 1)->get();


$cd = '';
if (Auth::check()) {
   $uid = auth()->user()->id;
   $cd = Company::select('*')->where('user_id', '=', $uid)->first();
}
?>
<link
    href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">


<!-- <div class="header-container">
   <section class="container header position-relative py-md-4 mb-3 mb-md-0 ">
       <nav class="navbar navbar-expand-xl  navbar-dark px-0 d-flex align-items-center">
           <a class="navbar-brand" href="/">
               <img src="{{ asset('front_components/images/logo.png') }}" alt="" class="logo">
           </a>
           <div class="right-section d-lg-flex d-xl-none d-none">
               <div class="input-group ">
                   <input type="text" class="form-control search" name="search" id="search" placeholder="Search"
                       onkeyup="search()">
                   <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-search"></i></span>
                   </div>
               </div>
           </div>




           <div class="d-block d-xl-none">
               @if (!Auth::check())
               <a class="nav-link brdnone modal-signin px-0" href="#" data-toggle="modal" data-target="#singin-modal">
                   <img src="https://theytrust-us.developmentserver.info/front_components/images/user1.png" alt="">
               </a>
              @else
                   <li class="nav-item dropdown">
                   <div class="dropdown">
                       <button type="button" class=" " data-toggle="dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                               <img src="
                           {{-- @if (auth()->user()->avatar) {{auth()->user()->avatar}} @else --}}
                           {{ asset('front_components/images/user1.png') }}
                            {{-- @endif --}}
                             " class="img-circle elevation-2" width="50px" style="border-radius: 25px;"> Me
                           </a>
                       </button>
                       <div class="dropdown-menu shadow-sm mobiledrp">
                           <a class="dropdown-item" href="{{ route('user.personal') }}">My User Account</a>
                           @if ($cd)
                               <a class="dropdown-item" href="{{ route('company.dashboard', $cd->id) }}">Company
                               Dashboard</a>
                           <a class="dropdown-item" href="{{ url('/sponsorship') }}">Change Your Plan</a>
                           <a class="dropdown-item" href="{{ route('user.allinfo', auth()->user()->id) }}">Update
                               Company Profile</a>
                           @else
                           <a class="dropdown-item" href="{{ url('get-listed') }}">Update Company Profile 1</a>
                           @endif
                           <form method="post" action="/logout">
                               @csrf
                               <button class="btn btn-sm btn-primary btnLogout logoutbtn" type="submit">Logout</button>
                           </form>
                       </div>
                   </div>




















               </li>
               @endif
           </div>
           {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
               <span class="navbar-toggler-icon"></span>
           </button> --}}
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           @if (Auth::check())
@php $cls = 'afterLogin' @endphp
@else
@php $cls = '' @endphp
@endif
           {{-- <div class="collapse navbar-collapse {{$cls}}" id="collapsibleNavbar"> --}}
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav topheader align-items-center">
                       <li class="nav-item  ">
                           <a class="nav-link services-tab" href="javascript:void(0)">Services <span
                                   class="drop-arrow down"></span></a>
                           <div class="accordion" id="myAccordion">
                               <?php $i = 1; ?>
                               {{-- @foreach ($categoriese as $category) --}}
<div class="accordion-item">
                                   <h2 class="accordion-header">
                                       <div class="d-flex align-items-center justify-content-between pr-2">
                                           {{-- {{ $category->category }} --}}
                                           <button class="accordion-toggle">+</button>
                                       </div>
                                   </h2>
                                   <div class="accordion-content">
                                       <div class="card-body">
                                           {{-- @foreach ($category->subcategory as $sub_cat)
<a
                                               href="{{ url('directory/' . strtolower($sub_cat->subcategory)) }}">{{ $sub_cat->subcategory }}</a>
@endforeach --}}
                                       </div>
                                   </div>
                               </div>
                               {{-- <?php $i++; ?> --}}
{{-- @endforeach --}}
                           </div>
                       </li>
                       <li class="nav-item ">
                           <a class="nav-link " href="#">Blog</a>
                       </li>
                       <li class="nav-item ">
                           <a class="nav-link " href="{{ url('contact') }}"> Contact Us </a>
                       </li>




                       @if (!Auth::check())
                       <li class="nav-item  ">
                           <a class="nav-link brdnone modal-signin" href="#" data-toggle="modal"
                               data-target="#singin-modal"> Sign in</a>
                       </li>
                       @else
                       <li class="nav-item ">
                           <div class="dropdown mymobile">
                               <button type="button" class="" data-toggle="dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                       <img src="
                               {{-- @if (auth()->user()->avatar) {{auth()->user()->avatar}} @else --}}
                               {{ asset('front_components/images/user1.png') }}
                                {{-- @endif --}}
                                 " class="img-circle elevation-2" width="50px" style="border-radius: 25px;"> Me
                                   </a>
                               </button>
                               <div class="dropdown-menu shadow-sm ">
                                   <a class="dropdown-item" href="{{ route('user.personal') }}">My User Account</a>
                                   @if ($cd)
<                                      a class="dropdown-item" href="{{ route('company.dashboard', $cd->id) }}">Company
                                       Dashboard</a>
                                   <a class="dropdown-item" href="{{ url('/sponsorship') }}">Change Your Plan</a>
                                   <a class="dropdown-item"
                                       href="{{ route('user.allinfo', auth()->user()->id) }}">Update Company Profile
                                   </a>
                                   <a class="dropdown-item" href="{{ route('Projects.index') }}">List Projects</a>
@else
<a class="dropdown-item" href="{{ url('get-listed') }}">Update Company Profile</a>
@endif
                                   <form method="post" action="/logout">
                                       @csrf
                                       <button class="btn btn-sm btn-primary btnLogout logoutbtn"
                                           type="submit">Logout</button>
                                   </form>
                               </div>
                           </div>
























                       </li>
                       @endif
                   </ul>
               </div>
               <div class="right-section d-lg-none d-xl-flex">
                   <div class="input-group">
                       <input type="text" class="form-control search" name="search" id="search1" placeholder="Search">
                       <div class="srcbxc"></div>


                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-search"></i></span>
                       </div>
                   </div>
               </div>
       </nav>




   </section>
   <section class="container-fluid category-service ">
       <div class="container">
        
           <ul class="  mb-0">


           </ul>
       </div>
   </section>
</div> -->


<section class="my-header container-fluid py-3 px-lg-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-lg-0 mb-3">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0 logobox">
                    <a href="https://theytrust-us.developmentserver.info/"> <img
                            src="https://theytrust-us.developmentserver.info/front_components/images/logo.png" alt=""
                            class="img-fluid"></a>
                </div>
                <div class="col-md-6 ml-md-3 ml-0">
                    <div class="">
                        <div class="">
                            <div class="searchbox-sec">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="search" name="search" id="search" placeholder="Search"
                                    onkeyup="search()">
                                <div class="srcbxc"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 right-col">
            <div class="inner">
                <a href="#">Get Listed</a>
                <a href="#" class="posta">Post a Project</a>
                <a href="#" class="review-btn">Review a Business</a>
            </div>


            @if (!Auth::check())
            <!-- <li class="nav-item"> -->
            <a class="nav-link brdnone modal-signin sign-in-btn" href="#" data-toggle="modal"
                data-target="#login-modal"><i class="far fa-user-circle
               " aria-hidden="true"></i><span> Sign in</span></a>
            <!-- </li> -->
            @else
            <div class="nav-item">
                <div class="dropdown mymobile">
                    <button type="button" class="" data-toggle="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar ?? asset('front_components/images/user1.png') }}"
                                class="img-circle elevation-2" width="50px" style="border-radius: 25px;"> Me
                        </a>
                    </button>
                    <div class="dropdown-menu shadow-sm accountbox">
                        <a class="dropdown-item" href="{{ route('user.personal') }}">My User Account</a>
                        @if ($cd)
                        <a class="dropdown-item" href="{{ route('company.dashboard', $cd->id) }}">Company Dashboard</a>
                        <a class="dropdown-item" href="{{ url('/sponsorship') }}">Change Your Plan</a>
                        <a class="dropdown-item" href="{{ route('user.allinfo', auth()->user()->id) }}">Update Company
                            Profile</a>
                        <a class="dropdown-item" href="{{ route('Projects.index') }}">List Projects</a>
                        @else
                        <a class="dropdown-item" href="{{ url('get-listed') }}">Update Company Profile</a>
                        @endif
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-primary btnLogout logoutbtn" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Login Modal -->
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="firstModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <h5 class="modal-title" id="firstModalLabel">Sign In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">

                                @foreach ($errors->all() as $error)
                                {{ $error }}
                                @endforeach

                            </div>
                            @endif
                            <div class="d-flex justify-content-center mb-3 linkdinbox">
                                <a href="{{ route('auth.linkedin') }}" class="btnlink">
                                    <i class="fab fa-linkedin mr-2"></i> Sign In with LinkedIn
                                </a>
                            </div>

                            <div class="afterlinkdin">
                                <div class="text-center">
                                    <span>OR</span>
                                </div>

                                <hr>
                                <h3>Sign in with your company email domain </h3>
                            </div>
                            <form class="form-row" id="login-form" method="POST" action="{{ route('login.email') }}">
                                <!-- Email Input -->

                                <div class="row form-group mx-0 p-0">

                                </div>
                                <div class="form-group col-md-12 pr-4">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="example.email@gmail.com">
                                </div>
                                <!-- Password Input -->
                                <div class="form-group col-md-12 pr-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter at least 8+ charecters">
                                </div>

                                <!-- Remember Me Checkbox -->
                                <div class="form-group form-check col-md-12 checkgroup ">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">
                                        <p>By signing up, I agree with the <a href="">Terms</a> of Use & <a
                                                href="">Privacy Policy</a></p>
                                    </label>
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </form>

                            <div class="text-center alredy">
                                <span>Already have an account? <a href="#" data-toggle="modal" class="mt-5"
                                        id="signup-link" data-target="#signup-modal" data-dismiss="modal">Sign
                                        Up</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Login Up Modal -->
        <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="secondModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <h5 class="modal-title" id="firstModalLabel">Sign Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">

                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach

                        </div>
                        @endif
                        <div class="d-flex justify-content-center mb-3 linkdinbox">
                            <a href="{{ route('auth.linkedin') }}" class="btnlink">
                                <i class="fab fa-linkedin mr-2"></i> Sign Up with LinkedIn
                            </a>
                        </div>

                        <div class="afterlinkdin">
                            <div class="text-center">
                                <span>OR</span>
                            </div>

                            <hr>
                            <h3>Sign up with your company email domain </h3>
                        </div>




                        <form id="signup-form" method="POST" class="form-row" action="{{ route('signup.email') }}">
                            @csrf


                            <div class="row form-group mx-0 p-0">

                                <div class=" col-md-6">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name"
                                        name="first_name" required value="{{ old('first_name') }}">
                                </div>
                                <div class=" col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name"
                                        name="last_name" required value="{{ old('last_name') }}">
                                </div>
                            </div>


                            <div class="form-group col-md-12 pr-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 pr-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password">
                            </div>

                            <div class="form-group form-check col-md-12 checkgroup  ">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                <label class="form-check-label" for="terms">
                                    I agree to the terms and conditions</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </form>

                        <div class="text-center alredy">
                            <span>Already have an account? <a href="#" data-toggle="modal" class="mt-5" id="login-modal"
                                    data-target="#login-modal" data-dismiss="modal">Sign In</a></span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <hr class="mb-0">

    <div class="row align-items-center menu-row pt-2 pt-md-0">
        <div class="col-xl-8">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        @foreach ($categories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $category->id }}"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $category->category }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                @foreach ($category->subcategories as $subcategory)
                                <a class="dropdown-item" href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}">
                                    {{ $subcategory->subcategory }}
                                </a>
                                @endforeach
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-xl-4 text-right right-menu mt-2">
            <a href="#" class="project">Projects</a>
            <a href="#" class="bundles">Bundles</a>
        </div>
    </div>





    </ul>
    </div>
    </nav>
    </div>
</section>
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
       if (!$(this).next().hasClass('show')) {
           $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
       }
       var $subMenu = $(this).next(".dropdown-menu");
       $subMenu.toggleClass('show');
       $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
           $('.dropdown-submenu .show').removeClass("show");
       });


       return false;
   });
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Plugin that adds the force_appear method (Example: jQuery Appear Plugin) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.4.1/jquery.appear.min.js"></script>


<script>
    $(document).ready(function() {
       var header = $(".header-container");
       var offset = header.offset().top;


       $(window).scroll(function() {
           if ($(window).scrollTop() > offset) {
               header.addClass("fixed-header");
           } else {
               header.removeClass("fixed-header");
           }
       });
   });
   $(document).ready(function() {
       var header = $(".header-container");
       var offset = header.offset().top;


       $(window).scroll(function() {
           if ($(window).scrollTop() > offset) {
               header.addClass("fixed-header");
           } else {
               header.removeClass("fixed-header");
           }
       });


       // Bind the input event for the search field
       $("#search1").on('input', function() {
           // debugger;
           search1();
       });


       function search1() {
           console.log("asdfsdf");
           var term = $("#search1").val();
           if (term.length >= 3) {
               $.ajax({
                   url: "{{ route('get-search-list') }}", // Update with the correct route
                   type: "GET",
                   data: {
                       term: term,
                       _token: $('meta[name="csrf-token"]').attr('content')
                   },
                   success: function(result) {
                       console.log(result);
                       $(".srcbxc").html(result);
                       $(".srcbxc").show();
                       $(".input-group-prepend").hide();


                   }
               });
           } else {
               $(".srcbxc").hide();
           }
       }


       $("body").click(function(e) {
           if (!$(e.target).hasClass('srcbxc')) {
               $(".srcbxc").hide();
           }
       });
   });
</script>
<script>
    const accordionItems = document.querySelectorAll('.accordion-item');


   accordionItems.forEach((item) => {
       const header = item.querySelector('.accordion-header');
       const content = item.querySelector('.accordion-content');
       const toggleButton = header.querySelector('.accordion-toggle');


       header.addEventListener('click', () => {
           if (content.style.display === 'none' || content.style.display === '') {
               content.style.display = 'block';
               toggleButton.textContent = '-';
           } else {
               content.style.display = 'none';
               toggleButton.textContent = '+';
           }
       });
   });


  
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        debugger;
       const signUpModal = new bootstrap.Modal(document.getElementById('signup-modal'));
       const loginModal = new bootstrap.Modal(document.getElementById('login-modal'));

       console.log(signUpModal,)


       // Show Log In modal on Sign Up modal "Log In" button click
       document.getElementById('login-modal').addEventListener('click', function() {
           signUpModal.hide();
           loginModal.show();
       });


       // Show Sign Up modal on Log In modal "Sign Up" button click
       document.getElementById('signup-link').addEventListener('click', function() {
           loginModal.hide();
           signUpModal.show();
       });


       // Check if showModal is set in session (Laravel blade example)
       @if (session('showModal') == 'signup')
           signUpModal.show();
       @elseif (session('showModal') == 'login')
           debugger;
           loginModal.show();
       @endif
   });
</script>