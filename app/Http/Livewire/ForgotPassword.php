<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email;
    
    protected $rules = [
        'email' => 'required|email',
    ];

    public function submit()
{
    // Validate email input
    $this->validate();

    // Attempt to send the reset link to the provided email
    $status = Password::sendResetLink(['email' => $this->email]);

    // Check the status and respond accordingly
    if ($status === Password::RESET_LINK_SENT) {
        // Success message
        session()->flash('status', __($status)); // Use Laravel's translation system to handle different responses
    } else {
        // Error message
        session()->flash('error', __($status)); // Use Laravel's translation system for error handling as well
    }

    // Emit an event to ensure the modal stays open
    $this->emit('passwordResetAttempt');
}


    public function render()
    {
        return view('livewire.forgot-password');
    }
}
