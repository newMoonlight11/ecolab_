@extends('layouts.index_layout')

@section('title', 'Roles')

@section('heading', 'Listado de roles')

@section('filter_content')
    <form method="GET" action="{{ route('roles.index') }}">
        <div class="row mb-4">
            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <div>
                    <p>Agregar</p>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary rounded-3 btn-xxl"
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
    @if ($roles->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay roles disponibles.</td>
        </tr>
    @else
        @foreach ($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td class="text-end">
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)" onclick="mostrarModalRole({{ json_encode($role) }})"
                            data-bs-toggle="modal" data-bs-target="#roleModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('roles.edit', $role->id) }}">
                            <i class="bi bi-pencil text-pop fs-5"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminarlo?') ? this.closest('form').submit() : false;">
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
        {!! $roles->appends(request()->except('page'))->links('vendor.pagination.custom') !!}
    </div>
@endsection

<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="roleModalLabel">Detalles del Rol</h5>
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
    function mostrarModalRole(role) {
        document.getElementById('modalNombre').textContent = role.name;
        var roleModal = new bootstrap.Modal(document.getElementById('roleModal'));
        document.getElementById('roleModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        roleModal.show();
    }
</script>
