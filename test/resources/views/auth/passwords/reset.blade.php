@extends('layouts.basis')

@section('content')
    <div class="card">
        <!--Afhankelijk van de taal van de Laravel zal 'Reset Password' vertaalt worden.-->
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
            <!--Binnen in de card-body link ik naar de route password.update.
            Als het formulier wordt ingediend, wordt de methode aangeroepen die de gegevens bewaart
            en je redirect naar de login-pagina.
            ['token' => $token] dient de resettoken als parameter mee te geven aan de URL.-->
        <form method="POST" action="{{ route('password.update', ['token' => $token]) }}">

                @csrf

                <!--De aanwezigheid van de token is required.
                Gelukkig laat ik deze er automatisch bij zijn via een input die verborgen is.
                Ergo, de gebruiker hoeft zich hierover niet te bekommeren.-->
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        <!--Als er in de email een fout is, wordt er een span aangemaakt.
                        In deze span wordt er vetgedrukt de nodige error message gegeven.-->
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        
                        <!--Als er in het password een fout is, wordt er een span aangemaakt.
                        In deze span wordt er vetgedrukt de nodige error message gegeven.-->
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <!--De password_confirm moet overeenkomen met het initiële password.-->
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection