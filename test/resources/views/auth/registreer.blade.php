<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    <title>Document</title>
</head>
<body>
@include('partials.header')
    <!--Ik gebruik de route 'registreer' als action in onderstaand formulier.-->
<form method="POST" action="{{ route('registreer') }}">

    <!--@csrf staat voor Cross-Site Request Forgery.
    Er wordt een csrf token gecreëerd die het risico op csrf-aanvallen vermindert.
    Eigenlijk is @csrf een directive die helpt bij beveiliging.-->
    @csrf

    <!--Ik zet een autofocus op de naam, wat maakt dat dit veldje meteen gehighlight is.
    Tot nu toe heb ik alle velden required gemaakt.
    Met het type password kan ik deze met sterretjes laten verstoppen.
    De wachtwoorden van gebruikers worden binnen de database geëncrypteered.-->
    <div>
        <label for="name">Naam:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
    </div><br>

    <div>
        <label for="email">E-mailadres:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div><br>

    <div>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" id="password" required>
    </div><br>

    <div>
        <label for="password_confirmation">Bevestig wachtwoord:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div><br>

    <div>
        <button type="submit">Registreren</button>
    </div>
</form>
</body>
</html>