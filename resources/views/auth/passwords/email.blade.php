@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 text-center">
                                <p class="color-blue">¿Olvidaste tu contraseña?</p>
                                <p>Ingresa tu correo para recibir un enlace de restablecimiento</p>
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <input id="email" type="email"
                                        class="form-control bg-white rounded-4 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="{{ __('Correo electrónico') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button type="submit" class="btn btn-primary rounded-4 w-75">
                                        {{ __('Enviar enlace de restablecimiento') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
