@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Voeg een vraag toe</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.faqbeheer.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="vraag">Vraag</label>
                                <input id="vraag" type="text" class="form-control @error('vraag') is-invalid @enderror" name="vraag" value="{{ old('vraag') }}" required>
                                @error('vraag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="antwoord">Antwoord</label>
                                <textarea id="antwoord" class="form-control @error('antwoord') is-invalid @enderror" name="antwoord" required>{{ old('antwoord') }}</textarea>
                                @error('antwoord')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="categorieen">Categorieën</label>
                                <select id="categorieen" class="form-control @error('categorieen') is-invalid @enderror" name="categorieen[]" multiple required>
                                    @foreach ($categorieen as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->faq_categorienaam }}</option>
                                    @endforeach
                                </select>
                                @error('categorieen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Opslaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection