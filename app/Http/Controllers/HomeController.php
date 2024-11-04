<?php

namespace App\Http\Controllers;

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

        $residuosData = ResiduoLaboratorio::selectRaw("
            EXTRACT(MONTH FROM fecha_stock) as mes,
            SUM(cantidad_existencia) as total
        ")
            ->whereYear('fecha_stock', Carbon::now()->year) // Solo el año actual
            ->groupBy('mes')
            ->get();

        $residuosFormattedData = array_fill(0, 12, 0); // Inicializar 12 meses en 0
        foreach ($residuosData as $residuo) {
            $residuosFormattedData[$residuo->mes - 1] = $residuo->total;
        }

        return view('home', compact(
            'totalReactivos',
            'totalLaboratorios',
            'totalMarcas',
            'totalFamilias',
            'totalResiduos',
            'movimientosFormattedData', // Datos de movimientos para la gráfica 1
            'residuosFormattedData'     // Datos de residuos para la gráfica 2
        ));
    }
}
