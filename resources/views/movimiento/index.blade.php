@extends('layouts.index_layout')

@section('title', 'Movimientos')

@section('heading', 'Inventario de Movimientos')

@section('filter_content')
    <form method="GET" action="{{ route('movimientos.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center">
                    <p>Tipo</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('tipo_movimiento') }}">
                </div>
                <div class="text-center">
                    <p>Fecha</p>
                    <input type="date" name="fecha_movimiento" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('fecha') }}">
                </div>
                <div class="text-center">
                    <p>Usuario</p>
                    <input type="text" name="username" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('name') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('movimientos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th >Fecha</th>
	<th >Descripcion</th>
	<th >Tipo</th>
    <th >Usuario</th>
@endsection

@section('table_content')
    @if ($movimientos->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay movimientos disponibles.</td>
        </tr>
    @else
        @foreach ($movimientos as $movimiento)
            <tr>
                <td class="col-sm-1">{{ ++$i }}</td>
                <td>{{ $movimiento->fecha_movimiento }}</td>
                <td>{{ Str::limit($movimiento->descripcion, 50) }}</td>
                <td>{{ $movimiento->tipoMovimiento ? $movimiento->tipoMovimiento->nombre : 'Sin tipo de movimiento' }}</td>
                <td>{{ $movimiento->user ? $movimiento->user->name: 'Sin usuario'}}</td>
                <td class="text-end">
                    <form action="{{ route('movimientos.destroy', $movimiento->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalMovimiento({{ json_encode($movimiento) }})" data-bs-toggle="modal"
                            data-bs-target="#movimientoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('movimientos.edit', $movimiento->id) }}">
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
        {!! $movimientos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="movimientoModal" tabindex="-1" aria-labelledby="movimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="movimientoModalLabel">Detalles del
                    movimiento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-x-auto">
                <div class="form-group mb-2 mb20">
                    <strong>Fecha:</strong>
                    <span id="modalFecha"></span>
                    <br>
                    <strong>Descripción:</strong>
                    <span id="modalDescripcion" style="white-space: pre-wrap;"></span>
                    <br>
                    <strong>Tipo de movimiento:</strong>
                    <span id="modalTipoMovimiento"></span>
                    <br>
                    <strong>Usuario:</strong>
                    <span id="modalUsuario"></span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function mostrarModalMovimiento(movimiento) {
        document.getElementById('modalFecha').textContent = movimiento.fecha_movimiento;
        document.getElementById('modalDescripcion').textContent = movimiento.descripcion;
        document.getElementById('modalTipoMovimiento').textContent = movimiento.tipo_movimiento ? movimiento.tipo_movimiento.nombre : 'Sin tipo de movimiento';
        document.getElementById('modalUsuario').textContent = movimiento.user ? movimiento.user.name : 'Sin usuario';
        var movimientoModal = new bootstrap.Modal(document.getElementById('movimientoModal'));
        document.getElementById('movimientoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        movimientoModal.show();
    }
</script>