<?php
use App\Models\Category;
use App\Models\Company;
use App\Models\Subcategory;
// $categories = Category::where('top_cat', 1)->get();
$categories = Category::with('subcategory', 'subcategory.subcat_child')->where('top_cat', 1)->get();

$cd = '';
if (Auth::check()) {
    $uid = auth()->user()->id;
    $cd = Company::select('*')->where('user_id', '=', $uid)->first();
}
?>


<section class="my-header container-fluid py-3 px-lg-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-lg-0 mb-3">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0 logobox">
                    <a href="https://theytrust-us.developmentserver.info/"> <img
                            src="https://theytrust-us.developmentserver.info/front_components/images/logo.png"
                            alt="" class="img-fluid"></a>
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
<<<<<<< HEAD
            <!-- <li class="nav-item"> -->
            <a class="nav-link brdnone modal-signin sign-in-btn" href="#" data-toggle="modal"
                data-target="#login-modal"><i class="far fa-user-circle
               " aria-hidden="true"></i><span> Sign in</span></a>
            <a class="nav-link brdnone modal-signin sign-in-btn" href="#" data-toggle="modal"
                data-target="#signup-modal"><i class="far fa-user-circle
              " aria-hidden="true"></i><span> Sign Up</span></a>

            <!-- <a class="nav-link brdnone modal-signin sign-in-btn" href="#" id="open-forgot-password" onclick="event.preventDefault(); Livewire.emit('openForgotPasswordModal')">
                <i class="far fa-user-circle" aria-hidden="true"></i><span> Forget Password</span>
            </a> -->
            
            
</a>

            
            
            
=======
                <a class="nav-link brdnone modal-signin sign-in-btn" href="#" data-toggle="modal"
                    data-target="#login-modal"><i class="far fa-user-circle
               "
                        aria-hidden="true"></i><span> Sign in</span></a>
                <a class="nav-link brdnone modal-signin sign-in-btn" href="#" data-toggle="modal"
                    data-target="#signup-modal"><i class="far fa-user-circle
              "
                        aria-hidden="true"></i><span> Sign Up</span></a>
                <a class="nav-link brdnone modal-signin sign-in-btn" href="#" id="open-forgot-password"
                    onclick="event.preventDefault(); Livewire.emit('openForgotPasswordModal')">
                    <i class="far fa-user-circle" aria-hidden="true"></i><span> Forget Password</span>
                </a>
                </a>
