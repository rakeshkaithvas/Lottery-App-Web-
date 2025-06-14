<x-mail::message>
## Hi {{ $lottery->user->name }},

Congratulations!

You won {{ $lottery->lottery->name }}

@component('mail::panel')
Ticket Number: {{ $lottery->ticket_number }}

Wining Level: {{ $lottery->rank }}

Winning Amount: {{ $lottery->prize }}
@endcomponent

Thanks,<br>
Team {{ config('app.name') }}
</x-mail::message>
