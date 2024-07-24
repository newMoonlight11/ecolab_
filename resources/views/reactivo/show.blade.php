@extends('layouts.app')

@section('template_title')
    {{ $reactivo->name ?? __('Show') . ' ' . __('Reactivo') }}
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn" href="{{ route('reactivos.index') }}"> <i class="bi bi-arrow-left-circle-fill fs-4 text-primary"></i></a>
                        </div>
                        <h3 class="text-center">Inventario</h3>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $reactivo->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Vencimiento:</strong>
                            {{ $reactivo->fecha_vencimiento }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $reactivo->cantidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Laboratorio:</strong>
                            {{ $reactivo->laboratorio }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Familia:</strong>
                            {{ $reactivo->familia }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
