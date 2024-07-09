

    <!-- Sign Up Modal -->
    <div class="modal fade" id="singin-modal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center" id="signinModalLabel">Sign Up</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <a href="{{ route('auth.linkedin') }}" class="btnlink">
                            <i class="fab fa-linkedin mr-2"></i> Sign up with LinkedIn
                        </a>
                    </div>
                    <div class="or-divider">OR</div>
                    <form id="signup-form" method="POST" action="{{ route('signup.email') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>
                    <div class="text-center mt-3">
                        Already have an account? <a href="#" id="login-link" data-bs-toggle="modal" data-bs-target="#login-modal" data-bs-dismiss="modal">Sign in</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Log In Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center" id="loginModalLabel">Log In</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-form" method="POST" action="{{ route('login.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="login_email">Email</label>
                            <input type="email" class="form-control" id="login_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="login_password">Password</label>
                            <input type="password" class="form-control" id="login_password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="login-button">Log In</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signUpModal = new bootstrap.Modal(document.getElementById('singin-modal'));
            const loginModal = new bootstrap.Modal(document.getElementById('login-modal'));

            // Show Log In modal on Sign Up modal "Log In" button click
            document.getElementById('login-link').addEventListener('click', function() {
                signUpModal.hide();
                loginModal.show();
            });

            // Check if showModal is set in session (Laravel blade example)
            @if (session('showModal') == 'signup')
                signUpModal.show();
            @elseif (session('showModal') == 'login')
                loginModal.show();
            @endif
        });
    </script>

{{-- </html> --}}
