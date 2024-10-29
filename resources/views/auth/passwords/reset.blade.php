@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 text-center">
                                <p class="color-blue">Restablecer contraseña</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <input id="email" type="email"
                                        class="form-control bg-white rounded-4 @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus placeholder="{{ __('Correo electrónico') }}">
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
                                        class="form-control bg-white rounded-4 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        placeholder="{{ __('Nueva Contraseña') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <input id="password-confirm" type="password" class="form-control bg-white rounded-4"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="{{ __('Confirmar Nueva Contraseña') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button type="submit" class="btn btn-primary rounded-4 w-75">
                                        {{ __('Restablecer Contraseña') }}
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
