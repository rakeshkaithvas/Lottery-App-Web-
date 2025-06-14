<x-mail::message>
## Hi Dear,

@component('mail::panel')
You recently requested to reset your {{ config('app.name') }} password. To select a new password, click on the button below:
@endcomponent

If you did not attempt to reset your password, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
Team {{ config('app.name') }}

</x-mail::message>



