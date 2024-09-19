@extends('layouts.form')
@section('form_content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-group mb-2 mb20">
                <label for="email" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name"
                    class="form-control bg-white rounded-4 @error('name') is-invalid @enderror"
                    value="{{ old('name', $user?->name) }}" id="name" placeholder="Nombre">
                {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group mb-2 mb20">
                <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                <input type="text" name="email"
                    class="form-control bg-white rounded-4 @error('email') is-invalid @enderror"
                    value="{{ old('email', $user?->email) }}" id="email" placeholder="Correo electrónico">
                {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
    </div>
@section('button_type', 'submit')
