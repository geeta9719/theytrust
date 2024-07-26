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
<style>
    .accordion {
        margin: 0 auto;
    }

    .accordion-item {
        margin-bottom: 5px;
    }

    .accordion-header {
        cursor: pointer;
    }

    .accordion-content {
        display: none;
    }

    .accordion-toggle {
        font-size: 20px !important;
        border: none !important;
        background: none !important;
        color: #fff !important;

    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
<a class="dropdown-item" href="{{ route('company.dashboard', $cd->id) }}">Company
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
        <div class="col-lg-7 mb-lg-0 mb-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0 logobox">
                    <img src="https://theytrust-us.developmentserver.info/front_components/images/logo.png"
                        alt="" class="img-fluid">
                </div>
                <div class="col-md-5">
                    <div class="input-group border rounded align-items-center justify-content-center">
                        <div class="input-group-prepend pl-2">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 right-col">
            <div class="inner">
                <a href="#">Get Listed</a>
                <a href="#">Post a Project</a>
                <a href="#" class="review-btn">Review a Business</a>
            </div>
            <a href="#" class="sign-in-btn"><i class="fa fa-user" aria-hidden="true"></i>Sign In</a>
        </div>
    </div>
    <hr class="mb-0">

    <div class="row align-items-center menu-row">
     
        <div class="col-xl-8">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        @foreach ($categories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/listing/{{ $category->slug }}" id="navbarDropdownMenuLink{{ $category->id }}"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $category->category }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink{{ $category->id }}">
                                @foreach ($category->subcategories as $subcategory)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}">{{ $subcategory->subcategory }}</a>
                                    <ul class="dropdown-menu last-menu">
                                        <li><a class="dropdown-item" href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}">{{ $subcategory->subcategory }}</a></li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
        
        
            
   
        

        <div class="col-xl-4 text-right right-menu mt-3">
            <a href="#">Get Listed</a>
            <a href="#">Post a Project</a>
        </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    // $(document).ready(function () {
    //     $(".accordion-button").click(function () {
    //         // Find the parent accordion item
    //         var parent = $(this).closest(".accordion-item");

    //         // Check if it's already collapsed
    //         if (parent.hasClass("collapsed")) {
    //             // Collapse all accordion items
    //             $(".accordion-item").addClass("collapsed");
    //             // Expand the clicked item
    //             parent.removeClass("collapsed");
    //         } else {
    //             // Toggle the collapse state of the clicked item
    //             parent.toggleClass("collapsed");
    //         }
    //     });
    // });
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


<!-- menu section End -->
