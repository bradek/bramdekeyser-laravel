@extends('layouts.adminlayout')

@section('content')
    <h1>Nieuwsbeheer</h1>

    <a href="{{ route('admin.nieuwsbeheer.create') }}" class="btn btn-primary">Nieuw Nieuwsbericht</a>

    <table class="table">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Categorie</th>
                <th>Publicatiedatum</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nieuwsberichten as $nieuws)
                <tr>
                    <td>{{ $nieuws->title }}</td>
                    <td>{{ $nieuws->categorie->name }}</td>
                    <td>{{ $nieuws->publication_date }}</td>
                    <td>
                        <a href="{{ route('admin.nieuwsbeheer.edit', $nieuws->id) }}" class="btn btn-primary">Bewerken</a>
                        <form action="{{ route('admin.nieuwsbeheer.destroy', $nieuws->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection