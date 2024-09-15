@extends('layouts.app')

@section('template_title')
    Marcas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Marcas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('marcas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Nombre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $marca)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $marca->nombre }}</td>

                                            <td>
                                                <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('marcas.show', $marca->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('marcas.edit', $marca->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $marcas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection


{{-- @extends('layouts.index_layout')

@section('title', 'Marcas')

@section('heading', 'Inventario de Marcas')

@section('back_route', route('marcas.index'))

@section('create_route', route('marcas.create'))

@section('filters')
    <div class="col-md-2 text-center">
        <p>Nombre</p>
        <input type="text" name="nombre" class="form-control bg-white rounded-4"
            style="text-align: center;" placeholder="---" value="{{ request()->get('nombre') }}">
    </div>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Nombre</th>
@endsection

@section('table_content', function($item) {
    return "
        <td>{$item->nombre}</td>
    ";
})

@section('items', $marcas)

@section('destroy_route', route('marcas.destroy', $item->id))

@section('show_route', route('marcas.show', $item->id))

@section('edit_route', route('marcas.edit', $item->id))

@section('pagination')
    {!! $$marcas->appends(request()->except('page'))->links('pagination::bootstrap-4') !!}
@endsection --}}
