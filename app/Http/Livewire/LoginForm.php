<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $remember = false;

    // Real-time validation rules
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName); // Real-time validation for each field
    }

    public function submit()
    {
        // Validate the fields including 'remember'
        $this->validate();
    
        // Fetch the user by email
        $user = \App\Models\User::where('email', $this->email)->first();
    
        if ($user && !$user->hasVerifiedEmail()) {
            session()->flash('error', 'Your email is not verified. Please check your inbox for the verification link.');
            $this->addError('email', 'Your email is not verified. Please check your inbox.');
            return;
        }
    
        // Attempt to log the user in
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->flash('success', 'Login successful!');
            return redirect()->intended('/');
        }
  
        session()->flash('error', 'Login failed! Please check your credentials.');
        $this->addError('email', 'These credentials do not match our records.');
    }
    

    public function render()
    {
        return view('livewire.login-form');
    }
}
