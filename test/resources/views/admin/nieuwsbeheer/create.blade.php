@extends('layouts.adminlayout')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nieuw nieuwsbericht</div>

                    <div class="card-body">
                        <!--Ik maak van de route admin.nieuwsbeheer.store gebruik in de POST binnen mijn create-formulier.
                        Hier wordt de informatie verwerkt.
                        De route roept de methode 'store' aan die de informatie in de databank hoort op te slaan.
                        De enctype die ik heb toegevoegd is nodig voor het opslaan van de cover_image.-->
                        <form method="POST" action="{{ route('admin.nieuwsbeheer.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Titel</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id">Categorie</label>
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                    <option value="">-- Selecteer een categorie --</option>
                                    <!--Er wordt geloopt doorheen de categorieen, voor elke categorie wordt een option gemaakt.
                                    Deze option bevat de waarde van die specifieke categorie, die via de id wordt gezocht.
                                    Als een specifieke categorie wordt aangeduid, hoort deze de categorie naam over te nemen.-->
                                    @foreach ($categorieen as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <!--Als er zich een fout plaatsvindt bij category_id, wordt er in een span een foutmelding getoond.-->
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cover_image">Cover-afbeelding</label>
                                <input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" required>

                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Beschrijving</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description') }}</textarea>

                                @error('description')
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