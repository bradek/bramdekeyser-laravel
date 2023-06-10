@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">FAQ Beheer</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.faqbeheer.create') }}" class="btn btn-primary">Nieuwe vraag</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vraag</th>
                                    <th>Categorieën</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqVragen as $vraag)
                                    <tr>
                                        <td>{{ $vraag->vraag }}</td>
                                        <td>
                                            @foreach ($vraag->categorieen as $categorie)
                                                <span class="badge badge-primary">{{ $categorie->faq_categorienaam }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.faq.edit', $vraag->id) }}" class="btn btn-sm btn-primary">Wijzigen</a>
                                            <form method="POST" action="{{ route('admin.faqbeheer.destroy', $vraag->id) }}" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">Verwijderen</button>
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