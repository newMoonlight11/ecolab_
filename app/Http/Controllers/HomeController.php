<?php

namespace App\Http\Controllers;

use App\Models\ClaseResiduo;
use App\Models\Familia;
use App\Models\Laboratorio;
use App\Models\Marca;
use App\Models\Movimiento;
use App\Models\Reactivo;
use App\Models\Residuo;
use App\Models\ResiduoLaboratorio;
use App\Models\StockReactivo;
use App\Models\TipoMovimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Datos de las tarjetas
        $totalReactivos = Reactivo::count();
        $totalLaboratorios = Laboratorio::count();
        $totalMarcas = Marca::count();
        $totalFamilias = Familia::count();
        $totalResiduos = Residuo::count();

        // Datos para la gráfica "Reactivos en stock"
        // Obtén los datos de `stock_reactivos` y clasifícalos según el tiempo
        $movimientosData = Movimiento::selectRaw("
            EXTRACT(MONTH FROM fecha_movimiento) as mes,
            tipo_movimiento,
            COUNT(id) as total
        ")
            ->whereYear('fecha_movimiento', Carbon::now()->year) // Solo el año actual
            ->groupBy('mes', 'tipo_movimiento')
            ->get();

        $tiposMovimiento = TipoMovimiento::all()->pluck('nombre', 'id');
        $movimientosFormattedData = [];
        foreach ($tiposMovimiento as $tipoId => $tipoNombre) {
            $movimientosFormattedData[$tipoNombre] = array_fill(0, 12, 0);
            foreach ($movimientosData as $movimiento) {
                if ($movimiento->tipo_movimiento == $tipoId) {
                    $movimientosFormattedData[$tipoNombre][$movimiento->mes - 1] = $movimiento->total;
                }
            }
        }

        // Consulta de residuos por mes y clase
        $residuosData = ResiduoLaboratorio::selectRaw("
        EXTRACT(MONTH FROM fecha_stock) as mes,
        clase_residuo_id,
        COUNT(residuo_laboratorios.id) as total
    ")
            ->join('residuos', 'residuos.id', '=', 'residuo_laboratorios.residuo_id')
            ->groupBy('mes', 'clase_residuo_id')
            ->get();


        // Obtener todas las clases de residuos
        $clasesResiduos = ClaseResiduo::all()->pluck('nombre', 'id');

        // Organizar los datos en un formato que Chart.js pueda entender
        $residuosFormattedData = [];
        foreach ($clasesResiduos as $claseId => $claseNombre) {
            $residuosFormattedData[$claseNombre] = array_fill(0, 12, 0);
            foreach ($residuosData as $residuo) {
                if ($residuo->clase_residuo_id == $claseId) {
                    $residuosFormattedData[$claseNombre][$residuo->mes - 1] = $residuo->total;
                }
            }
        }

        $laboratoriosData = Laboratorio::withCount('stockReactivos')->get()->map(function ($laboratorio) {
            return [
                'nombre' => $laboratorio->nombre,
                'total' => $laboratorio->stock_reactivos_count, // Número de reactivos en el laboratorio
            ];
        });

        $familiasData = Familia::withCount('reactivos')->get()->map(function ($familia) {
            return [
                'nombre' => $familia->nombre,
                'total' => $familia->reactivos_count, // Número de reactivos en la familia
            ];
        });

        $reactivosAVencer = [
            ['nombre' => 'Reactivo A', 'dias' => 5],
            ['nombre' => 'Reactivo B', 'dias' => 7],
            ['nombre' => 'Reactivo C', 'dias' => 10],
            ['nombre' => 'Reactivo D', 'dias' => 15],
            ['nombre' => 'Reactivo E', 'dias' => 20]
        ];

        return view('home', compact(
            'totalReactivos',
            'totalLaboratorios',
            'totalMarcas',
            'totalFamilias',
            'totalResiduos',
            'movimientosFormattedData', // Datos de movimientos para la gráfica 1
            'residuosFormattedData',     // Datos de residuos para la gráfica 2
            'familiasData',
            'laboratoriosData',
            'reactivosAVencer'
        ));
    }
}
