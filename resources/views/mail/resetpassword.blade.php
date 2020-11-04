@component('mail::message')
# {{ $subject }}
Hello {{ $name }} ! <br/>
You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $url_token])
Reset password
@endcomponent
This password reset link will expire in 60 minutes.<br/>
If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy', ['url' => $url_browser])
If you’re having trouble clicking the "Reset password" button, copy and paste the URL below
into your web browser: [{{ $url_browser}}]({{ $url_browser}})
@endcomponent
@endcomponent
