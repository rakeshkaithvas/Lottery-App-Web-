<x-mail::message>
# Hi {{ $user->name }},

Your withdraw request has been successfully sent for processing.

Details of your Withdraw :
@component('mail::panel')
Withdraw Amount : {{ $withdraw->amount }} {{ $setting->currency }}

Withdraw Method : {{ $withdraw->gateway->name }}

Calculated Amount to {{ $withdraw->gateway->currency }} : {{ $withdraw->amount * $withdraw->gateway->rate }} {{ $withdraw->gateway->currency }}

Conversion Rate: 1 {{ $setting->currency }} = {{ $withdraw->gateway->rate }} {{ $withdraw->gateway->currency }}

Gateway Fee : {{ $withdraw->gateway->fee }}%

Total Fee for amount {{ $withdraw->amount * $withdraw->gateway->rate }} : {{ $withdraw->fee }} {{ $withdraw->gateway->currency }}

Getable amount : {{ $withdraw->getable_amount }} {{ $withdraw->gateway->currency }}

@endcomponent

The requested amount will be transferred to your account shortly. Thank you for using our service!


If you were not did this request, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

