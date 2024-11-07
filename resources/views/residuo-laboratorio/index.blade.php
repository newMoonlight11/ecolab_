@extends('layouts.index_layout')

@section('title', 'Stock de residuos')

@section('heading', 'Stock de residuos')

@section('filter_content')
    <form method="GET" action="{{ route('residuo-laboratorios.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center col-1">
                    <p>Fecha de stock</p>
                    <input type="date" name="fecha_stock" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('fecha_stock') }}">
                </div>
                <div class="text-center">
                    <p>Cantidad en stock</p>
                    <input type="number" name="cantidad_existencia" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('cantidad_existencia') }}">
                </div>
                <div class="text-center">
                    <p>Residuo</p>
                    <input type="text" name="residuo_id" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('residuo_id') }}">
                </div>
                <div class="text-center">
                    <p>Laboratorio</p>
                    <input type="text" name="laboratorio_id" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('laboratorio_id') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('residuo-laboratorios.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Fecha de stock</th>
    <th>Cantidad en stock</th>
    <th>Residuo</th>
    <th>Laboratorio</th>
    <th>Unidad</th>
@endsection


@section('table_content')
    @if ($residuoLaboratorios->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay stock de residuos</td>
        </tr>
    @else
        @foreach ($residuoLaboratorios as $residuoLaboratorio)
            <tr>
                <td class="col-sm-1">{{ ++$i }}</td>
                <td>{{ $residuoLaboratorio->fecha_stock }}</td>
                <td>{{ $residuoLaboratorio->cantidad_existencia }}</td>
                <td>{{ $residuoLaboratorio->residuo_id ? $residuoLaboratorio->residuo->nombre : 'Sin residuo' }}</td>
                <td>{{ $residuoLaboratorio->laboratorio_id ? $residuoLaboratorio->laboratorio->nombre : 'Sin laboratorio' }}
                </td>
                <td>{{ $residuoLaboratorio->unidad_id ? $residuoLaboratorio->unidad->nombre : 'Sin unidad' }}</td>

                <td class="text-end">
                    <form action="{{ route('residuo-laboratorios.destroy', $residuoLaboratorio->id) }}" method="POST"
                        class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalResiduoLaboratorio({{ json_encode($residuoLaboratorio) }})"
                            data-bs-toggle="modal" data-bs-target="#residuoLaboratorioModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('residuo-laboratorios.edit', $residuoLaboratorio->id) }}">
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
        {!! $residuoLaboratorios->appends(request()->except('page'))->links('vendor.pagination.custom') !!}
    </div>
@endsection

<div class="modal fade" id="residuoLaboratorioModal" tabindex="-1" aria-labelledby="residuoLaboratorioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="residuoLaboratorioModalLabel">Detalles del
                    stock
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Fecha de stock:</strong>
                    <span id="modalFechaDeStock"></span>
                    <br>
                    <strong>Cantidad en stock: </strong>
                    <span id="modalCantidadEnStock"></span>
                    <br>
                    <strong>Residuo:</strong>
                    <span id="modalResiduo"></span>
                    <br>
                    <strong>Laboratorio:</strong>
                    <span id="modalLaboratorio"></span>
                    <br>
                    <strong>Unidad:</strong>
                    <span id="modalUnidad"></span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarModalResiduoLaboratorio(residuoLaboratorio) {
        document.getElementById('modalFechaDeStock').textContent = residuoLaboratorio.fecha_stock;
        document.getElementById('modalCantidadEnStock').textContent = residuoLaboratorio.cantidad_existencia;
        document.getElementById('modalResiduo').textContent = residuoLaboratorio.residuo_id ? residuoLaboratorio.residuo.nombre :'Sin residuo';
        document.getElementById('modalLaboratorio').textContent = residuoLaboratorio.laboratorio_id ? residuoLaboratorio.laboratorio.nombre : 'Sin laboratorio';
        document.getElementById('modalUnidad').textContent = residuoLaboratorio.unidad_id ? residuoLaboratorio.unidad.nombre : 'Sin unidad';
        var residuoLaboratorioModal = new bootstrap.Modal(document.getElementById('residuoLaboratorioModal'));
        document.getElementById('residuoLaboratorioModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        reactivoModal.show();
    }
</script>
