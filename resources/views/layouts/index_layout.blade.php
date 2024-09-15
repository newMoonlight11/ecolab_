@extends('layouts.app')

@section('template_title')
    @yield('title', 'CRUD')
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
                        <h1 class="text-center">@yield('heading')</h1>
                        <br>
                        <!-- Filtros -->
                        <form method="GET" action="@yield('back_route')">
                            <div class="row mb-4">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    @yield('filters')
                                    <div class="col-md-1 text-center">
                                        <p>Filtrar</p>
                                        <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                                                class="bi bi-sort-down-alt fs-5"></i></button>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <p>Agregar</p>
                                        <a href="@yield('create_route')" class="btn btn-primary rounded-3 btn-xxl"
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
                                            @yield('table_header')
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="col-md-1">{{ ++$loop->index }}</td>
                                                @yield('table_content', $item)
                                                <td class="col-sm-1">
                                                    <form action="@yield('destroy_route', $item->id)"
                                                        method="POST" class="d-inline">
                                                        <a class="btn btn-sm"
                                                            href="@yield('show_route', $item->id)">
                                                            <i class="bi bi-search text-primary fs-5"></i>
                                                        </a>
                                                        <a class="btn btn-sm"
                                                            href="@yield('edit_route', $item->id)">
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
                @yield('pagination')
            </div>
        </div>
    </div>
@endsection
