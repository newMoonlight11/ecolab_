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
        $reactivosEnStock = StockReactivo::selectRaw('COUNT(id) as total, 
        CASE 
            WHEN fecha_stock < NOW() - INTERVAL \'90 days\' THEN \'Antiguos\'
            WHEN fecha_stock BETWEEN NOW() - INTERVAL \'90 days\' AND NOW() - INTERVAL \'30 days\' THEN \'Nuevos\'
            ELSE \'Salieron del stock\'
        END as tipo, 
        EXTRACT(MONTH FROM fecha_stock) as mes')
            ->groupBy('tipo', 'mes')
            ->get();

        return view('home', compact(
            'totalReactivos',
            'totalLaboratorios',
            'totalMarcas',
            'totalFamilias',
            'totalResiduos',
            'reactivosEnStock'
        ));
    }
}
