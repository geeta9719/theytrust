<div>
    <form wire:submit.prevent="submit"> <!-- Livewire form submission -->
        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" wire:model="email" placeholder="example@email.com">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" wire:model="password" placeholder="Enter at least 8+ characters">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me Checkbox -->
        <div class="form-check">
            <input type="checkbox" id="rememberMe" class="form-check-input" wire:model="remember">
            <label for="rememberMe" class="form-check-label">Remember me</label>
            @error('remember') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </form>

    <!-- Flash Message (after successful login) -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
</div>
