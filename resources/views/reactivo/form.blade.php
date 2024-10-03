@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
            value="{{ old('nombre', $reactivo?->nombre) }}" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    {{-- <div class="form-group mb-2 mb20">
        <label for="img_reactivo" class="form-label">{{ __('Img Reactivo') }}</label>
        <input type="text" name="img_reactivo" class="form-control @error('img_reactivo') is-invalid @enderror"
            value="{{ old('img_reactivo', $reactivo?->img_reactivo) }}" id="img_reactivo" placeholder="Img Reactivo">
        {!! $errors->first('img_reactivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div> --}}
    <div class="form-group mb-2 mb20">
        <label for="numero_cas" class="form-label">{{ __('Numero Cas') }}</label>
        <input type="text" name="numero_cas" class="form-control @error('numero_cas') is-invalid @enderror"
            value="{{ old('numero_cas', $reactivo?->numero_cas) }}" id="numero_cas" placeholder="Numero Cas">
        {!! $errors->first('numero_cas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="referencia_fabricante" class="form-label">{{ __('Referencia Fabricante') }}</label>
        <input type="text" name="referencia_fabricante"
            class="form-control @error('referencia_fabricante') is-invalid @enderror"
            value="{{ old('referencia_fabricante', $reactivo?->referencia_fabricante) }}" id="referencia_fabricante"
            placeholder="Referencia Fabricante">
        {!! $errors->first(
            'referencia_fabricante',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="lote" class="form-label">{{ __('Lote') }}</label>
        <input type="text" name="lote" class="form-control @error('lote') is-invalid @enderror"
            value="{{ old('lote', $reactivo?->lote) }}" id="lote" placeholder="Lote">
        {!! $errors->first('lote', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="num_registro_invima" class="form-label">{{ __('Num Registro Invima') }}</label>
        <input type="text" name="num_registro_invima"
            class="form-control @error('num_registro_invima') is-invalid @enderror"
            value="{{ old('num_registro_invima', $reactivo?->num_registro_invima) }}" id="num_registro_invima"
            placeholder="Num Registro Invima">
        {!! $errors->first(
            'num_registro_invima',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
    </div>
    <div class="form-group mb-2 mb20">
        <label for="familia_id" class="form-label">{{ 'Familia' }}</label>
        <select name="familia_id" id="familia_id" class="form-control @error('familia_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione una Familia' }}</option>
            @foreach ($familias as $familia)
                <option value="{{ $familia->id }}"
                    {{ old('familia_id', $reactivo?->familia_id) == $familia->id ? 'selected' : '' }}>
                    {{ $familia->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('familia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>

    <div class="form-group mb-2 mb20">
        <label for="marca_id" class="form-label">{{ 'Marca' }}</label>
        <select name="marca_id" id="marca_id" class="form-control @error('marca_id') is-invalid @enderror">
            <option value="">{{ 'Seleccione una Marca' }}</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}"
                    {{ old('marca_id', $reactivo?->marca_id) == $marca->id ? 'selected' : '' }}>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('marca_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')
