@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Wijzig vraag</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.faqbeheer.update', $faqVraag->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="vraag">Vraag</label>
                                <input id="vraag" type="text" class="form-control @error('vraag') is-invalid @enderror" name="vraag" value="{{ old('vraag', $faqVraag->vraag) }}" required>
                                @error('vraag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="antwoord">Antwoord</label>
                                <textarea id="antwoord" class="form-control @error('antwoord') is-invalid @enderror" name="antwoord" required>{{ old('antwoord', $faqVraag->antwoord) }}</textarea>
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
                                        <option value="{{ $categorie->id }}" @if (in_array($categorie->id, old('categorieen', $faqVraag->categorieen->pluck('id')->toArray()))) selected @endif>{{ $categorie->faq_categorienaam }}</option>
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