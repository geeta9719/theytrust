<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Sign up form -->
    <form wire:submit.prevent="submit" class="sign-up-box">
        <div class="row form-group mx-0 p-0 inner">
            <div class="col-md-6">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" wire:model="first_name" placeholder="Enter First Name">
                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" wire:model="last_name" placeholder="Enter Last Name">
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group col-md-12 inner">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" wire:model="email" placeholder="Enter Email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group col-md-12 inner">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" wire:model="password" placeholder="Enter Password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group col-md-12 inner ">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" wire:model="confirm_password" placeholder="Confirm Password">
            @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group form-check col-md-12 checkgroup ml-3">
            <input type="checkbox" id="rememberMe" class="form-check-input" wire:model="remember">
            <label class="form-check-label" for="terms">
                I agree to the 
                <a href="{{ route('terms-of-use') }}" target="_blank">terms of use</a> and 
                <a href="{{ route('privacy-policy') }}" target="_blank">privacy policy</a>
            </label>
            @error('remember') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block submitb">Sign Up</button>
    </form>
</div>
