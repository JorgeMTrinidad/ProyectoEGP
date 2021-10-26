@component('mail::message')
Bienvenido

Por favor copia el código para iniciar sesión.

Código: {{$otp}}
Gracias,<br>
{{ config('app.name') }}
@endcomponent
