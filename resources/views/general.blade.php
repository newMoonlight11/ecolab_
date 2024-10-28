@extends('layouts.app')

<link rel="stylesheet" href="css/prestamos.css">
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container-form bg-white border-0 rounded-4 pt-3 pb-2 pl-2 pr-2">
                    <h2 class="text-center mb-4">Préstamos</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Formulario de movimiento -->
                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nombre del reactivo -->
                        <div class="mb-3">
                            <label for="reactivo_id" class="form-label">Nombre del reactivo</label>
                            <select class="form-select bg-white rounded-4" name="reactivo_id" id="reactivo_id" required>
                                <option value="" disabled selected>Seleccione un reactivo</option>
                                @foreach ($reactivos as $reactivo)
                                    <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-white rounded-4" name="email" id="email" placeholder="Email" required>
                        </div>

                        <!-- Cantidad -->
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control bg-white rounded-4" name="cantidad" id="cantidad" placeholder="Cantidad" required>
                        </div>

                        <!-- Unidades -->
                        <div class="mb-3">
                            <label for="unidad_id" class="form-label">Unidades</label>
                            <select class="form-select bg-white rounded-4" name="unidad_id" id="unidad_id" required>
                                <option value="" disabled selected>Seleccione una unidad</option>
                                @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control bg-white rounded-4" name="fecha" id="fecha" required>
                        </div>

                        <!-- Laboratorio -->
                        <div class="mb-3">
                            <label for="laboratorio_id" class="form-label">Laboratorio</label>
                            <select class="form-control bg-white rounded-4" name="laboratorio_id" id="laboratorio_id" required>
                                <option value="" disabled selected>Seleccione un laboratorio</option>
                                @foreach ($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de enviar -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded-4">Solicitar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/prestamos.js') }}"></script>
