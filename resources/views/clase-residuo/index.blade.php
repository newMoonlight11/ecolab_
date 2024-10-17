@extends('layouts.index_layout')

@section('title', 'Clases de residuos')

@section('heading', 'Clases de residuos')

@section('filter_content')
    <form method="GET" action="{{ route('clase-residuos.index') }}">
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
                    <a href="{{ route('clase-residuos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
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
    @if ($claseResiduos->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay clases disponibles.</td>
        </tr>
    @else
        @foreach ($claseResiduos as $claseResiduo)
            <tr>
                <td>{{ ++$i }}</td>

                <td>{{ $claseResiduo->nombre }}</td>

                <td>
                    <form action="{{ route('clase-residuos.destroy', $claseResiduo->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalClaseResiduo({{ json_encode($claseResiduo) }})" data-bs-toggle="modal"
                            data-bs-target="#claseResiduoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('clase-residuos.edit', $claseResiduo->id) }}">
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
        {!! $claseResiduos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<script>
    function mostrarModalClaseResiduo(claseResiduo) {
        document.getElementById('modalNombre').textContent = claseResiduo.nombre;
        var claseResiduoModal = new bootstrap.Modal(document.getElementById('claseResiduoModal'));
        document.getElementById('claseResiduoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        claseResiduoModal.show();
    }
</script>