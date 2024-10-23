@extends('layouts.app')

@section('template_title')
    {{ $residuoLaboratorio->name ?? __('Show') . " " . __('Stock de residuos') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Stock de residuos</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('residuo-laboratorios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Stock:</strong>
                                    {{ $residuoLaboratorio->fecha_stock }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad Existencia:</strong>
                                    {{ $residuoLaboratorio->cantidad_existencia }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Residuo Id:</strong>
                                    {{ $residuoLaboratorio->residuo_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Laboratorio Id:</strong>
                                    {{ $residuoLaboratorio->laboratorio_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Id:</strong>
                                    {{ $residuoLaboratorio->unidad_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
