<x-mail::message>
# EMAIL VERIFY

{!! $body !!}

<x-mail::button :url="$verification_link">
Click here
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
