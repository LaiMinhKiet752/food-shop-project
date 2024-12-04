<x-mail::message>
# Xác thực email

{!! $body !!}

<x-mail::button :url="$verification_link">
Click here
</x-mail::button>

Trân trọng,<br>
{{ config('app.name') }}
</x-mail::message>
