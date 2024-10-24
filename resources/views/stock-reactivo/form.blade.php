@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="fecha_stock" class="form-label">{{ __('Fecha Stock') }}</label>
        <input type="date" name="fecha_stock" class="form-control @error('fecha_stock') is-invalid @enderror"
            value="{{ old('fecha_stock', $stockReactivo?->fecha_stock) }}" id="fecha_stock" placeholder="Fecha Stock">
        {!! $errors->first('fecha_stock', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="cantidad_existencia" class="form-label">{{ __('Cantidad Existencia') }}</label>
        <input type="text" name="cantidad_existencia"
            class="form-control @error('cantidad_existencia') is-invalid @enderror"
            value="{{ old('cantidad_existencia', $stockReactivo?->cantidad_existencia) }}" id="cantidad_existencia"
            placeholder="Cantidad Existencia">
        {!! $errors->first(
            'cantidad_existencia',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="reactivo_id" class="form-label">{{ __('Reactivo') }}</label>
        <select name="reactivo_id" id="reactivo_id" class="form-control @error('reactivo_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un reactivo' }}</option>
            @foreach ($reactivos as $reactivo)
                <option value="{{ $reactivo->id }}"
                    {{ old('reactivo_id', $stockReactivo?->reactivo_id) == $reactivo->id ? 'selected' : '' }}>
                    {{ $reactivo->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('reactivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="laboratorio_id" class="form-label">{{ __('Laboratorio') }}</label>
        <select name="laboratorio_id" id="laboratorio_id"
            class="form-control @error('laboratorio_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un laboratorio' }}</option>
            @foreach ($laboratorios as $laboratorio)
                <option value="{{ $laboratorio->id }}"
                    {{ old('laboratorio_id', $stockReactivo?->laboratorio_id) == $laboratorio->id ? 'selected' : '' }}>
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
        <select name="unidad_id" id="unidad_id" class="form-control @error('unidad_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione la unidad' }}</option>
            @foreach ($unidads as $unidad)
                <option value="{{ $unidad->id }}"
                    {{ old('unidad_id', $stockReactivo?->unidad_id) == $unidad->id ? 'selected' : '' }}>
                    {{ $unidad->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')