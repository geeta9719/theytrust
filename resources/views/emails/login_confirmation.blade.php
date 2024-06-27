@component('mail::message')
# Login Confirmation

Hello {{ $user->name }},

You have successfully logged in to {{ config('app.name') }}.

Thank you for using our website!

@component('mail::button', ['url' => ''])
Explore Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
