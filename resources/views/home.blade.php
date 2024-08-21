@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <br>
        <h1 class="text-center">Estadísticas de Reactivos</h1>
        <br>
        <h3 class="text-center">Total de Reactivos: {{ $totalReactivos }}</h3>
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <div class="card border-0 rounded-4 bg-white p-5 col-md-7">
                <h4>Reactivos por Laboratorio</h4>
                <canvas id="reactivosPorLaboratorioChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-4">
                <h4>Reactivos por Familia</h4>
                <canvas id="reactivosPorFamiliaChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-6">
                <h4>Reactivos por Vencer (próximos 30 días)</h4>
                <canvas id="reactivosPorVencerChart"></canvas>
            </div>

            <div class="card border-0 rounded-4 bg-white p-5 col-md-5">
                <h4>Reactivos con Baja Cantidad (menos de 10 unidades)</h4>
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
@endsection
