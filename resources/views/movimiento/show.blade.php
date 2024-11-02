@extends('layouts.create')
@section('back_route')
    {{ route('movimientos.index') }}
@endsection
{{-- @section('form_action')
    {{ route('movimientos.store') }}
@endsection --}}
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
                    value="{{ $movimiento->tipoMovimiento->nombre }}" disabled>
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
                <button type="button" class="btn btn-primary" onclick="showItemModal()">Añadir Ítems</button>
                <br>
                <br>
                <br>
                <h4>Ítems agregados</h4>
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
                        <tbody>
                            @forelse ($movimiento->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->reactivo->nombre }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('item_movimiento.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este ítem?');"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-3">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
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
    </div>

    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="itemForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemModalLabel">Añadir Ítem al Movimiento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Campo oculto para el ID del movimiento --}}
                        <input type="hidden" name="movimiento_id" value="{{ $movimiento->id }}">

                        {{-- Reactivo --}}
                        <div class="form-group mb-2">
                            <label for="reactivo_id" class="form-label">Reactivo</label>
                            <select name="reactivo_id" id="reactivo_id" class="form-control">
                                <option value="">Seleccione un reactivo</option>
                                @foreach ($reactivos as $reactivo)
                                    <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Cantidad --}}
                        <div class="form-group mb-2">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control"
                                placeholder="Cantidad">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="submitItemForm()">Guardar Ítem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Función para mostrar el modal
        function showItemModal() {
            const itemModal = new bootstrap.Modal(document.getElementById('itemModal'));
            itemModal.show();
        }

        // Función para enviar el formulario de ítem por AJAX
        function submitItemForm() {
            // Datos del formulario
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
                        // Cerrar el modal
                        const itemModal = bootstrap.Modal.getInstance(document.getElementById('itemModal'));
                        itemModal.hide();

                        // Limpiar el formulario
                        document.getElementById('itemForm').reset();

                        // Actualizar la lista de ítems
                        const itemList = document.getElementById('items-list');
                        itemList.innerHTML += `<li>${data.item.reactivo.nombre} - Cantidad: ${data.item.cantidad}</li>`;
                    } else {
                        alert("Hubo un error al añadir el ítem.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endpush
