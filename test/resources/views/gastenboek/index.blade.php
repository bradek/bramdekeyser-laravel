@extends('layouts.basis')

    @section('content')
    <h1>Gastenboek</h1>

    <form method="POST" action="{{ route('gastenboek.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Naam"><br><br>
        <textarea name="message" placeholder="Bericht"></textarea><br>
        <button type="submit">Plaats bericht</button>
    </form>

    <hr>

    <h2>Berichten</h2>

    @foreach ($messages as $message)
        <p>
            <strong>{{ $message->name }}:</strong>
            {{ $message->message }}
        </p>
    @endforeach
@endsection
