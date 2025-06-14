<x-mail::message>
## Hi Dear,

@component('mail::panel')
This message is to confirm that your {{ config('app.name') }} account password has been successfully changed.
@endcomponent

If you did not request a password change, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
Team {{ config('app.name') }}
</x-mail::message>

