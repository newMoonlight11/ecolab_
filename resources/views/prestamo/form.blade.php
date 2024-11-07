@extends('layouts.form')

@section('form_content')
<div class="container py-5">
    <!-- Alert de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('prestamos.store') }}" method="POST" id="prestamoForm">
        @csrf
        <div class="form-group mb-2 mb20">
            <label for="reactivo_id" class="form-label">{{ __('Reactivo') }}</label>
            <select name="reactivo_id" id="reactivo_id"
                class="form-control bg-white rounded-4 @error('reactivo_id') is-invalid @enderror">
                <option value="">{{ 'Seleccione un reactivo' }}</option>
                @foreach ($reactivos as $reactivo)
                    <option value="{{ $reactivo->id }}"
                        {{ old('reactivo_id', $prestamo?->reactivo_id) == $reactivo->id ? 'selected' : '' }}>
                        {{ $reactivo->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('reactivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_id" class="form-label">{{ __('Unidad') }}</label>
            <select name="unidad_id" id="unidad_id"
                class="form-control bg-white rounded-4 @error('unidad_id') is-invalid @enderror">
                <option value="">{{ 'Seleccione la unidad' }}</option>
                @foreach ($unidads as $unidad)
                    <option value="{{ $unidad->id }}"
                        {{ old('unidad_id', $prestamo?->unidad_id) == $unidad->id ? 'selected' : '' }}>
                        {{ $unidad->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="laboratorio_id" class="form-label">{{ __('Laboratorio') }}</label>
            <select name="laboratorio_id" id="laboratorio_id"
                class="form-control bg-white rounded-4 @error('laboratorio_id') is-invalid @enderror">
                <option value="">{{ 'Seleccione un laboratorio' }}</option>
                @foreach ($laboratorios as $laboratorio)
                    <option value="{{ $laboratorio->id }}"
                        {{ old('laboratorio_id', $prestamo?->laboratorio_id) == $laboratorio->id ? 'selected' : '' }}>
                        {{ $laboratorio->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first(
                'laboratorio_id',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <!-- Campos adicionales -->
        <div class="form-group mb-2">
            <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
            <input type="number" name="cantidad" class="form-control bg-white rounded-4 @error('cantidad') is-invalid @enderror"
                   id="cantidad" placeholder="Cantidad" value="{{ old('cantidad', $prestamo?->cantidad) }}">
            {!! $errors->first('cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fecha" class="form-control bg-white rounded-4 @error('fecha') is-invalid @enderror"
                   id="fecha" placeholder="Fecha" value="{{ old('fecha',$prestamo?->fecha) }}">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control bg-white rounded-4 @error('email') is-invalid @enderror"
                   id="email" placeholder="Email" value="{{ old('email',$prestamo?->email) }}">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <!-- Botón de enviar -->
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary rounded-4">SOLICITAR</button>
        </div>
    </form>
</div>
<script>
    if (document.querySelector('.alert-success')) {
        document.getElementById('prestamoForm').reset();
    }
</script>
@endsection

{{-- @push('scripts')

@endpush --}}

