<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMovimiento;
use App\Models\StockReactivo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AlertasController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now()->setTimezone('America/Bogota');


        // Reactivos que están a 15 días o menos de caducar, agrupados por `reactivo_id` para evitar duplicados
        $reactivosProntosAVencer = ItemMovimiento::with('laboratorio')
            ->select('reactivo_id', 'laboratorio_id', 'ubicacion', 'codigoUNAB', DB::raw('MIN("fechaVencimiento") as "fechaVencimiento"'))
            ->whereDate('fechaVencimiento', '<=', $hoy->copy()->addDays(15))
            ->groupBy('reactivo_id', 'laboratorio_id', 'ubicacion', 'codigoUNAB')
            ->get()
            ->map(function ($reactivo) use ($hoy) {

                $diasRestantes = $hoy->diffInDays(Carbon::parse($reactivo->fechaVencimiento)); // Calcula la diferencia en días
                $diasRestantes = round($diasRestantes); // Redondea al entero más cercano
                // echo $hoy;
                // echo "";
                // echo $reactivo->fechaVencimiento;
                // echo "";
                // echo $diasRestantes;
                // echo "";
                // Asigna la alerta y prioridad
                if ($diasRestantes <= 0) {
                    $reactivo->alerta = 'negro';
                    $reactivo->prioridad = 4;
                    $reactivo->diasRestantes = 'Vencido';
                } else {
                    $reactivo->alerta = match (true) {
                        $diasRestantes <= 5 => 'rojo',
                        $diasRestantes <= 10 => 'naranja',
                        $diasRestantes <= 15 => 'amarillo',
                        default => 'sin alerta',
                    };

                    $reactivo->prioridad = match ($reactivo->alerta) {
                        'rojo' => 1,
                        'naranja' => 2,
                        'amarillo' => 3,
                        default => 0,
                    };
                    $reactivo->diasRestantes = $diasRestantes;
                }

                return $reactivo;
            })
            ->filter(fn($reactivo) => $reactivo->alerta !== 'sin alerta') // Filtrar los que no tienen alerta
            ->sortBy(['prioridad', 'diasRestantes']);  // Ordenar por prioridad y días restantes
        // Obtener reactivos con poca cantidad
        $reactivosConPocaCantidad = ItemMovimiento::whereHas('movimiento', function ($query) {
            $query->where('tipo_movimiento', 1); // Filtrar por compras (tipo_movimiento = 1)
        })
            ->with(['reactivo', 'laboratorio', 'movimiento'])
            ->get()
            ->map(function ($item) {
                // Obtener el stock actual del reactivo
                $stockActual = StockReactivo::where('reactivo_id', $item->reactivo_id)
                    ->where('laboratorio_id', $item->laboratorio_id)
                    ->value('cantidad_existencia');

                // Verificar si el stock está en un 15% o menos de la cantidad inicial de compra
                $umbralCantidad = $item->cantidad * 0.15;
                if ($stockActual <= $umbralCantidad) {
                    $item->alerta = 'bajo stock';
                    $item->stockActual = $stockActual;
                    $item->umbralCantidad = $umbralCantidad;
                    return $item;
                }
            })
            ->filter(); // Filtra nulos (reactivos que no cumplen la condición de alerta)

        return view('alertas', [
            'reactivosProntosAVencer' => $reactivosProntosAVencer,
            'reactivosConPocaCantidad' => $reactivosConPocaCantidad,
        ]);
    }
}
