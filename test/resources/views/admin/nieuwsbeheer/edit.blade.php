@extends('layouts.adminlayout')

    @section('content')
    <div class="container">
        <h1>Nieuwsbericht bewerken</h1>
        <form action="{{ route('admin.nieuwsbeheer.update', $nieuwsbericht->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $nieuwsbericht->title }}">
            </div>

            <div class="form-group">
                <label for="category">Categorie:</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach ($categorieen as $categorie)
                        <option value="{{ $categorie->id }}" {{ $categorie->id == $nieuwsbericht->category_id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!--<div class="form-group">
                <label for="cover_image">Cover-afbeelding:</label>
                <input type="text" name="cover_image" id="cover_image" class="form-control" value="{{ $nieuwsbericht->cover_image }}">
            </div>-->

            <div class="form-group">
                <label for="cover_image">Cover-afbeelding</label>
                <input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">

                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <textarea name="description" id="description" class="form-control">{{ $nieuwsbericht->description }}</textarea>
            </div>

            <!-- Voeg hier andere velden toe voor de rest van de nieuwsberichtgegevens -->
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
    @endsection