@extends('layouts.basis')

    @section('content')
<!--Ik verwijs in de POST naar de route password.email.
Na het indienen van dit formulier wordt de resetlink gestuurd naar het emailadres van de gebruiker.-->
<form method="POST" action="{{ route('password.email') }}">
    <!--Ik maak in de form gebruik van CSRF-prtectie.-->
    @csrf
    <div>
        <label for="email">E-mailadres:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <button type="submit">Wachtwoord reset link versturen</button>
</form>
@endsection