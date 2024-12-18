@extends('layouts.create')
@section('back_route')
    {{ route('movimientos.index') }}
@endsection

@section('heading', 'Mostrar movimiento')
@section('form_content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-group mb-2 mb20">
                <label for="fecha_movimiento" class="form-label">{{ __('Fecha') }}</label>
                <input type="date" name="fecha_movimiento" class="form-control bg-white"
                    value="{{ $movimiento->fecha_movimiento }}" disabled>
            </div>
            <div class="form-group mb-2 mb20">
                <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                <input type="text" name="descripcion" class="form-control bg-white"
                    value="{{ $movimiento->descripcion }}" disabled>
            </div>
            <div class="form-group mb-2 mb20">
                <label for="tipo_movimiento" class="form-label">{{ __('Tipo de movimiento') }}</label>
                <input type="text" name="tipo_movimiento" class="form-control bg-white"
                    value="{{ $tipoMovimientos->getName() }}" disabled>
            </div>
            <div class="form-group mb-2 mb20">
                <label for="usuario_id" class="form-label">{{ __('Usuario') }}</label>
                <input type="text" name="usuario_id" class="form-control bg-white" value="{{ $movimiento->user->name }}"
                    disabled>
            </div>
            <div class="form-group mb-2 mb20">
                <label for="estado" class="form-label">{{ __('Estado') }}</label>
                <input type="text" name="estado" class="form-control bg-white" value="{{ $movimiento->estado }}"
                    disabled>
            </div>
            <br>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="showItemModal()" href="javascript:void(0)"
                    data-bs-toggle="modal" data-bs-target="#itemModal">Añadir Ítems</button>
                <br>
                <br>
            </div>
            {{-- <p>Tipo de Movimiento ID: {{ $tipoMovimientoID }}</p> --}}
        </div>
    </div>
@endsection

@section('other_content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h4 class="text-center">Ítems agregados</h4>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-hover table-border-0 table-bg-white table-rounded-4">
                    <thead>
                        <tr class="text-center">
                            <th class="col-md-1">#</th>
                            <th>Nombre del reactivo</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="items-list" class="text-center">
                        @forelse ($movimiento->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->reactivo->nombre }}</td>
                                <td>{{ $item->cantidad }}</td>
                                <td class="text-center">
                                    @if ($movimiento->estado === 'sin asignar')
                                        <form action="{{ route('item_movimiento.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este ítem?');"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-3">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay ítems agregados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 px-3 bg-white">
            <div class="modal-header">
                <h5 class="modal-title text-primary text-center w-100 fs-3 " id="itemModalLabel">Añadir ítems al
                    movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="itemForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="movimiento_id" value="{{ $movimiento->id }}">

                    <div class="form-group mb-2 mb20">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control"
                            placeholder="Cantidad">
                    </div>

                    <div class="form-group mb-2 mb20 compra-only">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control"
                            placeholder="Ubicación">
                    </div>

                    <div class="form-group mb-2 mb20 compra-only">
                        <label for="codigoUNAB" class="form-label">Código UNAB</label>
                        <input type="text" name="codigoUNAB" id="codigoUNAB" class="form-control"
                            placeholder="Código UNAB">
                    </div>

                    <div class="form-group mb-2 mb20 compra-only">
                        <label for="fechaVencimiento" class="form-label">Fecha de vencimiento</label>
                        <input type="date" name="fechaVencimiento" id="fechaVencimiento" class="form-control"
                            placeholder="Fecha de vencimiento">
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="reactivo_id" class="form-label">Reactivo</label>
                        <select name="reactivo_id" id="reactivo_id" class="form-control">
                            <option value="">Seleccione un reactivo</option>
                            @foreach ($reactivos as $reactivo)
                                <option value="{{ $reactivo->id }}">
                                    {{ $reactivo->nombre }}-{{ $reactivo->marca ? $reactivo->marca->nombre : 'Sin marca' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="laboratorio_id" class="form-label">Laboratorio</label>
                        <select name="laboratorio_id" id="laboratorio_id" class="form-control">
                            <option value="">Seleccione un laboratorio</option>
                            @foreach ($laboratorios as $laboratorio)
                                <option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mb20">
                        <label for="unidad_id" class="form-label">Unidad</label>
                        <select name="unidad_id" id="unidad_id" class="form-control">
                            <option value="">Seleccione la unidad</option>
                            @foreach ($unidads as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="alertContainer" class="d-none">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                            aria-label="Info:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        <div>
                            El ítem se ha guardado correctamente.
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="submitItemForm()">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>




@push('scripts')
    <script>
        // Función para mostrar el modal
        function showItemModal() {
            const itemModal = new bootstrap.Modal(document.getElementById('itemModal'));
            document.getElementById('itemModal').addEventListener('hidden.bs.modal', function(event) {
                document.body.classList.remove('modal-open');
                document.querySelector('.modal-backdrop')?.remove();
                location.reload();
            });
            itemModal.show();

        }
        // Función para enviar el formulario de ítem por AJAX
        function submitItemForm() {
            const formData = new FormData(document.getElementById('itemForm'));

            fetch("{{ route('item_movimiento.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const itemList = document.getElementById('items-list');
                        const newRow = `
                            <tr>
                                <td>${data.item.id}</td>
                                <td>${data.item.reactivo.nombre}</td>
                                <td>${data.item.cantidad}</td>
                                <td>${data.item.ubicacion ? data.item.ubicacion : 'N/A'}</td>
                                <td>${data.item.codigoUNAB ? data.item.codigoUNAB : 'N/A'}</td>
                                <td>${data.item.fechaVencimiento ? data.item.fechaVencimiento : 'N/A'}</td>
                                <td>${data.item.laboratorio.nombre}</td>
                                <td>${data.item.unidad.nombre}</td>
                                <td class="text-center">
                                    <form action="{{ route('item_movimiento.destroy', '') }}/${data.item.id}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-3">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        itemList.insertAdjacentHTML('beforeend', newRow);
                    } else {
                        alert("Hubo un error al añadir el ítem.");
                    }
                })
                .catch(error => console.error('Error:', error));

            document.getElementById('itemForm').reset();

            // Mostrar alerta de éxito
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.classList.remove('d-none');
        }
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoMovimientoID = {{ $tipoMovimientoID }}; // Asumiendo que se pasa desde el servidor
            toggleCompraFields(tipoMovimientoID);
        });

        function toggleCompraFields(id) {
            const compraFields = document.querySelectorAll('.compra-only');
            compraFields.forEach(field => {
                field.style.display = (id === 1) ? 'block' : 'none'; // Cambia el ID según tu tipo de "COMPRA"
            });
        }
    </script> --}}
@endpush
