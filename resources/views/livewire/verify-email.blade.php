<div>
    <div class="modal fade @if($isModalOpen) show d-block @endif" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="submit">
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

                        <!-- Input for email -->
                        <p>Please enter your email address to receive password reset instructions.</p>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" wire:model="email" id="email" class="form-control" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        // Listen for the 'passwordResetLinkSent' event to ensure modal behavior is controlled properly
        Livewire.on('passwordResetLinkSent', function () {
            // Keeping the modal open by making sure it doesn't hide automatically
            $('#forgotPasswordModal').modal('show');
        });
    });
</script>

<style>
    .modal.show.d-block {
        display: block !important;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
