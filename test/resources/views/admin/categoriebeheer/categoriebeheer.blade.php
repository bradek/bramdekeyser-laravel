<!-- view/admin/categoriebeheer.blade.php -->
@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categorie Beheer</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.categoriebeheer.create') }}" class="btn btn-primary">Nieuwe categorie</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorieen as $categorie)
                                    <tr>
                                        <td>{{ $categorie->faq_categorienaam }}</td>
                                        <td>
                                            <a href="{{ route('admin.categoriebeheer.edit', $categorie->id) }}" class="btn btn-sm btn-primary">Wijzigen</a>
                                            <form method="POST" action="{{ route('admin.categoriebeheer.destroy', $categorie->id) }}" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')">Verwijderen</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
