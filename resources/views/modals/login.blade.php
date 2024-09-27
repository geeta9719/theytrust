<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="firstModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="firstModalLabel">Sign In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- LinkedIn Sign In Button -->
                <div class="d-flex justify-content-center mb-3 linkdinbox">
                    <a href="{{ route('auth.linkedin') }}" class="btnlink">
                        <i class="fab fa-linkedin mr-2"></i> Sign In with LinkedIn
                    </a>
                </div>

                <!-- OR Divider -->
                <div class="afterlinkdin">
                    <div class="text-center">
                        <span>OR</span>
                    </div>
                    <hr>
                    <h3>Sign in with your company email domain</h3>
                </div>

                <!-- Livewire Login Form -->
                <livewire:login-form /> 

            </div>
            <div class="text-center alredy">
                <span>New User? <a href="#" class="mt-5" id="signup-link" data-dismiss="modal">Sign Up</a></span>
            </div>
        </div>
    </div>
</div>
