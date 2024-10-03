@extends('layouts.index_layout')

@section('title', 'Reactivos')

@section('heading', 'Inventario de reactivos')

@section('filter_content')
    <form method="GET" action="{{ route('reactivos.index') }}">
        <div class="row mb-4">
            <div class="d-flex justify-content-between flex-wrap gap-3">
                <div class="text-center">
                    <p>Nombre</p>
                    <input type="text" name="nombre" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('nombre') }}">
                </div>
                <div class="text-center">
                    <p># CAS</p>
                    <input type="text" name="numero_cas" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('numero_cas') }}">
                </div>
                <div class="text-center">
                    <p>Ref. de fabricante</p>
                    <input type="text" name="referencia_fabricante" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('referencia_fabricante') }}">
                </div>
                <div class="text-center">
                    <p>Lote</p>
                    <input type="text" name="lote" class="form-control bg-white rounded-4" style="text-align: center;"
                        placeholder="---" value="{{ request()->get('lote') }}">
                </div>
                <div class="text-center">
                    <p># Registro Invima</p>
                    <input type="text" name="num_registro_invima" class="form-control bg-white rounded-4"
                        style="text-align: center;" placeholder="---" value="{{ request()->get('num_registro_invima') }}">
                </div>
                <div class="text-center">
                    <p>Filtrar</p>
                    <button type="submit" class="btn btn-primary rounded-3 btn-xxl"><i
                            class="bi bi-sort-down-alt fs-5"></i></button>
                </div>
                <div class="text-center">
                    <p>Agregar</p>
                    <a href="{{ route('reactivos.create') }}" class="btn btn-primary rounded-3 btn-xxl"
                        data-placement="center"><i class="bi bi-plus-circle fs-5"></i></a>
                </div>
            </div> 
        </div>
    </form>
@endsection

@section('table_header')
    <th class="col-md-1">#</th>
    <th>Nombre</th>
    <th>Img Reactivo</th>
    <th>Numero Cas</th>
    <th>Referencia Fabricante</th>
    <th>Lote</th>
    <th>Num Registro Invima</th>
    <th>Familia Id</th>
    <th>Marca Id</th>
@endsection

@section('table_content')
    @if ($reactivos->isEmpty())
        <tr>
            <td colspan="3" class="text-center">No hay reactivos disponibles.</td>
        </tr>
    @else
        @foreach ($reactivos as $reactivo)
            <tr>
                <td>{{ ++$i }}</td>

                <td>{{ $reactivo->nombre }}</td>
                <td>{{ $reactivo->img_reactivo }}</td>
                <td>{{ $reactivo->numero_cas }}</td>
                <td>{{ $reactivo->referencia_fabricante }}</td>
                <td>{{ $reactivo->lote }}</td>
                <td>{{ $reactivo->num_registro_invima }}</td>
                <td>{{ $reactivo->familia ? $reactivo->familia->nombre : 'Sin familia' }}</td>
                <td>{{ $reactivo->marca ? $reactivo->marca->nombre : 'Sin marca' }}</td>

                <td class="text-end">
                    <form action="{{ route('reactivos.destroy', $reactivo->id) }}" method="POST" class="d-inline">
                        <a class="btn btn-sm" href="javascript:void(0)"
                            onclick="mostrarModalReactivo({{ json_encode($reactivo) }})" data-bs-toggle="modal"
                            data-bs-target="#reactivoModal">
                            <i class="bi bi-search text-primary fs-5"></i>
                        </a>
                        <a class="btn btn-sm" href="{{ route('reactivos.edit', $reactivo->id) }}">
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
        {!! $reactivos->appends(request()->except('page'))->links() !!}
    </div>
@endsection

<div class="modal fade" id="reactivoModal" tabindex="-1" aria-labelledby="reactivoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3" id="reactivoModalLabel">Detalles del
                    reactivo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Nombre:</strong>
                    <span id="modalNombre"></span>
                    <br>
                    <strong># CAS:</strong>
                    <span id="modalNumeroCas"></span>
                    <br>
                    <strong>Referencia de fabricante:</strong>
                    <span id="modalReferenciaFabricante"></span>
                    <br>
                    <strong>Lote:</strong>
                    <span id="modalLote"></span>
                    <br>
                    <strong>Registro Invima:</strong>
                    <span id="modalRegistroInvima"></span>
                    <br>
                    <strong>Familia:</strong>
                    <span id="modalFamilia"></span>
                    <br>
                    <strong>Marca:</strong>
                    <span id="modalMarca"></span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function mostrarModalReactivo(reactivo) {
        document.getElementById('modalNombre').textContent = reactivo.nombre;
        document.getElementById('modalNumeroCas').textContent = reactivo.numero_cas;
        document.getElementById('modalReferenciaFabricante').textContent = reactivo.referencia_fabricante;
        document.getElementById('modalLote').textContent = reactivo.lote;
        document.getElementById('modalRegistroInvima').textContent = reactivo.num_registro_invima;
        document.getElementById('modalFamilia').textContent = reactivo.familia ? reactivo.familia.nombre : 'Sin familia';
        document.getElementById('modalMarca').textContent = reactivo.marca ? reactivo.marca.nombre : 'Sin marca';
        var reactivoModal = new bootstrap.Modal(document.getElementById('reactivoModal'));
        document.getElementById('reactivoModal').addEventListener('hidden.bs.modal', function(event) {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop')?.remove();
        });
        reactivoModal.show();
    }
</script>
