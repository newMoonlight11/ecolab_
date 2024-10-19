@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="fecha_movimiento" class="form-label">{{ __('Fecha Movimiento') }}</label>
        <input type="date" name="fecha_movimiento" class="form-control @error('fecha_movimiento') is-invalid @enderror"
            value="{{ old('fecha_movimiento', $movimiento?->fecha_movimiento) }}" id="fecha_movimiento"
            placeholder="Fecha Movimiento">
        {!! $errors->first(
            'fecha_movimiento',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
        <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
            value="{{ old('descripcion', $movimiento?->descripcion) }}" id="descripcion" placeholder="Descripcion">
        {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>

    <div class="form-group mb-2 mb20">
        <label for="tipo_movimiento" class="form-label">{{ __('Tipo Movimiento') }}</label>
        <select name="tipo_movimiento_id" id="tipo_movimiento_id"
            class="form-control @error('tipo_movimiento_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione una Tipo de Movimiento' }}</option>
            @foreach ($tipoMovimientos as $tipoMovimiento)
                <option value="{{ $tipoMovimiento->id }}"
                    {{ old('tipo_movimiento_id', $movimiento?->tipo_movimiento_id) == $tipoMovimiento->id ? 'selected' : '' }}>
                    {{ $tipoMovimiento->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first(
            'tipo_movimiento',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
@section('button_type', 'submit')
