@extends('layouts.index_layout')

@section('title', 'Usuarios')

@section('heading', 'Inventario de usuarios')

@section('filter_content')
    <form method="GET" action="{{ route('users.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="col-md-3 text-center">
                    <p>Nombre</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="col-md-3 text-center">
                    <p>Correo electrónico</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="col-md-1 text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="col-md-1 text-center">
                    <p>Roles</p>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-people fs-5"></i></a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Nombre</th>
    <th>Correo electrónico</th>
    <th>Roles</th>
@endsection

@section('table_content')
    @if ($users->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay usuarios creados.</td>
        </tr>
    @else
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->roles->isEmpty())
                        <span>No tiene roles</span>
                    @else
                        {{ $user->roles->pluck('name')->join(', ') }} <!-- Muestra los roles separados por comas -->
                    @endif
                </td>
                <td class="text-end">
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalUser({{ json_encode($user) }})" data-bs-toggle="modal"
                            data-bs-target="#userModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('users.edit', $user->id) }}">
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
        {!! $users->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="userModalLabel">Detalles del usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Nombre:</strong>
                    <span id="modalNombre"></span>
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Correo electrónico:</strong>
                    <span id="modalCorreo"></span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card border-0">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <br>
                        <h1 class="text-center">Usuarios</h1>
                        <br>

                        <form method="GET" action="{{ route('users.index') }}">
                            <div class="row mb-4">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div class="col-md-4 text-center">
                                        <p>Nombre</p>
                                        <input type="text" name="name" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="---"
                                            value="{{ request()->get('name') }}">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p>Correo electrónico</p>
                                        <input type="text" name="email" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="---"
                                            value="{{ request()->get('email') }}">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <p>Filtrar</p>
                                        <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                                                class="bi bi-sort-down-alt fs-5"></i></button>
                                    </div>
                                    <div class="col-md-1 text center">
                                        <p>Agregar</p>
                                        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                                            data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body border-0 rounded-4 bg-white">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo electrónico</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        <a class="btn btn-md "
                                                            href="{{ route('users.show', $user->id) }}"><i
                                                                class="bi bi-search text-primary fs-5"></i></a>
                                                        <a class="btn btn-md"
                                                            href="{{ route('users.edit', $user->id) }}"><i
                                                                class="bi bi-pencil text-pop fs-5"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-md"
                                                            onclick="event.preventDefault(); confirm('¿Estás seguro de eliminarlo?') ? this.closest('form').submit() : false;"><i
                                                                class="bi bi-trash text-danger fs-5"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $users->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection --}}

<script>
    function mostrarModalUser(user) {
        document.getElementById('modalNombre').textContent = user.name;
        document.getElementById('modalCorreo').textContent = user.email;
        var userModal = new bootstrap.Modal(document.getElementById('userModal'));
        document.getElementById('userModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        userModal.show();
    }
</script>
