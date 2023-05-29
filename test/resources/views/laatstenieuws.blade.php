@extends('layouts.basis')

    @section('content')
        <h1>Laatste nieuws</h1>
    
        <!--In een lus wordt er doorheen de nieuwsitems gegaan in de tabel nieuws.
        Hierin worden de title, categorie naam, cover_image, description en publication_date weergegeven.
        Deze worden bij elke iteratie in een divider gestoken waar de juiste html-tags worden aangemaakt.-->
            @foreach ($nieuwsitems as $nieuws)
                <div class="nieuws-item">
                    <h2>{{ $nieuws->title }}</h2>
                    <p>Categorie: {{ $nieuws->categorie->name }}</p>
                    <img src="{{ $nieuws->cover_image }}" alt="{{ $nieuws->title }}">
                    <p>{{ $nieuws->description }}</p>
                    <p>Publicatiedatum: {{ $nieuws->publication_date }}</p>
                </div>
    @endforeach

@endsection