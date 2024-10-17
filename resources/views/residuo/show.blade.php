@extends('layouts.app')

@section('template_title')
    {{ $residuo->name ?? __('Show') . " " . __('Residuo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Residuo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('residuos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $residuo->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Clase Residuo Id:</strong>
                                    {{ $residuo->clase_residuo_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
