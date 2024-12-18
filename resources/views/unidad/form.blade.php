@extends('layouts.form')
@section('form_content')
    <div class="form-group mb-2 mb20">
        <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
        <input type="text" name="nombre" class="form-control bg-white rounded-4 @error('nombre') is-invalid @enderror"
            value="{{ old('nombre', $unidad?->nombre) }}" id="nombre" placeholder="Nombre">
        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
    </div>
@section('button_type', 'submit')
