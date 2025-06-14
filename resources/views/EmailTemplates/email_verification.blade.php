<x-mail::message>
## Hi Dear,

To complete your request, enter the following verification code:

@component('mail::panel')
{{ $otp }}
@endcomponent

This code will expire in 10 minutes.

If you were not expecting this code, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
Team {{ config('app.name') }}
</x-mail::message>
