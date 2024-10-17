<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $residuo?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="clase_residuo_id" class="form-label">{{ __('Clase Residuo Id') }}</label>
            <input type="text" name="clase_residuo_id" class="form-control @error('clase_residuo_id') is-invalid @enderror" value="{{ old('clase_residuo_id', $residuo?->clase_residuo_id) }}" id="clase_residuo_id" placeholder="Clase Residuo Id">
            {!! $errors->first('clase_residuo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>