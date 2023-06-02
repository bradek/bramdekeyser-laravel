@extends('layouts.basis')

    @section('content')
    <h1>FAQ</h1>

@foreach ($categorieen as $categorie)
    <h2>{{ $categorie->faq_categorienaam }}</h2>

    <ul>
        @foreach ($categorie->vragen as $vraag)
            <li>
                <h3>{{ $vraag->vraag }}</h3>
                <p>{{ $vraag->antwoord }}</p>
            </li>
        @endforeach
    </ul>
@endforeach
    @endsection