<x-mail::message>
# RESET PASSWORD

{!! $body !!}

<x-mail::button :url="$reset_link">
Click here
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
