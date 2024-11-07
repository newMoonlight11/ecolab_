@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
        <input type="text" name="cantidad" class="form-control bg-white rounded-4 @error('cantidad') is-invalid @enderror"
            value="{{ old('cantidad', $itemMovimiento?->cantidad) }}" id="cantidad" placeholder="Cantidad">
        {!! $errors->first('cantidad', 
        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <labeubicacion" class="form-label">{{ __('Ubicacion') }}</label>
        <input type="text" name="ubicacion" class="form-control bg-white rounded-4 @error('ubicacion') is-invalid @enderror"
            value="{{ old('ubicacion', $itemMovimiento?->ubicacion) }}" id="ubicacion" placeholder="Ubicación en el laboratorio">
        {!! $errors->first('ubicacion', 
        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <labeubicacion" class="form-label">{{ __('Código UNAB') }}</label>
        <input type="text" name="codigoUNAB" class="form-control bg-white rounded-4 @error('codigoUNAB') is-invalid @enderror"
            value="{{ old('codigoUNAB', $itemMovimiento?->codigoUNAB) }}" id="codigoUNAB" placeholder="Código UNAB">
        {!! $errors->first('codigoUNAB', 
        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="fechaVencimiento" class="form-label">{{ __('Fecha') }}</label>
        <input type="date" name="fechaVencimiento"
            class="form-control bg-white rounded-4 @error('fechaVencimiento') is-invalid @enderror"
            value="{{ old('fechaVencimiento', $itemMovimiento?->fechaVencimiento) }}" id="fechaVencimiento" placeholder="Fecha de vencimiento">
        {!! $errors->first(
            'fechaVencimiento',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="reactivo_id" class="form-label">{{ __('Reactivo') }}</label>
        <select name="reactivo_id" id="reactivo_id"
            class="form-control bg-white rounded-4 @error('reactivo_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un reactivo' }}</option>
            @foreach ($reactivos as $reactivo)
                <option value="{{ $reactivo->id }}"
                    {{ old('reactivo_id', $itemMovimiento?->reactivo_id) == $reactivo->id ? 'selected' : '' }}>
                    {{ $reactivo->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('reactivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="movimiento_id" class="form-label">{{ __('Movimiento') }}</label>
        <select name="movimiento_id" id="movimiento_id"
            class="form-control bg-white rounded-4 @error('movimiento_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un movimiento' }}</option>
            @foreach ($movimientos as $movimiento)
                <option value="{{ $movimiento->id }}"
                    {{ old('movimiento_id', $itemMovimiento?->movimiento_id) == $movimiento->id ? 'selected' : '' }}>
                    {{ $movimiento->descripcion }}
                </option>
            @endforeach
        </select>
        {!! $errors->first(
            'movimiento_id',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="laboratorio_id" class="form-label">{{ __('Laboratorio') }}</label>
        <select name="laboratorio_id" id="laboratorio_id"
            class="form-control bg-white rounded-4 @error('laboratorio_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un laboratorio' }}</option>
            @foreach ($laboratorios as $laboratorio)
                <option value="{{ $laboratorio->id }}"
                    {{ old('laboratorio_id', $itemMovimiento?->laboratorio_id) == $laboratorio->id ? 'selected' : '' }}>
                    {{ $laboratorio->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first(
            'laboratorio_id',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="unidad_id" class="form-label">{{ __('Unidad') }}</label>
        <select name="unidad_id" id="unidad_id"
            class="form-control bg-white rounded-4 @error('unidad_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione la unidad' }}</option>
            @foreach ($unidads as $unidad)
                <option value="{{ $unidad->id }}"
                    {{ old('unidad_id', $itemMovimiento?->unidad_id) == $unidad->id ? 'selected' : '' }}>
                    {{ $unidad->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')
