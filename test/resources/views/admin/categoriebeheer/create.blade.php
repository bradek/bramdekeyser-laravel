<!-- view/admin/create.blade.php -->
@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nieuwe categorie toevoegen</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categoriebeheer.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="faq_categorienaam">Naam:</label>
                                <input type="text" name="naam" id="faq_categorienaam" class="form-control">
                            </div>

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
                </div>
            </div>
        </div>
    </div>
@endsection