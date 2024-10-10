<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $role?->name) }}" id="name" placeholder="Name">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Lista de permisos -->
        <div class="form-group mt-3">
            <label for="permissions">Lista de Permisos:</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <div>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            class="form-check-input"
                            {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : (old('permissions') && in_array($permission->name, old('permissions')) ? 'checked' : '') }}>
                        <label class="form-check-label">{{ $permission->description }}</label>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
