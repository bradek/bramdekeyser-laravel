@extends('layouts.basis')

    @section('content')
    <h1>Boeken</h1>

    <table class="boekentabel">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Titel</th>
                <th>Prijs</th>
                <th>Beschrijving</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boeken as $boek)
                <tr>
                    <td class="boekcover">
                        @if($boek->cover_afbeelding)
                            <img src="{{ asset($boek->cover_afbeelding) }}" alt="{{ $boek->titel }}" class="coverafbeelding" style="width: 100px;">
                        @endif
                    </td>
                    <td class="boektitel">{{ $boek->titel }}</td>
                    <td class="boekprijs">€{{ $boek->prijs }}</td>
                    <td class="boekbeschrijving">{{ $boek->beschrijving }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection