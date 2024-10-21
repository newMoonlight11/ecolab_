@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
            value="{{ old('nombre', $residuo?->nombre) }}" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="clase_residuo_id" class="form-label">{{ 'Clase Residuo Id' }}</label>
        <select name="clase_residuo_id" id="clase_residuo_id"
            class="form-control @error('clase_residuo_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione una clase' }}</option>
            @foreach ($claseResiduos as $claseResiduo)
                <option value="{{ $claseResiduo->id }}"
                    {{ old('clase_residuo_id', $residuo?->clase_residuo_id) == $claseResiduo->id ? 'selected' : '' }}>
                    {{ $claseResiduo->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('claseResiduo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')
