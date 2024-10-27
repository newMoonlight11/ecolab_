@extends('layouts.app')

<link rel="stylesheet" href="css/prestamos.css">
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container-form bg-white border-0 rounded-4 pt-3 pb-2 pl-2 pr-2">
                    <h2 class="text-center mb-4">Movimientos</h2>
                    <div class="d-flex justify-content-center mb-4">
                        <!-- Botón Préstamo -->
                        <button id="btnPrestamo" type="button" class="btn btn-primary me-2 rounded-4">Préstamo</button>
                        <!-- Botón Devolución -->
                        <button id="btnDevolucion" type="button" class="btn btn-primary rounded-4">Devolución</button>
                    </div>

                    <!-- Formulario de movimiento -->
                    <form>
                        <!-- Nombre del reactivo -->
                        <div class="mb-3">
                            <label for="nombreReactivo" class="form-label">Nombre del reactivo</label>
                            <input type="text" class="form-control bg-white rounded-4" id="nombreReactivo"
                                placeholder="Nombre del reactivo">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-white rounded-4" id="email" placeholder="Email">
                        </div>

                        <!-- Cantidad -->
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control bg-white rounded-4" id="cantidad" placeholder="Cantidad">
                        </div>

                        <!-- Unidades -->
                        <div class="mb-3">
                            <label for="unidades" class="form-label">Unidades</label>
                            <select class="form-select bg-white rounded-4" id="unidades">
                                <option value="" disabled selected>Selecciona una unidad</option>
                                <option value="litros">Litros</option>
                                <option value="gramos">Gramos</option>
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control bg-white rounded-4" id="fecha">
                        </div>

                        <!-- Laboratorio -->
                        <div class="mb-3">
                            <label for="laboratorio" class="form-label">Laboratorio</label>
                            <select class="form-select bg-white rounded-4" id="laboratorio">
                                <option value="" disabled selected>Selecciona un laboratorio</option>
                                <option value="lab1">Laboratorio 1</option>
                                <option value="lab2">Laboratorio 2</option>
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