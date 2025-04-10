<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginConfirmation;

class SendLoginConfirmationEmail implements ShouldQueue
{
    public function handle(UserLoggedIn $event)
    {
        Mail::to($event->user->email)->send(new LoginConfirmation());
    }
}
