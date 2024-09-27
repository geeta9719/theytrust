<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class VerifyEmail extends Component
{
    public $userEmail;

    protected $listeners = ['openVerifyEmailModal'];

    // Open the verify email modal and show user email
    public function openVerifyEmailModal($userEmail)
    {
        $this->userEmail = $userEmail;
        $this->dispatchBrowserEvent('openVerifyEmailModal', $this->userEmail); // Trigger the JS modal opening
    }

    // Handle the email resend process
    public function resendVerificationEmail()
    {
        $user = User::where('email', $this->userEmail)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            // Resend verification email
            Mail::to($user->email)->send(new VerificationEmail($user));

            // Success message for modal
            session()->flash('success', 'Verification email has been resent!');
        } else {
            // Error message if email can't be resent
            session()->flash('error', 'Unable to resend verification email.');
        }
    }

    public function render()
    {
        return view('livewire.verify-email');
    }
}
