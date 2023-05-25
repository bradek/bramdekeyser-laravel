<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    <title>Login</title>
</head>
<body>
@include('partials.header')
    <h1>Login</h1>

    <!--Er wordt nagegaan of er fouten zijn opgetreden bij eerdere acties.
    In dit geval zou dit dus gelden op het indienen van het formulier.
    Het is via de $errors variabele dat .blade.php-files foutberichten kan weergeven.
    De foutberichten zoals 'Er is geen @ aanwezig in uw email,' zijn dus niet door mij zelf opgesteld.
    Wat ik hieronder doe, dient ervoor te zorgen dat Laravel dit voor mij doet.-->
    @if ($errors->any())
        <div>
            <ul>
                <!--Fouten worden hieronder weergegeven.
                Bij elke fout wordt een list item aangemaakt die de fout weergeeft.--> 
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!--Ik gebruik de route 'login' als action in onderstaand formulier.-->
    <form method="POST" action="/auth/login">
        
        <!--@csrf staat voor Cross-Site Request Forgery.
        Er wordt een csrf token gecreëerd die het risico op csrf-aanvallen vermindert.
        Eigenlijk is @csrf een directive die helpt bij beveiliging.-->
        @csrf

        <!--De twee velden zijn verplicht.
        Wanneer de combinatie van een correct emailadres en een correct wachtwoord wordt ingegeven, 
        raakt de gebruiker ingelogd.-->
        <div>
            <label for="email">E-mailadres:</label>
            <input type="email" name="email" id="email" required>
        </div><br>

        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password" required>
        </div><br>

        <!--Bij deze checkbox kan je aanduiden of je als gebruiker onthouden wil worden of niet.-->
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Onthoud mij</label>
        </div><br>

        <div>
            <button type="submit">Inloggen</button>
        </div>
    </form><br>
    <!--Hieronder is een uitlog knop die gebruik maakt van de route uitloggen.
    Hierin wordt de gebruiker o.a. naar de index-pagina geredirect.-->
    <form method="POST" action="/auth/uitloggen">
    <!--Ook hier gebruik ik csrf-beveiliging.-->
    @csrf
    <button type="submit">Uitloggen</button><br>
    <a href="{{ route('password.request') }}">Wachtwoord vergeten?</a>
</form>
</body>
</html>