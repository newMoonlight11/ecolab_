@extends('layouts.app')
<style>
    /* Contenedor general */

    .container {
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding: 20px !important;
    }

    /* Cards contenedoras */
    .summary-cards {
        display: flex !important;
        gap: 20px !important;
        flex-wrap: wrap !important;
        justify-content: space-between !important;
        border: none;
    }

    /* Cada card */
    .card {
        flex: 1 1 calc(20% - 20px) !important;
        min-width: 160px !important;
        padding: 20px !important;
        border-radius: 15px !important;
        text-align: center !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(1.05) !important;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2) !important;
    }

    /* Colores personalizados */
    .card-reactivos {
        background-color: #1168ba !important;
        color: #fff !important;
    }

    .card-laboratorios {
        background-color: rgb(113, 57, 225) !important;
        color: #fff !important;
    }

    .card-marcas {
        background-color: rgb(247, 138, 30) !important;
        color: #fff !important;
    }

    .card-familias {
        background-color: rgb(54, 187, 187) !important;
        color: #fff !important;
    }

    .card-residuos {
        background-color: rgb(54, 163, 235) !important;
        color: #fff !important;
    }

    /* Tipografía */
    .card p {
        font-size: 1.2rem !important;
        margin: 0 !important;
        font-weight: 500;
    }

    .card h2 {
        font-size: 2.8rem !important;
        margin: 10px 0 0 0 !important;
    }

    /* Estilos para la barra de progreso */
    .progress {
        height: 10px;
        border-radius: 5px;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 5px;
        background-color: #ff6666;
        /* Color rojo claro */
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .summary-cards {
            flex-direction: column !important;
        }

        .card {
            flex: 1 1 100% !important;
            margin-bottom: 15px !important;
        }
    }
</style>

@section('content')
    <div class="container">
        <h1 class="dashboard-title">Analíticas</h1>
        <p class="dashboard-periodo">Periodo: 2024</p>

        <div class="summary-cards border-0">
            <div class="card card-reactivos">
                <p>Total reactivos</p>
                <h2>{{ $totalReactivos }}</h2>
            </div>
            <div class="card card-laboratorios">
                <p>Total laboratorios</p>
                <h2>{{ $totalLaboratorios }}</h2>
            </div>
            <div class="card card-marcas">
                <p>Total marcas</p>
                <h2>{{ $totalMarcas }}</h2>
            </div>
            <div class="card card-familias">
                <p>Total familias</p>
                <h2>{{ $totalFamilias }}</h2>
            </div>
            <div class="card card-residuos">
                <p>Total residuos</p>
                <h2>{{ $totalResiduos }}</h2>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm" style="background-color: white; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Movimientos mensuales por tipo</h5>
                        <canvas id="movimientosChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm" style="background-color: white; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Residuos ingresados al sistema</h5>
                        <canvas id="residuosChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm rounded" style="background-color: white;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Categorías de familias</h5>
                        <canvas id="familiasChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm rounded" style="background-color: white;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Reactivos por laboratorio</h5>
                        <canvas id="laboratoriosChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container mt-5">
        <div class="card shadow-sm" style="background-color: white; border-radius: 10px;">
            <div class="card-body">
                <h5 class="card-title text-center">Reactivos que van a vencer</h5>
                <ul class="list-group">
                    @foreach ($reactivosAVencer as $reactivo)
                        @php
                            $progress = max(0, min(100, ($reactivo['dias'] / 30) * 100));
                        @endphp
                        <li class="list-group-item d-flex flex-column align-items-start">
                            <div class="d-flex justify-content-between w-100">
                                <span>{{ $reactivo['nombre'] }}</span>
                                <span>{{ $reactivo['dias'] }} días</span>
                            </div>
                            <div class="progress w-100 mt-2">
                                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> --}}
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const movimientosCtx = document.getElementById('movimientosChart').getContext('2d');
        const movimientosData = @json($movimientosFormattedData);

        const labels = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP',
            'OCT', 'NOV', 'DIC'
        ];

        const datasets = Object.keys(movimientosData).map((tipoMovimiento, index) => {
            const colors = [
                'rgba(54, 162, 235, 0.8)', // Azul
                'rgba(75, 192, 192, 0.8)', // Verde
                'rgba(153, 102, 255, 0.8)', // Morado
                'rgba(255, 159, 64, 0.8)' // Naranja
            ];
            return {
                label: tipoMovimiento,
                data: movimientosData[tipoMovimiento],
                backgroundColor: colors[index % colors.length]
            };
        });

        new Chart(movimientosCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de movimientos'
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const residuosCtx = document.getElementById('residuosChart').getContext('2d');
        const residuosData = @json($residuosFormattedData);
        const labels = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP',
            'OCT', 'NOV', 'DIC'
        ];

        const datasets = Object.keys(residuosData).map((claseResiduo, index) => {
            const colors = [
                'rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)'
            ];
            return {
                label: claseResiduo,
                data: residuosData[claseResiduo],
                backgroundColor: colors[index % colors.length]
            };
        });

        new Chart(residuosCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Mes'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de residuos'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos para la gráfica de Familias de Reactivos
        const familiasData = @json($familiasData);
        const familiaLabels = familiasData.map(familia => familia.nombre);
        const familiaValues = familiasData.map(familia => familia.total);

        new Chart(document.getElementById('familiasChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: familiaLabels,
                datasets: [{
                    label: 'Total de reactivos',
                    data: familiaValues,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                },
            }
        });

        // Datos para la gráfica de Reactivos por Laboratorio
        const laboratoriosData = @json($laboratoriosData);
        const laboratorioLabels = laboratoriosData.map(laboratorio => laboratorio.nombre);
        const laboratorioValues = laboratoriosData.map(laboratorio => laboratorio.total);

        new Chart(document.getElementById('laboratoriosChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: laboratorioLabels,
                datasets: [{
                    label: 'Total de Reactivos',
                    data: laboratorioValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Laboratorio'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        },
                        grid: {
                            display: false // Oculta la cuadrícula
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfica de Movimientos Mensuales por Tipo (más ancha)
        const movimientosCtx = document.getElementById('movimientosChart').getContext('2d');
        const movimientosData = @json($movimientosFormattedData);

        const labels = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
        const movimientosDatasets = Object.keys(movimientosData).map((tipoMovimiento, index) => {
            const colors = ['rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)'
            ];
            return {
                label: tipoMovimiento,
                data: movimientosData[tipoMovimiento],
                backgroundColor: colors[index % colors.length]
            };
        });

        new Chart(movimientosCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: movimientosDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Meses'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Aquí puedes incluir el código para las demás gráficas (residuos, familias, laboratorios) siguiendo el mismo formato para personalizar.
    });
</script>
