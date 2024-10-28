@extends('layouts.app')

@section('template_title')
    {{ $prestamo->name ?? __('Show') . " " . __('Prestamo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Prestamo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('prestamos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Reactivo Id:</strong>
                                    {{ $prestamo->reactivo_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Id:</strong>
                                    {{ $prestamo->unidad_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Laboratorio Id:</strong>
                                    {{ $prestamo->laboratorio_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad:</strong>
                                    {{ $prestamo->cantidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $prestamo->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $prestamo->email }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
