@extends('layouts.app')

@section('template_title')
    {{ $reactivo->name ?? __('Show') . " " . __('Reactivo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Reactivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('reactivos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
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
