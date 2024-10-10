<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
            <input type="text" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad', $itemMovimiento?->cantidad) }}" id="cantidad" placeholder="Cantidad">
            {!! $errors->first('cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="reactivo_id" class="form-label">{{ __('Reactivo Id') }}</label>
            <input type="text" name="reactivo_id" class="form-control @error('reactivo_id') is-invalid @enderror" value="{{ old('reactivo_id', $itemMovimiento?->reactivo_id) }}" id="reactivo_id" placeholder="Reactivo Id">
            {!! $errors->first('reactivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="movimiento_id" class="form-label">{{ __('Movimiento Id') }}</label>
            <input type="text" name="movimiento_id" class="form-control @error('movimiento_id') is-invalid @enderror" value="{{ old('movimiento_id', $itemMovimiento?->movimiento_id) }}" id="movimiento_id" placeholder="Movimiento Id">
            {!! $errors->first('movimiento_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>