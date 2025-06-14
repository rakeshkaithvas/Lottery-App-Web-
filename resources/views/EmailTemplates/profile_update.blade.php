<x-mail::message>
## Hi Dear,

@component('mail::panel')
This message is to confirm that your {{ config('app.name') }} account profile has been successfully updated.
@endcomponent

If you did not make changes to your {{ config('app.name') }} account profile, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
Team {{ config('app.name') }}
</x-mail::message>

