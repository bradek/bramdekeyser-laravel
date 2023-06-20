@extends('layouts.adminlayout')

    @section('content')
    <h1>Admin Pagina</h1>

    <br>
    <div class="adminsubnav">
        <a href="{{ route('admin.nieuwsbeheer.index') }}">Nieuwsbeheer</a> 
        <a href="{{ route('admin.faqbeheer') }}">FAQ Beheer</a>
        <a href="{{ route('admin.categoriebeheer') }}">Categoriebeheer</a>
    </div>
    <br>
    <!-- Toon een lijst van gebruikers -->
    <ul>
        @foreach ($users as $user)
            <li>
                <!--De naam van de gebruiker wordt weergegeven met tussen haakjes of deze
                een gewone gebruiker is of een admin.
                In de if-statement wordt nagegaan of isAdmin() al dan niet op true staat.
                Deze heb ik gemaakt in de vorm van een ternaire if.
                Indien de gebruiker ook een admin is, zal er (admin) staan na de naam.
                Wanneer dit niet het geval is, staat er (gebruiker).-->
                {{ $user->name }}
                @if (auth()->user()->isAdmin())
                {{ $user->isAdmin() ? ' (admin)' : ' (gebruiker)' }}
                @endif

                <!--Bij elke iteratie (= elke gebruiker) komt een knop tevoorschijn waarmee de Admin Status kan worden
                beïnvloedt.
                De uitvoering hiervan gebeurt via de route admin.toggleAdminStatus, die gebruik maakt van de
                AdminController.-->
                <form action="{{ route('admin.toggleAdminStatus', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!--Ik gebruik hieronder nog twee ternaire if's die ervoor dienen de knop aan te passen
                    afhankelijk van de Admin status.
                    Dit gaat dan over hoe deze toggle knop eruitziet.-->
                    <button type="submit" class="{{ $user->isAdmin() ? 'admin-aanzetten' : 'admin-uitzetten' }}">
                    {{ $user->isAdmin() ? 'Rechten ontnemen' : 'Rechten geven' }}
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection