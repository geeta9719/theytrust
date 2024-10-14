<div>
    <form wire:submit.prevent="submit " class="sign-in-box"> <!-- Livewire form submission -->
        <!-- Email Input -->
        <div class="form-group mt-2 inner">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control signin" wire:model="email" autocomplete="off" placeholder="example@email.com">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Password Input -->
        <div class="form-group inner">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control signin" wire:model="password" autocomplete="off" placeholder="Enter at least 8+ characters">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me Checkbox -->
        {{-- <div class="form-check ml-3 mb-2"> --}}
            {{-- <input type="checkbox" id="rememberMe" class="form-check-input " wire:model="remember"> --}}
            <div class="form-check">
                <input type="checkbox" id="rememberMe" name="rememberMe" class="form-check-input">
                <label for="rememberMe" class="form-check-label by-up">
                    Remember Me
                </label>
            {{-- </div> --}}
            @error('remember') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block submitb ">Sign In</button>
    </form>

    <!-- Flash Message (after successful login) -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
</div>
