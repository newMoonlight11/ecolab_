@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-2 text-center">
                            <br>
                            <br>
                            <img class="img-logo" src="{{ asset('images/ecolab_blue1.png') }}">
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <p class="text-center">Bienvenido de nuevo!</p>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="{{ __('Correo electrónico') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="{{ __('Contraseña') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 text-center">
                                {{-- <br> --}}
                                <button type="submit" class="button_login">
                                    {{ __('INICIAR SESIÓN') }}
                                </button>
                            </div>
                            <div class="col-md-8 offset-md-2 d-flex justify-content-between align-items-center">
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                        
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div> --}}
                                <div class="linea flex-grow-1"></div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 d-flex justify-content-between align-items-center">
                                <p>¿No tienes cuenta?</p>
                                <a class="btn btn-link" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