>>>>>>> fc64e480d9a2e03a89e4d53a46027452b49b7087
            @else
                <div class="nav-item">
                    <div class="dropdown mymobile">
                        <button type="button" class="btn" data-toggle="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->avatar ?? asset('front_components/images/user1.png') }}"
                                    class="img-circle elevation-2" width="40px" style="border-radius: 25px;">
                                {{ auth()->user()->name }}
                            </a>
                        </button>
                        <div class="dropdown-menu shadow-sm accountbox" style="min-width: 250px;">
                            <div class="dropdown-header d-flex align-items-center">
                                <img src="{{ auth()->user()->avatar ?? asset('front_components/images/user1.png') }}"
                                    width="40px" class="rounded-circle me-2">
                                <div>
                                    <span
                                        class="fw-bold">{{ auth()->user()->company_name ?? 'Company Name' }}</span><br>
                                    <small class="text-muted">{{ auth()->user()->email ?? 'example@gmail.com' }}</small>
                                </div>
                            </div>
                            <hr>
                            <a class="dropdown-item" href="{{ route('user.personal') }}">
                                <i class="fas fa-user me-2"></i> Edit Profile
                            </a>
                            @if ($cd)
                                <a class="dropdown-item" href="{{ route('company.dashboard', $cd->id) }}">
                                    <i class="fas fa-chart-bar me-2"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ url('/sponsorship') }}">
                                    <i class="fas fa-star me-2"></i> Upgrade Plan
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ url('/help') }}">
                                <i class="fas fa-question-circle me-2"></i> Help Center
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item btnLogout" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @endif


        </div>
        @include('modals.login')
        @include('modals.signup')
        <livewire:forgot-password />

        {{-- <livewire:verify-email /> --}}


        <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetPasswordModalLabel">Set New Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire('reset-password-form', ['token' => session('token'), 'email' => session('email')])
                    </div>
                </div>
            </div>
        </div>

    </div>




    <hr class="mb-0">
    <div class="row align-items-center menu-row pt-2 pt-md-0">
        <div class="col-xl-8">
            {{-- <nav class="navbar navbar-expand-lg navbar-light px-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        @foreach ($categories as $category)
                            <li class="nav-item dropdown">
                                <!-- Main Category -->
                                <a class="nav-link dropdown-toggle" href="/listing/{{ $category->slug }}"
                                    id="navbarDropdown{{ $category->id }}" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ $category->category }}
                                </a>

                                @if (count($category->subcategories) > 0)
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                        @foreach ($category->subcategories as $subcategory)
                                            <!-- Subcategory -->
                                            <a class="dropdown-item dropdown-toggle"
                                                href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}"
                                                id="navbarDropdownSub{{ $subcategory->id }}" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $subcategory->subcategory }}
                                            </a>
                                            <!-- Sub-subcategory -->
                                            @if (count($subcategory->subcat_child) > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach ($subcategory->subcat_child as $subSubcategory)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}/{{ $subSubcategory->slug }}">
                                                                {{ $subSubcategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
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
    </nav> --}}
    <div class="row align-items-center menu-row pt-2 pt-md-0">
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
                                <!-- Main Category -->
                                <a class="nav-link dropdown-toggle" href="/listing/{{ $category->slug }}"
                                    id="navbarDropdown{{ $category->id }}" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ $category->category }}
                                </a>
    
                                @if (count($category->subcategories) > 0)
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                        @foreach ($category->subcategories as $subcategory)
                                            <!-- Subcategory -->
                                            <a class="dropdown-item dropdown-toggle"
                                                href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}"
                                                id="navbarDropdownSub{{ $subcategory->id }}" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $subcategory->subcategory }}
                                            </a>
                                            <!-- Sub-subcategory -->
                                            @if (count($subcategory->subcat_child) > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach ($subcategory->subcat_child as $subSubcategory)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="/listing/{{ $category->slug }}/{{ $subcategory->slug }}/{{ $subSubcategory->slug }}">
                                                                {{ $subSubcategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
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
    
    </div>

    <div class="modal fade" id="emailVerificationModal" tabindex="-1" aria-labelledby="emailVerificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content verify-bx">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailVerificationModalLabel">Sign up</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class=" verifybox">
                   
                    <h2 class="text-center" >Verify your email address</h2>
                   
                </div>
                <div class="modal-body">
<<<<<<< HEAD
                    <div class="">
                    <div class="modal-body">
                        <div class="verification-box">
                            <p>Almost there! An email containing verification instructions was sent to <span id="verification-email"></span></p>
                            <p>Didn't receive the email? <a href="#" id="resend-email-link">Resend Email</a></p>
=======
                    <div class="verification-box">
                        <div class="modal-body">
                            <div class="verification-box">
                                <p>Almost there! An email containing verification instructions was sent to <strong
                                        id="verification-email"></strong></p>
                                <p>Didn't receive the email? <a href="#" id="resend-email-link">Resend Email</a>
                                </p>
                            </div>
>>>>>>> fc64e480d9a2e03a89e4d53a46027452b49b7087
                        </div>

                    </div>
                </div>
                <div class="modal-footer text-center already-txt">
                    <p>Already have an account? <a href="/login">Sign in</a></p>
                </div>
            </div>
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- jQuery CDN -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!-- Plugin that adds the force_appear method (Example: jQuery Appear Plugin) -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.4.1/jquery.appear.min.js"></script>  --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}



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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $(document).ready(function() {
        // Open the Sign-Up modal when Sign-In modal's "Sign Up" link is clicked
        $('#signup-link').on('click', function() {
            $('#login-modal').modal('hide'); // Hide the Sign-In modal
            setTimeout(function() {
                $('#signup-modal').modal('show'); // Show the Sign-Up modal
            }, 500); // Delay to ensure smooth transition
        });

        // Open the Sign-In modal when Sign-Up modal's "Sign In" link is clicked
        $('#open-login-modal').on('click', function() {
            $('#signup-modal').modal('hide'); // Hide the Sign-Up modal
            setTimeout(function() {
                $('#login-modal').modal('show'); // Show the Sign-In modal
            }, 500); // Delay to ensure smooth transition
        });

        // Listen for Livewire event to open the Verify Email modal
        Livewire.on('openVerifyEmailModal', function(email) {
            $('#signup-modal').modal('hide'); // Hide the Sign-Up modal
            setTimeout(function() {
                $('#verifyEmailModal').modal('show'); // Show the Verify Email modal
                $('#verifyEmailModal .email-placeholder').text(
                email); // Fill email in the modal
            }, 500); // Delay for smooth transition
        });
        // Resend verification email with Livewire
        $('#resend-verification-btn').on('click', function() {
            Livewire.emit('resendVerificationEmail');
        });

        // Reset modals on close to prevent data persistence on reopening
        $('#signup-modal').on('hidden.bs.modal', function() {
            $(this).find('input').val(''); // Reset form inputs
            $(this).find('.alert').remove(); // Remove any alert messages
        });

        // Reset the Verify Email Modal on close
        $('#verifyEmailModal').on('hidden.bs.modal', function() {
            $(this).find('.email-placeholder').text(''); // Clear the email placeholder
        });

        // Check if the session has 'showModal' and if it's set to 'resetPasswordModal'
        var showModal = "{{ session('showModal') }}";
        if (showModal === 'resetPasswordModal') {
            $('#resetPasswordModal').modal('show');
        }
        Livewire.on('closeSignupModal', function() {
            console.log('closeSignupModal event received');
            $('#signup-modal').modal('hide');
            $('#signup-modal').css('display', 'none');
            $('.modal-backdrop').remove();
        });

        // Listen for the event to open the verification modal
        Livewire.on('openVerifyEmailModal', function(email) {
            console.log('openVerifyEmailModal event received', email);
            $('#signup-modal').modal('hide'); // Close the signup modal
            $('#emailVerificationModal').modal('show'); // Show the verification modal

            // Update the email in the modal content dynamically
            // $('#emailVerificationModal').find('strong').text(email);
            $('#verification-email').text(email); // Update the email in the modal
            $('#resend-email-link').attr('href', '/resend-verification/' + email);
        })


    });

    document.addEventListener('livewire:load', function() {
        // Listen for the password reset success event from Livewire
        Livewire.on('passwordResetSuccess', () => {
            // Hide the reset password modal
            $('#resetPasswordModal').modal('hide');

            // Show the login modal
            $('#login-modal').modal('show');
        });
    });
</script>
