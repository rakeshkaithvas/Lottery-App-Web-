<x-mail::message>
# Welcome to {{ config('app.name') }}

Hello {{ $name }},

Welcome to {{ config('app.name') }}! We are thrilled to have you on board.


If you have any questions or need assistance, feel free to <a href="mailto:{{ config('app.support_email') }}">contact</a> our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
