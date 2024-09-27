<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ResetPasswordForm extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $status;

    protected $rules = [
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
    ];

    public function mount($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function resetPassword()
    {
        $this->validate();

        // Find the user by email
        $user = User::where('email', $this->email)->first();

        if ($user) {
            // Update the user's password
            $user->password = Hash::make($this->password);
            $user->save();
            $this->emit('passwordResetSuccess');
            $this->status = 'Password updated successfully.';
            session()->flash('status', $this->status);
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function render()
    {
        return view('livewire.reset-password-form');
    }
}