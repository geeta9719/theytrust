<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <!-- Success/Error Messages -->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <!-- LinkedIn Sign Up -->
                <div class="d-flex justify-content-center mb-3 linkdinbo">
                    <a href="{{ route('auth.linkedin') }}" class="btn btn-primary">
                        <i class="fab fa-linkedin mr-2"></i> Sign Up with LinkedIn
                    </a>
                </div>

                <!-- OR separator -->
                <div class="afterlinkdin">
                    <div class="text-center">
                        <span>OR</span>
                    </div>
                    <hr>
                    <h3>Sign up with your company email domain</h3>
                </div>

                <!-- Livewire Signup Form -->
                <livewire:signup-form />

                <div class="text-center alredy">
                    <span>Already have an account? 
                        <a href="#" id="open-login-modal" data-dismiss="modal">Sign In</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
