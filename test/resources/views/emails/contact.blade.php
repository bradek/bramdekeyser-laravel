<!-- Hierin bevindt zich de tekst die in de mail moet staan.
Deze wordt vanuit het contactformulier verzonden.-->
@component('mail::message')
# Nieuw contactformulier

Er is een nieuw contactformulier ingediend door {{ $name }} ({{ $email }}):

@component('mail::panel')
{{ $message }}
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent