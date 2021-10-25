@component('mail::message')
# Introduction

The body of your message.

OTP is: {{$otp}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
