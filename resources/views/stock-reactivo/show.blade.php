@extends('layouts.app')

@section('template_title')
    {{ $stockReactivo->name ?? __('Show') . " " . __('Stock Reactivo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Stock Reactivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('stock_reactivos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Stock:</strong>
                                    {{ $stockReactivo->fecha_stock }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad Existencia:</strong>
                                    {{ $stockReactivo->cantidad_existencia }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reactivo Id:</strong>
                                    {{ $stockReactivo->reactivo_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Laboratorio Id:</strong>
                                    {{ $stockReactivo->laboratorio_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Id:</strong>
                                    {{ $stockReactivo->unidad_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
