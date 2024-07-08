<?php
use App\Models\Company;
$cd = '';
if (Auth::check()) {
    $uid = auth()->user()->id;
    $cd = Company::select('*')
        ->where('user_id', '=', $uid)
        ->first();
}
?>
<!-- footer start -->
<section class="container-fluid email-sec ">
    <div class="container ">
        <div class="row pt-5">
            <div class="col-md-12 m-0 p-0 ">

                <div id="newsletter-section">
                    <form method="post" class="d-flex" action="{{ route('subscribe') }}">
                        @csrf
                        <input type="email" class="form-control email emailbrd" id="email" name="email"
                            placeholder="Email Address">
                        <button type="submit" class="submit" name="submit_news"
                            value="submit-newsletter">Subscribe</button>
                    </form>
                </div>
                <br>
                <span>To Receive Our Updates Via E-mail</span>

                <span class="social mobilesec">
                    <img src="{{ asset('front_components/images/s1.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s2.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s3.png') }}" alt="" class="img-fluid">
                    <img src="{{ asset('front_components/images/s4.png') }}" alt="" class="img-fluid">
                </span>
                <h3>ABOUT US</h3>
                <p>At <a href="">TheyTrustUs</a>, our goal is to streamline your quest for reputable enterprises and
                    their outstanding offerings through dependable B2B evaluations. Our portal presents an extensive
                    listing of premier businesses spanning diverse sectors. We are committed to equipping you with
                    trustworthy insights and appraisals, empowering you to make well-informed choices. Become part of
                    the multitude of content customers who count on us for precise perspectives. Depend on us to link
                    you with the crème de la crème in the industry.</p>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid contact ">
    <div class="container ">
        <div class="row pt-5">
            <div class="col-lg-6 about-box mb-md-0 mb-5">
                <div class="col-lg-10 mx-auto pl-0">
                    <h3>latest posts</h3>
                    <div class="row latestposts latestpostsbrd mx-0">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="imgright"> <span>On your mark get set and go now </br><a href="#">April 12,
                                    2023</a></span>
                        </div>
                    </div>
                    <div class="row latestposts latestpostsbrd mx-0">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="imgright"> <span>The ship set ground on the shore of this </br><a href="#">May
                                    12,
                                    2023</a></span>
                        </div>
                    </div>
                    <div class="row latestposts latestpostsbrd mx-0 brdnone">
                        <div> <img src="{{ asset('front_components/images/latestnews.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="imgright"> <span>This time there's no stopping us from away </br><a href="#">May
                                    29,
                                    2015</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 about-box  mb-md-0 mb-5">
                <div class="col-lg-9 mx-auto socialbox p-0">
                    <h3>CONTACT INFO</h3>
                    <p>4111-e Rose Lake Rd #2492, Charlotte,</br>
                        North Carolina 28217</p>
                    <a href="tel:+442081338117" class="mb-2">+44 20 8133 8117</a>
                    <a href="mailto:info@theytrust.us">info@theytrust.us</a>
                    <span class="social desktop-sec">
                        <img src="{{ asset('front_components/images/s1.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s2.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s3.png') }}" alt="" class="img-fluid">
                        <img src="{{ asset('front_components/images/s4.png') }}" alt="" class="img-fluid">
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid footer ">
    <div class="container  text-center">
        <ul>
            <li><a href="https://theytrust-us.developmentserver.info/"> Home</a></li>
            <li><a href="{{ url('about') }}"> About</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
            <li><a href="{{ url('privacy') }}"> Privacy Policy</a> </li>
        </ul>
        <ul class="mt-0 mt-md-4 terms">
            <li><a href="{{ url('terms') }}">Terms & Conditions</a></li>
            <li class="brdnone"><a href="{{ url('faq') }}">FAQ</a></li>
        </ul>
    </div>
</section>

<!-- Sign in Modal -->
<div class="modal fade" id="singin-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Sign Up</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="signinbox d-flex row">
                    <div class="signin col-md-2 col-2">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </div>
                    <div class="signintxt col-md-10 col-10 text-center">
                        <a href="{{ route('auth.linkedin') }}" class="btnlink" data-dismiss="">Sign up with LinkedIn</a>
                    </div>
                </div>
                <div class="or-divider">OR</div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#login-modal">Log In</a>

                <form id="signup-form" method="POST" action="{{ route('signup.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required
                            value="{{ old('first_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required
                            value="{{ old('last_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required
                            minlength="8">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Sign in Modal -->
<div class="modal fade" id="login-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Log In</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="login_email">Email</label>
                        <input type="email" class="form-control" id="login_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="login_password">Password</label>
                        <input type="password" class="form-control" id="login_password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Form Validation -->
<!-- JavaScript for Form Validation and Modal Handling -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const loginModal = new bootstrap.Modal(document.getElementById('login-modal'));

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Perform AJAX request or submit form normally
        // Example using fetch API
        fetch(loginForm.action, {
            method: 'POST',
            body: new FormData(loginForm),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                // Redirect or perform actions on successful login
                window.location.reload(); // Example: Reload the page
            } else {
                // Handle errors or display error messages
                console.error('Login failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('signup-form');
        const signUpModal = new bootstrap.Modal(document.getElementById('signup-modal')); // Replace 'signup-modal' with your modal ID
          // Check if showModal is set in session (Laravel blade example)
     

        // Optionally, you can also handle hiding the modal on close or dismiss
        signUpModal._element.addEventListener('hide.bs.modal', function (event) {
            // Add logic here if needed when modal is closed or dismissed
        })

        form.addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
                signUpModal.show(); // Show modal if validation fails
            }
        });

        function validateForm() {
            let isValid = true;
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.classList.remove('is-invalid'));

            if (!validateField(form.first_name.value)) {
                form.first_name.classList.add('is-invalid');
                isValid = false;
            }
            if (!validateField(form.last_name.value)) {
                form.last_name.classList.add('is-invalid');
                isValid = false;
            }
            if (!validateEmail(form.email.value)) {
                form.email.classList.add('is-invalid');
                isValid = false;
            }
            if (!validatePassword(form.password.value)) {
                form.password.classList.add('is-invalid');
                isValid = false;
            }

            return isValid;
        }

        function validateField(value) {
            return value.trim() !== '';
        }

        function validateEmail(email) {
            const re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function validatePassword(password) {
            return password.length >= 8;
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
    const signUpModal = new bootstrap.Modal(document.getElementById('singin-modal'));

    // Check if showModal is set in session
    @if (session('showModal'))
        signUpModal.show();
    @endif

    // Optional: Add event listener for modal close or dismiss
    signUpModal._element.addEventListener('hide.bs.modal', function (event) {
        // Add logic here if needed when modal is closed or dismissed
    });
});
</script>