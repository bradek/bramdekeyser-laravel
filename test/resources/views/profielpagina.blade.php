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
  <h1>Profiel</h1>
  <br>
  <h2>Naam: {{$user->name}}</h2>
  <h2>Email: {{$user->email}}</h2>

  <!--De wijzigingen die de gebruiker kan maken zijn van toepassing op de eigen gebruiker.
  Ik maak gebruik van de profielpagina.update route, die gebruik maakt van de ProfielController.
  Via een PUT-verzoek wordt een verzoek naar de update()-methode gestuurd.-->
  <form action="{{ route('profielpagina.update') }}" method="POST">
    @csrf
    @method('PUT')

    <!--De gebruiker kan zijn naam, email an wachtwoord tot nu toe hier vervangen.
    Hier gaan nog dingen aan gewijzigd en toegevoegd worden.
    Wanneer de gebruiker bepaalde gegevens hetzelfde wil houden, hoeft hij deze gewoon opnieuw in te geven.
    Bijvoorbeeld: Je naam is 'Jef' en je wil dat het 'Jef' blijft, dan schrijf je gewoon weer Jef.
    Ik wil dat het wachtwoord wel wordt geconfirmed.
    Een typfout is snel gebeurd en dan is het moeilijk nog in te loggen,
    dus tracht ik deze twee maal op dezelfde manier te ontvangen-->
    <div class="form-group">
      <label for="name">Naam</label>
      <input type="text" name="name" id="name" value="{{ $user->name }}" required>
    </div><br>

    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" value="{{ $user->email }}" required>
    </div><br>

    <div class="form-group">
      <label for="password">Wachtwoord</label>
      <input type="password" name="password" id="password" required>
    </div><br>

    <div class="form-group">
      <label for="password_confirmation">Bevestig wachtwoord</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div><br>

    <button type="submit">Opslaan</button>
  </form>
</body>
</html>