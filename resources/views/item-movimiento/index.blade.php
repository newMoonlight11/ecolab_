@extends('layouts.index_layout')

@section('title', 'Item Movimientos')

@section('heading', 'Inventario de Item Movimientos')

@section('filter_content')
    <form method="GET" action="{{ route('item_movimiento.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="col-md-3 text-center">
                    <p>Cantidad</p>
                    <input type="text" name="cantidad" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('cantidad') }}">
                </div>
                <div class="col-md-1 text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="col-md-1 text-center">
                    <p>Agregar</p>
                    <a href="{{ route('item_movimiento.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th >Cantidad</th>
    <th >Reactivo Id</th>
	<th >Movimiento Id</th>
@endsection

@section('table_content')
    @if ($itemMovimientos->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay item movimientos disponibles.</td>
        </tr>
    @else
        @foreach ($itemMovimientos as $itemMovimiento)
            <tr>
                <td>{{ ++$i }}</td>
                <td >{{ $itemMovimiento->cantidad }}</td>
				<td >{{ $itemMovimiento->reactivo_id }}</td>
				<td >{{ $itemMovimiento->movimiento_id }}</td>
                <td class="text-end">
                    <form action="{{ route('item_movimiento.destroy', $itemMovimiento->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalItemMovimiento({{ json_encode($itemMovimiento->id) }})" data-bs-toggle="modal"
                            data-bs-target="#itemMovimientoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('item_movimiento.edit', $itemMovimiento->id) }}">
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
        {!! $itemMovimientos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="itemMovimientoModal" tabindex="-1" aria-labelledby="itemMovimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="itemMovimientoModalLabel">Detalles de la item movimiento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Cantidad:</strong>
                    <span id="modalCantidad"></span>
                    <br>
                    <strong>Reactivo:</strong>
                    <span id="modalReactivo"></span>
                    <br>
                    <strong>Movimiento:</strong>
                    <span id="modalMovimiento"></span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function mostrarModalItemMovimiento(item_movimiento) {
        document.getElementById('modalCantidad').textContent = item_movimiento.cantidad;
        document.getElementById('modalReactivo').textContent = item_movimiento.reactivo ?item_movimiento.reactivo.nombre : 'Sin reactivo';
        document.getElementById('modalMovimiento').textContent = item_movimiento.movimiento ? item_movimiento.movimiento.nombre : 'Sin movimiento';
        var itemMovimientoModal = new bootstrap.Modal(document.getElementById('itemMovimientoModal'));
        document.getElementById('itemMovimientoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        itemMovimientoModal.show();
    }
</script>
