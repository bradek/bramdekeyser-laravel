@extends('layouts.basis')

    @section('content')
       <h1>Home</h1>
       <br><br>
       <!--Als de sessie 'succes' is opgestart, kan deze worden aangeroepen.
        Deze is van toepassing wanneer een gebruiker is aangemaakt.
        In dit geval wordt de melding aangeroepen en geplaatst in een label.
        Deze label heb ik van standaard bootstrap voorzien.-->
            @if(Session::has('succes'))
                <label class="alert alert-success text-right" id="success-alert">
                    {{ Session::get('succes') }}
                </label><br>
            @endif
    @endsection