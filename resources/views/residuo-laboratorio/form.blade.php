@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="fecha_stock" class="form-label">{{ __('Fecha de stock') }}</label>
        <input type="date" name="fecha_stock"
            class="form-control bg-white rounded-4 @error('fecha_stock') is-invalid @enderror"
            value="{{ old('fecha_stock', $residuoLaboratorio?->fecha_stock) }}" id="fecha_stock" placeholder="Fecha de stock">
        {!! $errors->first('fecha_stock', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="cantidad_existencia" class="form-label">{{ __('Cantidad en existencia') }}</label>
        <input type="text" name="cantidad_existencia"
            class="form-control bg-white rounded-4 @error('cantidad_existencia') is-invalid @enderror"
            value="{{ old('cantidad_existencia', $residuoLaboratorio?->cantidad_existencia) }}" id="cantidad_existencia"
            placeholder="Cantidad en existencia">
        {!! $errors->first(
            'cantidad_existencia',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="d-flex align-items-end mb-2">
        <div class="form-group flex-grow-1 me-2">
            <label for="residuo_id" class="form-label">{{ __('Residuo') }}</label>
            <select name="residuo_id" id="residuo_id"
                class="form-control bg-white rounded-4 @error('residuo_id') is-invalid @enderror">
                <option value="">{{ 'Seleccione un residuo' }}</option>
                @foreach ($residuos as $residuo)
                    <option value="{{ $residuo->id }}"
                        {{ old('residuo_id', $residuoLaboratorio?->residuo_id) == $residuo->id ? 'selected' : '' }}>
                        {{ $residuo->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('residuo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="text-center">
            <a href="{{ route('residuos.create', ['from' => 'residuo-laboratorios/create']) }}"
                class="btn btn-primary ms-2 rounded-3" data-bs-toggle="tooltip" 
                title="Puedes crear el residuo dando click acá" 
                data-placement="top"><i
                    class="bi bi-plus-circle fs-5"></i></a>
        </div>
    </div>

    <div class="form-group mb-2 mb20">
        <label for="laboratorio_id" class="form-label">{{ __('Laboratorio') }}</label>
        <select name="laboratorio_id" id="laboratorio_id"
            class="form-control bg-white rounded-4 @error('laboratorio_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione un laboratorio' }}</option>
            @foreach ($laboratorios as $laboratorio)
                <option value="{{ $laboratorio->id }}"
                    {{ old('laboratorio_id', $residuoLaboratorio?->laboratorio_id) == $laboratorio->id ? 'selected' : '' }}>
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
                    {{ old('unidad_id', $residuoLaboratorio?->unidad_id) == $unidad->id ? 'selected' : '' }}>
                    {{ $unidad->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
