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
        $hoy = Carbon::now();

        // Reactivos que están a 15 días o menos de caducar, agrupados por `reactivo_id` para evitar duplicados
        $reactivosProntosAVencer = ItemMovimiento::with('laboratorio')  // Cargar la relación con laboratorio
            ->whereDate('fechaVencimiento', '<=', $hoy->copy()->addDays(15))
            ->groupBy('reactivo_id') // Agrupar por reactivo_id para evitar duplicados
            ->select('reactivo_id', DB::raw('MIN("fechaVencimiento") as "fechaVencimiento"')) // Seleccionar la fecha más cercana a caducar
            ->get()
            ->map(function ($reactivo) use ($hoy) {
                // Calcular los días restantes
                $diasRestantes = Carbon::parse($reactivo->fechaVencimiento)->diffInDays($hoy, false);

                // Definir alerta según los días restantes y asignar una prioridad para ordenar
                if ($diasRestantes <= 0) {
                    $reactivo->alerta = 'negro';
                    $reactivo->prioridad = 4;
                    $reactivo->diasRestantes = 'Vencido';
                } elseif ($diasRestantes >= 1 && $diasRestantes <= 5) {
                    $reactivo->alerta = 'rojo';
                    $reactivo->prioridad = 1;
                    $reactivo->diasRestantes = $diasRestantes;
                } elseif ($diasRestantes >= 6 && $diasRestantes <= 10) {
                    $reactivo->alerta = 'naranja';
                    $reactivo->prioridad = 2;
                    $reactivo->diasRestantes = $diasRestantes;
                } elseif ($diasRestantes >= 11 && $diasRestantes <= 15) {
                    $reactivo->alerta = 'amarillo';
                    $reactivo->prioridad = 3;
                    $reactivo->diasRestantes = $diasRestantes;
                } else {
                    $reactivo->alerta = 'sin alerta';
                    $reactivo->diasRestantes = $diasRestantes;
                }

                return $reactivo;
            })
            ->filter(fn($reactivo) => $reactivo->alerta !== 'sin alerta') // Filtrar los que no tienen alerta
            ->sortBy(['prioridad', 'diasRestantes']); // Ordenar por prioridad y días restantes

        return view('alertas', [
            'reactivosProntosAVencer' => $reactivosProntosAVencer,
        ]);
    }
}
