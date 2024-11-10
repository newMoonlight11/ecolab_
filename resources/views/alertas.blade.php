@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center display-6">Alertas</h2>

        <!-- Reactivos por Caducar -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                Reactivos próximos a caducar
            </div>
            <div class="row ps-4 pe-4 pt-4">
                @foreach ($reactivosProntosAVencer as $reactivo)
                    <div class="col-md-4 mb-4">
                        <div class="card 
                            @if ($reactivo->alerta === 'rojo') border-danger 
                            @elseif($reactivo->alerta === 'naranja') border-warning 
                            @elseif($reactivo->alerta === 'amarillo') border-warning
                            @elseif($reactivo->alerta === 'negro') border-dark
                            @else border-secondary @endif">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Reactivo: {{ $reactivo->reactivo_id ? $reactivo->reactivo->nombre : 'Sin reactivo'}}
                                </h5>
                                <p>Laboratorio: {{ $reactivo->laboratorio->nombre ?? 'Sin laboratorio' }}</p>
                                <p>Días para caducar: {{ $reactivo->diasRestantes }}</p>
                                <p>Ubicación: {{ $reactivo->ubicacion }}</p>
                                <p>Código UNAB: {{ $reactivo->codigoUNAB }}</p>
                                <p>Alerta: 
                                    <span class="badge 
                                        @if ($reactivo->alerta == 'rojo') bg-danger 
                                        @elseif($reactivo->alerta == 'naranja') bg-warning 
                                        @elseif($reactivo->alerta == 'amarillo') bg-warning 
                                        @elseif($reactivo->alerta == 'negro') bg-dark 
                                        @endif">
                                        &nbsp; 
                                    </span> 
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
