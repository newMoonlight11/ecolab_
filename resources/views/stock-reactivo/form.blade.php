<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_stock" class="form-label">{{ __('Fecha Stock') }}</label>
            <input type="text" name="fecha_stock" class="form-control @error('fecha_stock') is-invalid @enderror" value="{{ old('fecha_stock', $stockReactivo?->fecha_stock) }}" id="fecha_stock" placeholder="Fecha Stock">
            {!! $errors->first('fecha_stock', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad_existencia" class="form-label">{{ __('Cantidad Existencia') }}</label>
            <input type="text" name="cantidad_existencia" class="form-control @error('cantidad_existencia') is-invalid @enderror" value="{{ old('cantidad_existencia', $stockReactivo?->cantidad_existencia) }}" id="cantidad_existencia" placeholder="Cantidad Existencia">
            {!! $errors->first('cantidad_existencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="reactivo_id" class="form-label">{{ __('Reactivo Id') }}</label>
            <input type="text" name="reactivo_id" class="form-control @error('reactivo_id') is-invalid @enderror" value="{{ old('reactivo_id', $stockReactivo?->reactivo_id) }}" id="reactivo_id" placeholder="Reactivo Id">
            {!! $errors->first('reactivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="laboratorio_id" class="form-label">{{ __('Laboratorio Id') }}</label>
            <input type="text" name="laboratorio_id" class="form-control @error('laboratorio_id') is-invalid @enderror" value="{{ old('laboratorio_id', $stockReactivo?->laboratorio_id) }}" id="laboratorio_id" placeholder="Laboratorio Id">
            {!! $errors->first('laboratorio_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_id" class="form-label">{{ __('Unidad Id') }}</label>
            <input type="text" name="unidad_id" class="form-control @error('unidad_id') is-invalid @enderror" value="{{ old('unidad_id', $stockReactivo?->unidad_id) }}" id="unidad_id" placeholder="Unidad Id">
            {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>