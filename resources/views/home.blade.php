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
    }

    /* Cada card */
    .card {
        flex: 1 1 calc(20% - 20px) !important;
        /* Ocupa el 20% del ancho con margen */
        min-width: 160px !important;
        padding: 20px !important;
        border-radius: 20px !important;
        /* Bordes más redondeados */
        text-align: center !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
    }

    /* Colores personalizados y estilos de texto con !important */
    .card-reactivos {
        background-color: #004E98 !important;
        /* Fondo azul oscuro */
        color: #fff !important;
        /* Texto blanco */
    }

    .card-laboratorios {
        background-color: #5B8DD2 !important;
        /* Fondo azul claro */
        color: #000 !important;
        /* Texto negro */
    }

    .card-marcas {
        background-color: #AAD5FF !important;
        /* Fondo azul muy claro */
        color: #000 !important;
        /* Texto negro */
    }

    .card-familias {
        background-color: #FFBA8B !important;
        /* Fondo naranja */
        color: #000 !important;
        /* Texto negro */
    }

    .card-residuos {
        background-color: #FFDBC2 !important;
        /* Fondo salmón claro */
        color: #000 !important;
        /* Texto negro */
    }

    /* Estilos para el texto */
    .card p {
        font-size: 1.2rem !important;
        margin: 0 !important;
    }

    .card h2 {
        font-size: 2.5rem !important;
        margin: 10px 0 0 0 !important;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .summary-cards {
            flex-direction: column !important;
            /* Apilar en dispositivos pequeños */
        }

        .card {
            flex: 1 1 100% !important;
            /* Cada card ocupa el 100% del ancho */
            margin-bottom: 15px !important;
        }
    }
</style>

@section('content')
    <div class="container">
        <h1 class="dashboard-title">Analíticas</h1>
        <p class="dashboard-periodo">Periodo: Septiembre - Noviembre 2024</p>

        <div class="summary-cards">
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
    <div class="container">
        <div class="row">
            <!-- Card para la gráfica de Movimientos -->
            <div class="col-md-6 mb-4">
                <div class="card"
                    style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <h5 class="card-title">Movimientos mensuales por tipo</h5>
                        <canvas id="movimientosChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card para la gráfica de Residuos en Stock -->
            <div class="col-md-6 mb-4">
                <div class="card"
                    style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <h5 class="card-title">Residuos ingresados al sistema</h5>
                        <canvas id="residuosChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        new Chart(residuosCtx, {
            type: 'bar',
            data: {
                labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP',
                    'OCT', 'NOV', 'DIC'
                ],
                datasets: [{
                    label: 'Residuos en stock',
                    data: residuosData,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)'
                }]
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
                            text: 'Cantidad en stock'
                        }
                    }
                }
            }
        });
    });
</script>
