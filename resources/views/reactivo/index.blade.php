<link rel="stylesheet" href="css/inventario.css">
@extends('layouts.app')

@section('template_title')
    Reactivos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 id="card_title" class="mb-0">
                                {{ __('Inventario') }}
                            </h3>
                            <div class="float-right">
                                <a href="{{ route('reactivos.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                                    {{ __('Agregar') }}
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
                        <!-- Filtros -->
                        <form method="GET" action="{{ route('reactivos.index') }}">
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ request()->get('nombre') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="fecha_vencimiento" class="form-control" placeholder="Fecha de vencimiento" value="{{ request()->get('fecha_vencimiento') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ request()->get('cantidad') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="laboratorio" class="form-control" placeholder="Laboratorio" value="{{ request()->get('laboratorio') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="familia" class="form-control" placeholder="Familia" value="{{ request()->get('familia') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>
                        <!-- Fin de filtros -->

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Fecha de vencimiento</th>
                                        <th>Cantidad</th>
                                        <th>Laboratorio</th>
                                        <th>Familia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reactivos as $reactivo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $reactivo->nombre }}</td>
                                            <td>{{ $reactivo->fecha_vencimiento }}</td>
                                            <td>{{ $reactivo->cantidad }}</td>
                                            <td>{{ $reactivo->laboratorio }}</td>
                                            <td>{{ $reactivo->familia }}</td>
                                            <td>
                                                <form action="{{ route('reactivos.destroy', $reactivo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('reactivos.show', $reactivo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reactivos.edit', $reactivo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $reactivos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
