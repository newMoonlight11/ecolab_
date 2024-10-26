@extends('layouts.index_layout')

@section('title', 'Familias')

@section('heading', 'Familias de reactivos')

@section('filter_content')
    <form method="GET" action="{{ route('familias.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="col-4 text-center">
                    <p>Nombre</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('familias.create') }}" class="btn btn-primary rounded-3 btn-xxl"
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
    @if ($familias->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay familias disponibles.</td>
        </tr>
    @else
        @foreach ($familias as $familia)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $familia->nombre }}</td>
                <td class="text-end">
                    <form action="{{ route('familias.destroy', $familia->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalFamilia({{ json_encode($familia) }})" data-bs-toggle="modal"
                            data-bs-target="#familiaModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('familias.edit', $familia->id) }}">
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
        {!! $familias->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="familiaModal" tabindex="-1" aria-labelledby="familiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="familiaModalLabel">Detalles de la familia
                </h5>
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
    function mostrarModalFamilia(familia) {
        document.getElementById('modalNombre').textContent = familia.nombre;
        var familiaModal = new bootstrap.Modal(document.getElementById('familiaModal'));
        document.getElementById('familiaModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        familiaModal.show();
    }
</script>
