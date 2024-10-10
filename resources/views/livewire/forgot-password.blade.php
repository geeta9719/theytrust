<div>
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="close" id="closeForgotPasswordModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="submit" class="forgot-gap">
                    <div class="modal-body">
                        <!-- Success Message -->
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Email Input -->
                        <p class="ml-2 enter-txt">Please enter your email address to receive password reset instructions.</p>
                        <div class="form-group forgot-box">
                            <label for="email">Email Address</label>
                            <input type="email" wire:model="email" id="email" class="form-control" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="modal-footer forgot-box">
                        <button type="submit" class="btn btn-primary reset-link">Send Reset Link</button>
                        <button type="button" class="btn btn-secondary reset-close-link" id="closeForgotPasswordBtn">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Script -->
<script>
    $(document).ready(function() {
        // Open the modal when clicking "Forgot Password"
        $('#open-forgot-password').on('click', function(e) {
            e.preventDefault();
            $('#forgotPasswordModal').modal('show');
        });

        // Close the modal when clicking the 'X' button in the header
        $('#closeForgotPasswordModal').on('click', function() {
            $('#forgotPasswordModal').modal('hide');
        });

        // Close the modal when clicking the 'Close' button in the footer
        $('#closeForgotPasswordBtn').on('click', function() {
            $('#forgotPasswordModal').modal('hide');
        });

        // Keep the modal open after form submission if needed
        Livewire.on('passwordResetAttempt', function () {
            $('#forgotPasswordModal').modal('show');
        });
    });
</script>

<!-- Styling to ensure the modal behaves correctly -->
<style>
    .modal.show.d-block {
        display: block !important;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
