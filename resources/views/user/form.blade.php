@extends('layouts.form')
@section('form_content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-group mb-2 mb20">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
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
            <div class="form-group mb-2 mb20">
                <label for="roles" class="form-label">{{ __('Roles') }}</label>
                <div id="roles">
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                   class="form-check-input @error('roles') is-invalid @enderror"
                                   id="role-{{ $role->id }}"
                                   {{ in_array($role->id, old('roles', $user?->roles->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                    {!! $errors->first('roles', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>
    </div>
@section('button_type', 'submit')
