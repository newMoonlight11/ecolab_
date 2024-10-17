@extends('layouts.app')


{{-- @section('content')
    Te bamo bami
@endsection --}}
{{-- @section('content')
    <div class="container">
        <br>
        <br>
        <h1 class="text-center">Estadísticas de reactivos</h1>
        <br>
        <h3 class="text-center">Total de reactivos: {{ $totalReactivos }}</h3>
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <div class="card border-0 rounded-4 bg-white p-5 col-md-7">
                <h4>Reactivos por laboratorio</h4>
                <canvas id="reactivosPorLaboratorioChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-4">
                <h4>Reactivos por familia</h4>
                <canvas id="reactivosPorFamiliaChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-6">
                <h4>Reactivos por vencer (próximos 30 días)</h4>
                <canvas id="reactivosPorVencerChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-5">
                <h4>Reactivos con baja cantidad (menos de 10 unidades)</h4>
                <canvas id="reactivosConBajaCantidadChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Reactivos por Laboratorio
        const ctxLaboratorio = document.getElementById('reactivosPorLaboratorioChart').getContext('2d');
        const reactivosPorLaboratorioChart = new Chart(ctxLaboratorio, {
            type: 'bar',
            data: {
                labels: @json($laboratorios),
                datasets: [{
                    label: 'Reactivos por Laboratorio',
                    data: @json($totalesLaboratorio),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Reactivos por Familia
        const ctxFamilia = document.getElementById('reactivosPorFamiliaChart').getContext('2d');
        const reactivosPorFamiliaChart = new Chart(ctxFamilia, {
            type: 'pie',
            data: {
                labels: @json($familias),
                datasets: [{
                    label: 'Reactivos por Familia',
                    data: @json($totalesFamilia),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Reactivos por Familia'
                    }
                }
            }
        });

        // Reactivos por Vencer (próximos 30 días)
        const ctxPorVencer = document.getElementById('reactivosPorVencerChart').getContext('2d');
        const reactivosPorVencerChart = new Chart(ctxPorVencer, {
            type: 'bar',
            data: {
                labels: @json($reactivosPorVencer->pluck('nombre')),
                datasets: [{
                    label: 'Reactivos por Vencer',
                    data: @json($reactivosPorVencer->pluck('cantidad')),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Reactivos con Baja Cantidad
        const ctxBajaCantidad = document.getElementById('reactivosConBajaCantidadChart').getContext('2d');
        const reactivosConBajaCantidadChart = new Chart(ctxBajaCantidad, {
            type: 'bar',
            data: {
                labels: @json($reactivosConBajaCantidad->pluck('nombre')),
                datasets: [{
                    label: 'Reactivos con Baja Cantidad',
                    data: @json($reactivosConBajaCantidad->pluck('cantidad')),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection --}}

@section('content')
    <div class="container">
        <br>
        <br>
        <h1 class="text-center">Estadísticas de reactivos</h1>
        <br>
        <h3 class="text-center">Total de reactivos: 150</h3> {{-- Total sintético --}}
        <div class="d-flex flex-wrap justify-content-between">
            <div class="card border-0 rounded-4 bg-white p-5 w-50">
                <h4>Reactivos por laboratorio</h4>
                <canvas id="reactivosPorLaboratorioChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 w-50" style="height: 405px;">
                <h4>Reactivos por familia</h4>
                <canvas id="reactivosPorFamiliaChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 w-50">
                <h4>Reactivos por vencer (próximos 30 días)</h4>
                <canvas id="reactivosPorVencerChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 w-50">
                <h4>Reactivos con baja cantidad (menos de 10 unidades)</h4>
                <canvas id="reactivosConBajaCantidadChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos sintéticos para pruebas

        // Reactivos por Laboratorio
        const ctxLaboratorio = document.getElementById('reactivosPorLaboratorioChart').getContext('2d');
        const reactivosPorLaboratorioChart = new Chart(ctxLaboratorio, {
            type: 'bar',
            data: {
                labels: ['E-BIO', 'Histopatología', 'Microbiología', 'Instituto Caldas'], // Laboratorios sintéticos
                datasets: [{
                    label: 'Reactivos por laboratorio',
                    data: [45, 25, 60, 20], // Totales sintéticos por laboratorio
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Reactivos por Familia
        const ctxFamilia = document.getElementById('reactivosPorFamiliaChart').getContext('2d');
        const reactivosPorFamiliaChart = new Chart(ctxFamilia, {
            type: 'pie',
            data: {
                labels: ['Alcoholes', 'Ácidos', 'Bases', 'Sales inorgánicas y orgánicas'], // Familias sintéticas
                datasets: [{
                    label: 'Reactivos por familia',
                    data: [40, 30, 50, 30], // Totales sintéticos por familia
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Reactivos por Familia'
                    }
                }
            }
        });

        // Reactivos por Vencer (próximos 30 días)
        const ctxPorVencer = document.getElementById('reactivosPorVencerChart').getContext('2d');
        const reactivosPorVencerChart = new Chart(ctxPorVencer, {
            type: 'bar',
            data: {
                labels: ['Ácido Clorhídrico', 'Tiocianato de amonio',
                'Hidróxido de potasio'], // Reactivos sintéticos
                datasets: [{
                    label: 'Reactivos por vencer',
                    data: [5, 7, 3], // Cantidades sintéticas de reactivos próximos a vencer
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Reactivos con Baja Cantidad
        const ctxBajaCantidad = document.getElementById('reactivosConBajaCantidadChart').getContext('2d');
        const reactivosConBajaCantidadChart = new Chart(ctxBajaCantidad, {
            type: 'bar',
            data: {
                labels: ['Ácido acético', 'Cloruro de magnesio', 'Nitrato de plata'], // Reactivos sintéticos
                datasets: [{
                    label: 'Reactivos con baja cantidad',
                    data: [8, 9, 6], // Cantidades sintéticas de reactivos con baja cantidad
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

{{-- @section('content')
<div class="container">
    <div class="row">
        <!-- Estadísticas -->
        <div class="col-md-12 mb-3">
            <h2>Analíticas</h2>
            <h5>Periodo: Julio - Septiembre 2024</h5>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total reactivos</h5>
                    <p class="card-text">{{ $data['total_reactivos'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total laboratorios</h5>
                    <p class="card-text">{{ $data['total_laboratorios'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total marcas</h5>
                    <p class="card-text">{{ $data['total_marcas'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total familias</h5>
                    <p class="card-text">{{ $data['total_familias'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total residuos</h5>
                    <p class="card-text">{{ $data['total_residuos'] }}</p>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="col-md-6">
            <h4>Reactivos en stock</h4>
            <canvas id="stockChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Residuos generados</h4>
            <canvas id="residuosChart"></canvas>
        </div>

        <!-- Otras métricas -->
        <div class="col-md-6">
            <h4>Categorías populares</h4>
            <canvas id="categoriasChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Compras de reactivos</h4>
            <canvas id="comprasChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Reactivos que van a vencer</h4>
            <ul>
                @foreach ($data['reactivos_a_vencer'] as $nombre => $dias)
                    <li>{{ $nombre }} - {{ $dias }} días</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Reactivos en Stock
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    new Chart(stockCtx, {
        type: 'bar',
        data: {
            labels: ['Jul', 'Ago', 'Sep'],
            datasets: [{
                label: 'Existentes',
                data: [{{ implode(',', $data['reactivos_stock']['jul']) }}, {{ implode(',', $data['reactivos_stock']['ago']) }}, {{ implode(',', $data['reactivos_stock']['sep']) }}],
                backgroundColor: '#007bff',
            }]
        }
    });

    // Gráfico de Residuos generados
    const residuosCtx = document.getElementById('residuosChart').getContext('2d');
    new Chart(residuosCtx, {
        type: 'line',
        data: {
            labels: ['Jul', 'Ago', 'Sep'],
            datasets: [{
                label: 'Residuos',
                data: [{{ implode(',', $data['residuos_generados']) }}],
                borderColor: '#007bff',
                fill: false
            }]
        }
    });

    // Gráfico de Categorías populares
    const categoriasCtx = document.getElementById('categoriasChart').getContext('2d');
    new Chart(categoriasCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($data['categorias_populares'])) !!},
            datasets: [{
                data: {!! json_encode(array_values($data['categorias_populares'])) !!},
                backgroundColor: ['#007bff', '#17a2b8', '#ffc107', '#28a745', '#dc3545']
            }]
        }
    });

    // Gráfico de Compras de Reactivos
    const comprasCtx = document.getElementById('comprasChart').getContext('2d');
    new Chart(comprasCtx, {
        type: 'line',
        data: {
            labels: ['Jul', 'Ago', 'Sep'],
            datasets: [{
                label: 'Compras',
                data: [{{ implode(',', $data['compras_reactivos']) }}],
                borderColor: '#ffc107',
                fill: false
            }]
        }
    });
</script>
@endsection
 --}}
