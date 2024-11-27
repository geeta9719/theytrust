<!-- Verify Email Modal -->
<div
    class="modal fade"
    id="verifyEmailModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="verifyEmailModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyEmailModalLabel">Verify your email address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Almost there! An email containing verification instructions was sent to your email address.</p>
                <p>Didn't receive the email?</p>

                @if (session()->has('user'))
                    <div>
                        <p>We can resend the email verification instructions.</p>
                        <a
                            href="{{ route('resend.verification', ['email' => session('user')->email]) }}"
                            class="btn btn-primary"
                        >
                            Resend Email
                        </a>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div
    class="modal fade"
    id="forgotPasswordModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Please enter your email address to receive password reset instructions.</p>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div
    class="modal fade"
    id="resetPasswordModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="resetPasswordModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Set New Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ session('token') }}" />
                <input type="hidden" name="email" value="{{ session('email') }}" />

                <div class="modal-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (! Auth::check())
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="setpassword" id="setpassword" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input
                                type="password"
                                name="setpassword_confirmation"
                                id="setpassword_confirmation"
                                class="form-control"
                                required
                            />
                        </div>
                    @else
                        <div class="alert alert-info">{{ session('status') }}</div>
                    @endif
                </div>

                <div class="modal-footer">
                    @if (! session('status'))
                        <button type="submit" class="btn btn-primary">Set Password</button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success">Go to Login</a>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Signup Modal -->
<div
    class="modal fade"
    id="signup-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="secondModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <h5 class="modal-title" id="firstModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <!-- LinkedIn Sign Up -->
                <div class="d-flex justify-content-center mb-3 linkdinbox">
                    <a href="{{ route('auth.linkedin') }}" class="btn btn-primary">
                        <i class="fab fa-linkedin mr-2"></i>
                        Sign Up with LinkedIn
                    </a>
                </div>

                <div class="afterlinkdin">
                    <div class="text-center"><span>OR</span></div>
                    <hr />
                    <h3>Sign up with your company email domain</h3>
                </div>

                <!-- Sign up form -->
                <form id="signup-form" method="POST" class="form-row" action="{{ route('signup.email') }}">
                    @csrf
                    <div class="row form-group mx-0 p-0">
                        <div class="col-md-6">
                            <label for="firstname">First Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="firstname"
                                placeholder="Enter First Name"
                                name="first_name"
                                required
                                value="{{ old('first_name') }}"
                            />
                            <span class="text-danger" id="firstname-error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Last Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="lastname"
                                placeholder="Enter Last Name"
                                name="last_name"
                                required
                                value="{{ old('last_name') }}"
                            />
                            <span class="text-danger" id="lastname-error"></span>
                        </div>
                    </div>

                    <div class="form-group col-md-12 pr-4">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            required
                            value="{{ old('email') }}"
                        />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <span class="text-danger" id="email-error"></span>
                    </div>

                    <div class="form-group col-md-12 pr-4">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                        />
                        <span class="text-danger" id="password-error"></span>
                    </div>

                    <div class="form-group col-md-12 pr-4">
                        <label for="confirm_password">Confirm Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="confirm_password"
                            name="confirm_password"
                            placeholder="Confirm password"
                        />
                        <span class="text-danger" id="confirm-password-error"></span>
                    </div>

                    <div class="form-group form-check col-md-12 checkgroup">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" />
                        <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                        <span class="text-danger" id="terms-error"></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </form>

                <div class="text-center alredy">
                    <span>
                        Already have an account?
                        <a
                            href="#"
                            data-toggle="modal"
                            class="mt-5"
                            id="login-modal"
                            data-target="#login-modal"
                            data-dismiss="modal"
                        >
                            Sign In
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    // Modal transitions between login and signup
    $('#login-modal').on('click', function () {
        $('#signup-modal').modal('hide');
        $('#login-modal').modal('show');
    });

    $('#signup-link').on('click', function () {
        $('#login-modal').modal('hide');
        $('#signup-modal').modal('show');
    });

    // Handle login form validation and submission
    $('#login-form').on('submit', function (event) {
        event.preventDefault();
        // Clear previous errors
        $('#login-email, #login-password').removeClass('is-invalid');
        // Validate inputs
        const email = $('#login-email').val().trim();
        const password = $('#login-password').val().trim();
        if (email === '' || password === '') {
            if (email === '') $('#login-email').addClass('is-invalid');
            if (password === '') $('#login-password').addClass('is-invalid');
        } else {
            // Submit the form
            this.submit();
        }
    });

    // Handle signup form validation and submission
    $('#signup-form').on('submit', function (event) {
        let isValid = true;
        // Clear previous errors
        $('#signup-form input').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        const password = $('#signup-password').val().trim();
        const confirmPassword = $('#signup-confirm-password').val().trim();

        // Validate password and confirm password
        if (password !== confirmPassword) {
            $('#signup-confirm-password').addClass('is-invalid')
                .after('<div class="invalid-feedback">Passwords do not match.</div>');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Handle reset password form
    $('#resetPasswordForm').on('submit', function (event) {
        event.preventDefault();
        // Validate password matching
        const password = $('#setpassword').val();
        const confirmPassword = $('#setpassword_confirmation').val();
        if (password !== confirmPassword) {
            $('#setpassword, #setpassword_confirmation').addClass('is-invalid')
                .after('<div class="invalid-feedback">Passwords do not match!</div>');
        } else {
            // Submit the form if valid
            this.submit();
        }
    });

    // Close modals when appropriate based on server-side session data
    @if (session('showModal') == 'signup')
        $('#signup-modal').modal('show');
    @elseif (session('showModal') == 'login')
        $('#login-modal').modal('show');
    @elseif (session('showModal') == 'verifyEmail')
        $('#verifyEmailModal').modal('show');
    @elseif (session('showModal') == 'resetPasswordModal')
        $('#resetPasswordModal').modal('show');
    @endif
});
</script>
