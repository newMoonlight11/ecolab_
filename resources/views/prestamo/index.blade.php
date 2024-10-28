{{-- @extends('layouts.app')

@section('template_title')
    Prestamos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Prestamos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('prestamos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Reactivo Id</th>
									<th >Unidad Id</th>
									<th >Laboratorio Id</th>
									<th >Cantidad</th>
									<th >Fecha</th>
									<th >Email</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $prestamo->reactivo_id }}</td>
										<td >{{ $prestamo->unidad_id }}</td>
										<td >{{ $prestamo->laboratorio_id }}</td>
										<td >{{ $prestamo->cantidad }}</td>
										<td >{{ $prestamo->fecha }}</td>
										<td >{{ $prestamo->email }}</td>

                                            <td>
                                                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('prestamos.show', $prestamo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('prestamos.edit', $prestamo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prestamos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.index_layout')

@section('title', 'Préstamos')

@section('heading', 'Préstamos')

@section('filter_content')
    <form method="GET" action="{{ route('prestamos.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center">
                    <p>Fecha</p>
                    <input type="date" name="fecha" class="form-control bg-white rounded-4"
                        style="text-align: center;" value="{{ request()->get('fecha') }}">
                </div>
                <div class="text-center">
                    <p>Cantidad</p>
                    <input type="number" name="cantidad" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="Cantidad" value="{{ request()->get('cantidad') }}">
                </div>
                <div class="text-center">
                    <p>Reactivo</p>
                    <input type="text" name="reactivo_id" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="Reactivo" value="{{ request()->get('reactivo_id') }}">
                </div>
                <div class="text-center">
                    <p>Laboratorio</p>
                    <input type="text" name="laboratorio_id" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="Laboratorio" value="{{ request()->get('laboratorio_id') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl">
                        <i class="bi bi-sort-down-alt fs-5"></i>
                    </button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('prestamos.create') }}" class="btn btn-primary rounded-3 btn-xxl">
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
    <th>Unidad</th>
    <th>Laboratorio</th>
    <th>Cantidad</th>
    <th>Fecha</th>
    <th>Email</th>
@endsection

@section('table_content')
    @if ($prestamos->isEmpty())
        <tr>
            <td colspan="7" class="text-center">No hay préstamos disponibles</td>
        </tr>
    @else
        @foreach ($prestamos as $prestamo)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $prestamo->reactivo_id ? $prestamo->reactivo->nombre : 'Sin reactivo' }}</td>
                <td>{{ $prestamo->unidad_id ? $prestamo->unidad->nombre : 'Sin unidad' }}</td>
                <td>{{ $prestamo->laboratorio_id ? $prestamo->laboratorio->nombre : 'Sin laboratorio' }}</td>
                <td>{{ $prestamo->cantidad }}</td>
                <td>{{ $prestamo->fecha }}</td>
                <td>{{ $prestamo->email }}</td>

                <td class="text-end">
                    <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalPrestamo({{ json_encode($prestamo) }})"
                            data-bs-toggle="modal" data-bs-target="#prestamoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('prestamos.edit', $prestamo->id) }}">
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
        {!! $prestamos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<!-- Modal para mostrar detalles de préstamo -->
<div class="modal fade" id="prestamoModal" tabindex="-1" aria-labelledby="prestamoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="prestamoModalLabel">Detalles del préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <strong>Reactivo:</strong>
                    <span id="modalReactivo"></span><br>
                    <strong>Unidad:</strong>
                    <span id="modalUnidad"></span><br>
                    <strong>Laboratorio:</strong>
                    <span id="modalLaboratorio"></span><br>
                    <strong>Cantidad:</strong>
                    <span id="modalCantidad"></span><br>
                    <strong>Fecha:</strong>
                    <span id="modalFecha"></span><br>
                    <strong>Email:</strong>
                    <span id="modalEmail"></span><br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarModalPrestamo(prestamo) {
        document.getElementById('modalReactivo').textContent = prestamo.reactivo_id ? prestamo.reactivo.nombre : 'Sin reactivo';
        document.getElementById('modalUnidad').textContent = prestamo.unidad_id ? prestamo.unidad.nombre : 'Sin unidad';
        document.getElementById('modalLaboratorio').textContent = prestamo.laboratorio_id ? prestamo.laboratorio.nombre : 'Sin laboratorio';
        document.getElementById('modalCantidad').textContent = prestamo.cantidad;
        document.getElementById('modalFecha').textContent = prestamo.fecha;
        document.getElementById('modalEmail').textContent = prestamo.email;

        var prestamoModal = new bootstrap.Modal(document.getElementById('prestamoModal'));
        document.getElementById('prestamoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        prestamoModal.show();
    }
</script>
