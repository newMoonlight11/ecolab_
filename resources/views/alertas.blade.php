@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center display-6">Alertas</h2>

        <!-- Reactivos por Caducar -->
        <div class="card mb-4 bg-white">
            <div class="card-header bg-warning text-white">
                Reactivos próximos a caducar
            </div>
            <div class="row ps-4 pe-4 pt-4">
                @foreach ($reactivosProntosAVencer as $reactivo)
                    <div class="col-md-4 mb-4">
                        <div
                            class="card 
                            @if ($reactivo->alerta === 'rojo') border-danger 
                            @elseif($reactivo->alerta === 'naranja') border-pop 
                            @elseif($reactivo->alerta === 'amarillo') border-warning
                            @elseif($reactivo->alerta === 'negro') border-dark
                            @else border-secondary @endif bg-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Reactivo: {{ $reactivo->reactivo_id ? $reactivo->reactivo->nombre : 'Sin reactivo' }}
                                </h5>
                                <p>Laboratorio: {{ $reactivo->laboratorio->nombre ?? 'Sin laboratorio' }}</p>
                                <p>Días para caducar: {{ $reactivo->diasRestantes }}</p>
                                <p>Ubicación: {{ $reactivo->ubicacion }}</p>
                                <p>Código UNAB: {{ $reactivo->codigoUNAB }}</p>
                                <p>Alerta:
                                    <span class="badge @if ($reactivo->alerta == 'rojo') bg-danger @elseif($reactivo->alerta == 'naranja') bg-pop @elseif($reactivo->alerta == 'amarillo') bg-warning @elseif($reactivo->alerta == 'negro') bg-dark @endif">
                                        @if ($reactivo->alerta == 'rojo') Crítica @elseif($reactivo->alerta == 'naranja') Alta @elseif($reactivo->alerta == 'amarillo') Media @elseif($reactivo->alerta == 'negro') Desecho @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Reactivos con Poca Cantidad -->
        <div class="card mb-4 bg-white">
            <div class="card-header bg-danger text-white">
                Reactivos con poca cantidad
            </div>
            <div class="row ps-4 pe-4 pt-4">
                @foreach ($reactivosConPocaCantidad as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card border-danger bg-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Reactivo: {{ $item->reactivo->nombre ?? 'Sin reactivo' }}
                                </h5>
                                <p>Laboratorio: {{ $item->laboratorio->nombre ?? 'Sin laboratorio' }}</p>
                                <p>Cantidad Actual: {{ $item->stockActual }}</p>
                                <p>Umbral 15% de compra inicial: {{ round($item->umbralCantidad, 3) }}</p>
                                <p>Ubicación: {{ $item->ubicacion }}</p>
                                <p>Código UNAB: {{ $item->codigoUNAB }}</p>
                                <p>Alerta:
                                    <span class="badge bg-danger">Bajo Stock</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
