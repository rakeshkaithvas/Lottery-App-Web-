<x-mail::message>
# Hi {{ $withdraw->user->name }},

Congratulations! Your withdraw request has been approved. The requested amount of {{ $withdraw->amount }} {{ \App\Models\GeneralSetting::first()->currency }} ({{ $withdraw->getable_amount }} {{ $withdraw->gateway->currency }}) has been successfully transferred to your account. Thank you for using our service!


If you have any questions or need assistance, feel free to <a href="mailto:{{ config('app.support_email') }}">contact</a> our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
