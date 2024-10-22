@extends('layouts.app')

@section('template_title')
    {{ $movimiento->name ?? __('Show') . " " . __('Movimiento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Movimiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('movimientos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Movimiento:</strong>
                                    {{ $movimiento->fecha_movimiento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $movimiento->descripcion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Movimiento:</strong>
                                    {{ $movimiento->tipo_movimiento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Usuario Id:</strong>
                                    {{ $movimiento->usuario_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
