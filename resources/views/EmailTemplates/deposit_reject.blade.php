<x-mail::message>
# Hi {{ $deposit->user->name }},

We regret to inform you that your deposit request for {{ $deposit->amount }} {{ \App\Models\GeneralSetting::first()->currency }} has been rejected.

@component('mail::panel')
Reason: {{ $deposit->block_reason }}
@endcomponent

If you have any questions or need assistance, feel free to <a href="mailto:{{ config('app.support_email') }}">contact</a> our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
