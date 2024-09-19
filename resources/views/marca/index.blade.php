@extends('layouts.index_layout')

@section('title', 'Marcas')

@section('heading', 'Inventario de Marcas')

@section('filter_content')
    <form method="GET" action="{{ route('marcas.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="col-md-3 text-center">
                    <p>Nombre</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="col-md-1 text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="col-md-1 text-center">
                    <p>Agregar</p>
                    <a href="{{ route('marcas.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Nombre</th>
@endsection

@section('table_content')
    @if ($marcas->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay marcas disponibles.</td>
        </tr>
    @else
        @foreach ($marcas as $marca)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $marca->nombre }}</td>
                <td class="text-end">
                    <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#marcaModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('marcas.edit', $marca->id) }}">
                            <i class="bi bi-pencil text-pop fs-5"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm"
                            onclick="event.preventDefault(); confirm('¿Estás seguro de eliminarlo?') ? this.closest('form').submit() : false;">
                            <i class="bi bi-trash text-danger fs-5"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
@endsection

@section('pagination')
    <div class="d-flex justify-content-center">
        {!! $marcas->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="marcaModalLabel">Detalles de la marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Nombre:</strong>
                    <span id="modalNombre"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function mostrarModalMarca(marca) {
        document.getElementById('modalNombre').textContent = marca.nombre;
        var reactivoModal = new bootstrap.Modal(document.getElementById('marcaModal'));
        marcaModal.show();
    }
</script>
