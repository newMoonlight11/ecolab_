@extends('layouts.app')

@section('template_title')
    Users
@endsection

@section('content')
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

                                            <th></th>
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
@endsection
