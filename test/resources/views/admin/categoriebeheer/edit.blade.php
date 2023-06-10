<!-- view/admin/edit.blade.php -->
@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categorie bewerken</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categoriebeheer.update', $categorie->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="faq_categorienaam">Naam:</label>
                                <input type="text" name="naam" id="faq_categorienaam" class="form-control" value="{{ $categorie->faq_categorienaam }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Opslaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
