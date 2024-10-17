@extends('layouts.app')

@section('template_title')
    {{ $itemMovimiento->name ?? __('Show') . " " . __('Item Movimiento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Item Movimiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('item_movimiento.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Cantidad:</strong>
                                    {{ $itemMovimiento->cantidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reactivo Id:</strong>
                                    {{ $itemMovimiento->reactivo_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Movimiento Id:</strong>
                                    {{ $itemMovimiento->movimiento_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
