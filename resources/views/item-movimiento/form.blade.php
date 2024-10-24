@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
        <input type="text" name="cantidad" class="form-control bg-white rounded-4 @error('cantidad') is-invalid @enderror"
            value="{{ old('cantidad', $itemMovimiento?->cantidad) }}" id="cantidad" placeholder="Cantidad">
        {!! $errors->first('cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="reactivo_id" class="form-label">{{ __('Reactivo') }}</label>
        <select name="reactivo_id" id="reactivo_id" class="form-control bg-white rounded-4 @error('reactivo_id') is-invalid @enderror">
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
        <select name="movimiento_id" id="movimiento_id" class="form-control bg-white rounded-4 @error('movimiento_id') is-invalid @enderror">
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
@section('button_type', 'submit')
