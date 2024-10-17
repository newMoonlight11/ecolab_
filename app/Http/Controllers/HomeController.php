<?php
namespace App\Http\Controllers;

use App\Models\Reactivo;
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
        // return view('home');
        /* // Consultas para estadísticas

        // Número total de reactivos
        $totalReactivos = Reactivo::count();

        // Número de reactivos por laboratorio
        $reactivosPorLaboratorio = Reactivo::select('laboratorio', DB::raw('count(*) as total'))
            ->groupBy('laboratorio')
            ->get();

        // Cantidad de reactivos por familia
        $reactivosPorFamilia = Reactivo::select('familia', DB::raw('count(*) as total'))
            ->groupBy('familia')
            ->get();

        // Reactivos que vencen en los próximos 30 días
        $fechaLimite = Carbon::now()->addDays(30);
        $reactivosPorVencer = Reactivo::where('fecha_vencimiento', '<=', $fechaLimite)
            ->get();

        // Reactivos con menor cantidad en stock
        $reactivosConBajaCantidad = Reactivo::where('cantidad', '<=', 10)
            ->get();

        // Preparar los datos para las gráficas
        $laboratorios = $reactivosPorLaboratorio->pluck('laboratorio');
        $totalesLaboratorio = $reactivosPorLaboratorio->pluck('total');

        $familias = $reactivosPorFamilia->pluck('familia');
        $totalesFamilia = $reactivosPorFamilia->pluck('total');

        return view('home', compact(
            'totalReactivos',
            'reactivosPorLaboratorio',
            'reactivosPorFamilia',
            'reactivosPorVencer',
            'reactivosConBajaCantidad',
            'laboratorios', 'totalesLaboratorio',
            'familias', 'totalesFamilia'
        )); */

        $data = [
            'total_reactivos' => 250,
            'total_laboratorios' => 7,
            'total_marcas' => 130,
            'total_familias' => 100,
            'total_residuos' => 122,
            'reactivos_stock' => [ // Datos para el gráfico de barras
                'jul' => [80, 50, 30],
                'ago' => [70, 40, 20],
                'sep' => [60, 30, 10],
            ],
            'residuos_generados' => [90, 80, 70, 85, 75, 60], // Datos para gráfico de líneas
            'categorias_populares' => [
                'Alcoholes' => 40,
                'Ácidos orgánicos' => 25,
                'Acetatos' => 20,
                'Sulfatos' => 10,
                'Nitratos' => 5,
            ],
            'compras_reactivos' => [100, 90, 80, 85, 75, 60], // Datos de compras
            'reactivos_a_vencer' => [
                'Potasio permanganato' => 9,
                'Nitrato de plata' => 7,
                'Amonio sulfato' => 5,
                'Sacarosa' => 4,
                'Cloroformo' => 3,
            ],
        ];
        return view('home', compact('data'));
    }
}
