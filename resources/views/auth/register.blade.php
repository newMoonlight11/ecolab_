@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <br>
                                    <br>
                                    <p class="color-blue">¡Crea tu cuenta!</p>
                                    <p>Por favor, ingresa tu información en los campos</p>
                                </div>
                                <div class="col-md-8 offset-md-2">
                                    <input id="name" type="text"
                                        class="form-control bg-white rounded-4 @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="{{ __('Nombre') }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <input id="email" type="email"
                                        class="form-control bg-white rounded-4 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
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
                                        class="form-control bg-white rounded-4 @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        placeholder="{{ __('Contraseña') }}">

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
                                        placeholder="{{ __('Confirma la contraseña') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-3 d-flex justify-content-between align-items-center">
                                    <input class="form-check-input" type="checkbox" name="aceptar_terminos"
                                        id="aceptar_terminos" required>
                                    <label for="aceptar_terminos">Acepto los términos y condiciones</label>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                        data-bs-target="#termsModal"><i
                                            class="bi bi-shield-check text-primary fs-5"></i></button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button id="open-popup-ok" type="submit" class="btn btn-primary rounded-4 w-75">
                                        {{ __('REGÍSTRATE') }}
                                    </button>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 px-3">
                <div class="modal-header">
                    <h5 class="modal-title text-primary text-center w-100 fs-3" id="termsModalLabel">Términos y Condiciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="subtitulo fw-bold">1. Introducción</p>
                    <p class="parrafo-tc text-justify">Este documento establece los términos y condiciones para el uso del sistema de
                        información
                        para la gestión de reactivos y residuos químicos de la Universidad Autónoma de Bucaramanga (UNAB).
                        Al
                        utilizar este software, el usuario acepta cumplir con estos términos y condiciones.</p>
                    <p class="subtitulo fw-bold">2. Propiedad intelectual</p>
                    <p class="parrafo-tc text-justify">El software, sus contenidos y todos los derechos relacionados son propiedad de
                        María
                        Camila Villamizar Villamizar & Carlos Fernando Escobar Silva. Cualquier reproducción, distribución,
                        modificación o uso no autorizado está prohibido y será sancionado según la legislación colombiana.
                    </p>
                    <p class="subtitulo fw-bold">3. Licencia de uso</p>
                    <p class="parrafo-tc text-justify">El software se licencia para uso exclusivo de la UNAB y sus laboratorios. El
                        usuario no
                        puede copiar, distribuir, modificar o crear trabajos derivados del software sin autorización expresa
                        por
                        escrito de los propietarios.</p>
                    <p class="subtitulo fw-bold">4. Responsabilidades del usuario</p>
                    <p class="parrafo-tc text-justify">El usuario se compromete a usar el software de manera ética y legal. Se prohíbe el
                        hacking, el uso indebido, la difusión de malware, el acceso no autorizado a cuentas de otros
                        usuarios y
                        cualquier actividad que infrinja la ley o las políticas internas de la UNAB.</p>
                    <p class="subtitulo fw-bold">5. Privacidad y protección de datos</p>
                    <p class="parrafo-tc text-justify">La UNAB se compromete a proteger la información personal del usuario de acuerdo
                        con la Ley
                        1581 de 2012 de Colombia. El software puede utilizar cookies para mejorar la experiencia del usuario
                        y
                        recopilar datos personales para fines de funcionamiento del sistema. El tratamiento de datos
                        personales se
                        llevará a cabo de acuerdo con las leyes de protección de datos vigentes en Colombia.</p>
                    <p class="subtitulo fw-bold">6. Limitaciones de responsabilidad</p>
                    <p class="parrafo-tc text-justify">El software se proporciona "tal cual". La UNAB no se responsabiliza por daños o
                        pérdidas
                        causadas por errores, fallos del sistema, interrupciones del servicio o uso indebido del software.
                        El
                        usuario asume toda la responsabilidad por el uso del software y sus consecuencias.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <p>Proyecto de grado II - María Camila Villamizar Villamizar & Carlos Fernando Escobar</p>
                </div>
            </div>
        </div>
    </div>
@endsection
