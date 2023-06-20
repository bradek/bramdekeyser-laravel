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
            <p style="font-size: 18px; color:">Welkom op mijn website over boeken!<br>
            Op de about-pagina kunnen alle verwijzingen naar bronnen worden gevonden.<br>
            Deze website bevat een werkend registratie-systeem, login systeem contact formulier en gastenboek.<br>
            Er is ook een pagina 'Laatste nieuws' waaraan CRUD-methoden zijn verbonden die vindbaar zijn in het admin-gedeelte.<br>
            Het admin-gedeelte wordt zichtbaar wanneer je als admin bent ingelogd.<br>
            Er is een lijst van mijn boeken op de boeken pagina en er is een FAQ met categorieën.<br>
            Op de profielpagina kunnen gebruikers hun gegevens inkijken en wijzigen.</p>
    @endsection