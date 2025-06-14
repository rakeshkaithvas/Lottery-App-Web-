<x-mail::message>
# Hi {{ $user->name }},

Your deposit request of {{ $deposit->amount }} {{ $setting->currency }} via {{ $deposit->gateway_name }} has been submitted successfully.

Details of your Deposit :
@component('mail::panel')
Total Amount: {{ $deposit->total_amount }} {{ $gateway->currency }}

Fee: {{ $deposit->fee }} {{ $gateway->currency }}

Conversion Rate: 1 {{ $setting->currency }} = {{ $gateway->rate }} {{ $gateway->currency }}

Getable Amount: {{ $deposit->amount }} {{ $setting->currency }}
@endcomponent


If you were not did this request, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

