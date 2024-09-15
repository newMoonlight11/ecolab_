<link rel="stylesheet" href="css/inventario.css">
@extends('layouts.app')

@section('template_title')
    Reactivos
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
                        <h1 class="text-center">Inventario reactivos</h1>
                        <br>
                        <!-- Filtros -->
                        <form method="GET" action="{{ route('reactivos.index') }}">
                            <div class="row mb-4">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div class="col-md-2 text-center">
                                        <p>Nombre</p>
                                        <input type="text" name="nombre" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="---"
                                            value="{{ request()->get('nombre') }}">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p>Fecha de vencimiento</p>
                                        <input type="date" name="fecha_vencimiento"
                                            class="form-control bg-white rounded-4" style="text-align: center;"
                                            placeholder="Fecha de vencimiento"
                                            value="{{ request()->get('fecha_vencimiento') }}">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <p>Cantidad</p>
                                        <input type="number" name="cantidad" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="ml/gr"
                                            value="{{ request()->get('cantidad') }}">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p>Laboratorio</p>
                                        <input type="text" name="laboratorio" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="---"
                                            value="{{ request()->get('laboratorio') }}">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p>Familia</p>
                                        <input type="text" name="familia" class="form-control bg-white rounded-4"
                                            style="text-align: center;" placeholder="---"
                                            value="{{ request()->get('familia') }}">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <p>Filtrar</p>
                                        <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                                                class="bi bi-sort-down-alt fs-5"></i></button>
                                    </div>
                                    <div class="col-md-1 text center">
                                        <p>Agregar</p>
                                        <a href="{{ route('reactivos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                                            data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="card border-0 rounded-4 bg-white">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">#</th>
                                            <th>Nombre</th>
                                            <th>Fecha de vencimiento</th>
                                            <th class="col-md-1">Cantidad</th>
                                            <th class="col-md-1">Laboratorio</th>
                                            <th>Familia</th>
                                            <th class="col-sm-1">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reactivos as $reactivo)
                                            <tr>
                                                <td class="col-md-1">{{ ++$i }}</td>
                                                <td>{{ $reactivo->nombre }}</td>
                                                <td>{{ $reactivo->fecha_vencimiento }}</td>
                                                <td class="col-md-1">{{ $reactivo->cantidad }}</td>
                                                <td class="col-md-1">{{ $reactivo->laboratorio }}</td>
                                                <td>{{ $reactivo->familia }}</td>
                                                <td class="col-sm-1">
                                                    <form action="{{ route('reactivos.destroy', $reactivo->id) }}"
                                                        method="POST" class="d-inline">
                                                        <a class="btn btn-sm"
                                                            href="{{ route('reactivos.show', $reactivo->id) }}">
                                                            <i class="bi bi-search text-primary fs-5"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                                            data-bs-target="#termsModal"><i
                                                                class="bi bi-search text-primary fs-5"></i></button>
                                                        <a class="btn btn-sm"
                                                            href="{{ route('reactivos.edit', $reactivo->id) }}">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                {!! $reactivos->appends(request()->except('page'))->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    @endsection
