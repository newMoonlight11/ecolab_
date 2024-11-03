<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Laboratorio;
use App\Models\Marca;
use App\Models\Reactivo;
use App\Models\Residuo;
use App\Models\StockReactivo;
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
        $stockData = StockReactivo::selectRaw("
                EXTRACT(MONTH FROM fecha_stock) as mes,
                SUM(CASE WHEN cantidad_existencia > 0 AND fecha_stock < current_date - interval '1 month' THEN cantidad_existencia ELSE 0 END) as existentes,
                SUM(CASE WHEN cantidad_existencia > 0 AND fecha_stock >= current_date - interval '1 month' THEN cantidad_existencia ELSE 0 END) as nuevos,
                SUM(CASE WHEN cantidad_existencia = 0 THEN 1 ELSE 0 END) as salieron
            ")
            ->groupBy('mes')
            ->get()
            ->map(function ($row) {
                return [
                    // Convertimos el número de mes a nombre usando Carbon::create()->month($row->mes)->format('F')
                    'mes' => Carbon::create(null, $row->mes)->format('M'),
                    'existentes' => $row->existentes,
                    'nuevos' => $row->nuevos,
                    'salieron' => $row->salieron,
                ];
            });

        return view('home', compact(
            'totalReactivos',
            'totalLaboratorios',
            'totalMarcas',
            'totalFamilias',
            'totalResiduos',
            'stockData'
        ));
    }
}
