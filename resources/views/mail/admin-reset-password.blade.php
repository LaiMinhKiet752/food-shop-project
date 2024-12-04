<x-mail::message>
# Đặt lại mật khẩu

{!! $body !!}

<x-mail::button :url="$reset_link">
Click here
</x-mail::button>

Trân trọng,<br>
{{ config('app.name') }}
</x-mail::message>
