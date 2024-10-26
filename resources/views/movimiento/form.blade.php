@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="fecha_movimiento" class="form-label">{{ __('Fecha') }}</label>
        <input type="date" name="fecha_movimiento" class="form-control bg-white rounded-4 @error('fecha_movimiento') is-invalid @enderror"
            value="{{ old('fecha_movimiento', $movimiento?->fecha_movimiento) }}" id="fecha_movimiento" placeholder="Fecha">
        {!! $errors->first(
            'fecha_movimiento',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
        <input type="text" name="descripcion" class="form-control bg-white rounded-4 @error('descripcion') is-invalid @enderror"
            value="{{ old('descripcion', $movimiento?->descripcion) }}" id="descripcion" placeholder="Descripcion">
        {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="tipo_movimiento" class="form-label">{{ __('Tipo de movimiento') }}</label>
        <select name="tipo_movimiento" id="tipo_movimiento"
            class="form-control bg-white rounded-4 @error('tipo_movimiento') is-invalid @enderror">
            <option value="">{{ 'Seleccione un tipo de movimiento' }}</option>
            @foreach ($tipoMovimientos as $tipoMovimiento)
                <option value="{{ $tipoMovimiento->id }}"
                    {{ old('tipo_movimiento', $movimiento?->tipo_movimiento) == $tipoMovimiento->id ? 'selected' : '' }}>
                    {{ $tipoMovimiento->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first(
            'tipo_movimiento',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="usuario_id" class="form-label">{{ __('Usuario') }}</label>
        <input type="text" name="usuario_id" class="form-control bg-white rounded-4 @error('usuario_id') is-invalid @enderror"
            value="{{ Auth::user()->name }}" id="usuario_id" placeholder="Usuario" disabled>
        <input type="hidden" name="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror"
            value="{{ Auth::id() }}">
        {!! $errors->first('usuario_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')
