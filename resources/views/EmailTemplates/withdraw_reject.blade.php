<x-mail::message>
# Hi {{ $withdraw->user->name }},

We regret to inform you that your withdraw request for {{ $withdraw->amount }} {{ \App\Models\GeneralSetting::first()->currency }} has been rejected.

@component('mail::panel')
Reason: {{ $withdraw->block_reason }}
@endcomponent

If you have any questions or need assistance, feel free to <a href="mailto:{{ config('app.support_email') }}">contact</a> our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
