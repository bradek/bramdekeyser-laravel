@extends('layouts.basis')

@section('content')
<!--<br><br>
    @if(Session::has('succes'))
        <label class="alert alert-success text-right" id="success-alert">
            {{ Session::get('succes') }}
        </label><br>
    @endif
    <br>-->

    <!--Ik gebruik de route 'registreer' als action in onderstaand formulier.-->
    <form action="{{ route('registreer') }}" method="post" enctype="multipart/form-data">

    <!--De standaard wijze waarop de errors staan beschreven bij het aanroepen van $errors is niet esthetisch
    In de if-statement geldt indien er errors zijn het volgende:
    Voor elke error, wordt een paragraaf gemaakt waarin de error wordt weergegeven.-->
    @if($errors)
        @foreach($errors->all() as $errors)
            <p>
                {{$errors}}
            </p>
        @endforeach
    @endif

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
            <label for="about_me">Over mij:</label>
            <textarea name="about_me" id="about_me" maxlength="150" required>{{ old('about_me') }}</textarea>
        </div><br>

        <div>
            <label for="birthdate">Geboortedatum:</label>
            <input type="date" name="birthdate" id="birthdate" required>
        </div><br>

        <div>
            <label for="avatar">Avatar:</label>
            <input type="file" name="avatar" id="avatar" accept=".jpg, .jpeg, .png, .gif, .bmp, .svg" class="form-control-file" required>
        </div><br>

    <div>
        <button type="submit">Registreren</button>
    </div>
</form>
@endsection