<div>
    <form wire:submit.prevent="resetPassword" id="livewireResetPasswordForm">
        @csrf
        <input type="hidden" wire:model="token">
        <input type="hidden" wire:model="email">

        <div class="modal-body">
            @if (session()->has('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <!-- Conditionally show form fields only if user is not logged in -->
            @if (!Auth::check())
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" wire:model="password" id="password" class="form-control" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" wire:model="password_confirmation" id="password_confirmation"
                    class="form-control" required>
                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @else
            <!-- Display the message and link after password reset -->
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif
        </div>

        <div class="modal-footer">
            @if (!session('status'))
            <!-- Show the 'Set Password' button when password hasn't been updated -->
            <button type="submit" class="btn btn-primary">Set Password</button>
            @else
            <!-- Show a link to the login page if the password was updated successfully -->
            <a href="{{ route('login') }}" class="btn btn-success">Go to Login</a>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
