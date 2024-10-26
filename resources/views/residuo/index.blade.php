@extends('layouts.index_layout')

@section('title', 'Residuos')

@section('heading', 'Inventario de residuos')

@section('filter_content')
    <form method="GET" action="{{ route('residuos.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center col-3">
                    <p>Nombre</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="text-center col-3">
                    <p>Clase</p>
                    <input type="text" name="clase_residuo_id" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('clase_residuo_id') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('residuos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Nombre</th>
    <th>Clase del residuo</th>
@endsection

@section('table_content')
    @if ($residuos->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay residuos disponibles.</td>
        </tr>
    @else
        @foreach ($residuos as $residuo)
            <tr>
                <td class="col-sm-1">{{ ++$i }}</td>
                <td>{{ $residuo->nombre }}</td>
                <td>{{ $residuo->claseResiduo ? $residuo->claseResiduo->nombre : 'Sin clase' }}</td>

                <td class="text-end">
                    <form action="{{ route('residuos.destroy', $residuo->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalResiduo({{ json_encode($residuo) }})" data-bs-toggle="modal"
                            data-bs-target="#residuoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('residuos.edit', $residuo->id) }}">
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
        {!! $residuos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="residuoModal" tabindex="-1" aria-labelledby="residuoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="residuoModalLabel">Detalles del
                    residuo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Nombre:</strong>
                    <span id="modalNombre"></span>
                    <br>
                    <strong>Clase del residuo:</strong>
                    <span id="modalClase"></span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarModalResiduo(residuo) {
        document.getElementById('modalNombre').textContent = residuo.nombre;
        document.getElementById('modalClase').textContent = residuo.clase_residuo ? residuo.clase_residuo.nombre :
            'Sin clase';
        var residuoModal = new bootstrap.Modal(document.getElementById('residuoModal'));
        document.getElementById('residuoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        reactivoModal.show();
    }
</script>
