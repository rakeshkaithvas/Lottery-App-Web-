<x-mail::message>
# Hi {{ $user->name }},

You've just purchased {{ $quantity }} lottery tickets for the {{ $lottery->name }}. Good luck and may the odds be ever in your favor!

Lottery Details :
@component('mail::panel')
Lottery Name: {{ $lottery->name }}

Quantity: {{ $quantity }}

Lottery Price: {{ $lottery->price }}

Total Price: {{ $lottery->price * $quantity }}

Draw date: {{ $lottery->draw_date }}
@endcomponent


If you were not buy this lottery, <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
