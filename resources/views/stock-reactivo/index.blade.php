@extends('layouts.index_layout')

@section('title', 'Stock de reactivos')

@section('heading', 'Stock de reactivos')

@section('filter_content')
    <form method="GET" action="{{ route('stock_reactivos.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center">
                    <p>Fecha de stock</p>
                    <input type="date" name="fecha_stock" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('fecha_stock') }}">
                </div>
                <div class="text-center">
                    <p>Cantidad en existencia</p>
                    <input type="text" name="cantidad_existencia" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('cantidad_existencia') }}">
                </div>
                <div class="text-center">
                    <p>Reactivo</p>
                    <input type="text" name="reactivo_id" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('reactivo_id') }}">
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
                    <a href="{{ route('stock_reactivos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center">
                        <i class="bi bi-plus-circle fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Reactivo</th>
    <th>Laboratorio</th>
    <th>Unidad</th>
    <th>Cantidad en stock</th>
    <th>Última actualización</th>
@endsection

@section('table_content')
    @if ($reactivosPaginated->isEmpty())
        <tr>
            <td colspan="6" class="text-center">No hay stock de reactivos disponible.</td>
        </tr>
    @else
        @foreach ($reactivosPaginated as $stock)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stock->reactivo->nombre ?? 'Sin reactivo' }}</td>
                <td>{{ $stock->laboratorio->nombre ?? 'Sin laboratorio' }}</td>
                <td>{{ $stock->unidad->nombre ?? 'Sin unidad' }}</td>
                <td>{{ $stock->cantidad_existencia }}</td>
                <td>{{ \Carbon\Carbon::parse($stock->fecha_stock)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    @endif
@endsection

@section('pagination')
    <div class="d-flex justify-content-center">
        {!! $reactivosPaginated->appends(request()->except('page'))->links('vendor.pagination.custom') !!}
    </div>
@endsection

<div class="modal fade" id="stockReactivoModal" tabindex="-1" aria-labelledby="stockReactivoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="stockReactivoModalLabel">Detalles del
                    stock
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Fecha de stock:</strong>
                    <span id="modalFechaStock"></span>
                    <br>
                    <strong>Cantidad en existencia: </strong>
                    <span id="modalCantidadExistencia"></span>
                    <br>
                    <strong>Reactivo:</strong>
                    <span id="modalReactivo"></span>
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
    function mostrarModalStockReactivo(stockReactivo) {
        document.getElementById('modalFechaStock').textContent = stockReactivo.fecha_stock;
        document.getElementById('modalCantidadExistencia').textContent = stockReactivo.cantidad_existencia;
        document.getElementById('modalReactivo').textContent = stockReactivo.reactivo_id ? stockReactivo.reactivo
            .nombre : 'Sin reactivo';
        document.getElementById('modalLaboratorio').textContent = stockReactivo.laboratorio_id ? stockReactivo
            .laboratorio.nombre : 'Sin laboratorio';
        document.getElementById('modalUnidad').textContent = stockReactivo.unidad_id ? stockReactivo.unidad.nombre :
            'Sin unidad';

        var stockReactivoModal = new bootstrap.Modal(document.getElementById('stockReactivoModal'));
        document.getElementById('stockReactivoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        stockReactivoModal.show();
    }
</script>
