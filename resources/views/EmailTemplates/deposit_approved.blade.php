<x-mail::message>
# Hi {{ $deposit->user->name }},

Your deposit request has been approved. The amount of {{ $deposit->amount }} {{ \App\Models\GeneralSetting::first()->currency }} has been successfully added to your account. Thank you for using our service!


If you have any questions or need assistance, feel free to <a href="mailto:{{ config('app.support_email') }}">contact</a> our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
