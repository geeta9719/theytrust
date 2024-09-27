<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;

class SignupForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $confirm_password; // Added confirm_password property
    public $remember;
    public  $showVerifyEmailModal ;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8', // Added password confirmation validation
        'confirm_password' => 'required|min:1|same:password', 
        'remember'=>'accepted' // Add this to validate confirmation field
    ];

    // List of public domains not allowed for registration
    protected $publicDomains = [
        'gmail.co',
        'yahoo.com',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        $email = $this->email;
        $domain = substr(strrchr($email, "@"), 1);  // Extract the domain from email
        if (in_array($domain, $this->publicDomains)) {
            $this->addError('email', 'Public email addresses are not allowed.');
            return;
        }

        $verificationToken = Str::random(32);
        $tokenExpiresAt = Carbon::now()->addDays(7);

        // Create a new user
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'verification_token' => $verificationToken,   // Store the token
            'token_expires_at' => $tokenExpiresAt,        // Store token expiration
        ]);
        Mail::to($user->email)->send(new VerificationEmail($user));
        // Auth::login($user);

           // Open the verification email modal
        $this->showVerifyEmailModal = true;

       // Emit an event to open the modal via JavaScript
        $this->emit('openVerifyEmailModal', $this->email);

           // Flash success message
        session()->flash('success', 'Signup successful! Please verify your email.');
        $this->reset();

    }


    public function render()
    {
        return view('livewire.signup-form');
    }
}
