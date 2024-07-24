<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control bg-white rounded-4 @error('nombre') is-invalid @enderror"
                value="{{ old('nombre', $reactivo?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_vencimiento" class="form-label">{{ __('Fecha Vencimiento') }}</label>
            <input type="date" name="fecha_vencimiento"
                class="form-control bg-white rounded-4 @error('fecha_vencimiento') is-invalid @enderror"
                value="{{ old('fecha_vencimiento', $reactivo?->fecha_vencimiento) }}" id="fecha_vencimiento"
                placeholder="Fecha Vencimiento">
            {!! $errors->first(
                'fecha_vencimiento',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
            <input type="text" name="cantidad" class="form-control bg-white rounded-4 @error('cantidad') is-invalid @enderror"
                value="{{ old('cantidad', $reactivo?->cantidad) }}" id="cantidad" placeholder="Cantidad">
            {!! $errors->first('cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="laboratorio" class="form-label">{{ __('Laboratorio') }}</label>
            <input type="text" name="laboratorio" class="form-control bg-white rounded-4 @error('laboratorio') is-invalid @enderror"
                value="{{ old('laboratorio', $reactivo?->laboratorio) }}" id="laboratorio" placeholder="Laboratorio">
            {!! $errors->first('laboratorio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="familia" class="form-label">{{ __('Familia') }}</label>
            <input type="text" name="familia" class="form-control bg-white rounded-4 @error('familia') is-invalid @enderror"
                value="{{ old('familia', $reactivo?->familia) }}" id="familia" placeholder="Familia">
            {!! $errors->first('familia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary rounded-4">{{ __('GUARDAR') }}</button>
        </div>
    </div>
</div>
