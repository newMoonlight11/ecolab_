<?php

namespace App\Http\Controllers;

use App\Enums\TipoMovimiento as EnumsTipoMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovimientoRequest;
use App\Models\Laboratorio;
use App\Models\Reactivo;
use App\Models\StockReactivo;
use App\Models\TipoMovimiento;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Movimiento::with(['tipoMovimiento', 'user']);

        if ($request->filled('tipo_movimiento')) {
            $query->whereHas('tipoMovimiento', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('tipo_movimiento') . '%');
            });
        }

        if ($request->filled('usuario_id')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('usuario_id') . '%');
            });
        }

        if ($request->filled('fecha_movimiento')) {
            $query->where('fecha_movimiento', 'like', '%' . $request->input('fecha_movimiento') . '%');
        }

        $movimientos = $query->paginate(10);

        return view('movimiento.index', compact('movimientos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $movimiento = new Movimiento();
        $tipoMovimientos = EnumsTipoMovimiento::cases();

        // dd($tipoMovimientos);
        $users = User::all();

        return view('movimiento.create', compact('movimiento', 'tipoMovimientos', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovimientoRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        Log::info('Validated Data:', $validatedData);
        $validatedData['usuario_id'] = Auth::id();
        $validatedData['estado'] = 'sin asignar';

        $movimiento =  Movimiento::create($validatedData);
        return Redirect::route('movimientos.show', $movimiento->id)
            ->with('success', 'Se ha registrado el movimiento satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movimiento = Movimiento::with(['tipoMovimiento', 'items.reactivo', 'user'])->find($id);
        $tipoMovimientos = EnumsTipoMovimiento::fromId($movimiento->tipo_movimiento);
        $users = User::all();
        $reactivos = Reactivo::all();
        $laboratorios = Laboratorio::all();
        $unidads = Unidad::all();

        if (!$movimiento) {
            return response()->json(['error' => 'Movimiento no encontrado'], 404);
        }

        if (request()->wantsJson()) {
            return response()->json($movimiento);
        }

        return view('movimiento.show', compact('movimiento', 'tipoMovimientos', 'users', 'reactivos', 'laboratorios', 'unidads'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $movimiento = Movimiento::find($id);
        $tipoMovimientos = TipoMovimiento::all();
        $users = User::all();

        return view('movimiento.edit', compact('movimiento', 'tipoMovimientos', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovimientoRequest $request, Movimiento $movimiento): RedirectResponse
    {
        $movimiento->update($request->validated());

        return Redirect::route('movimientos.index')
            ->with('success', 'Se ha actualizado el movimiento satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        //dd("delete de moviento");
        Movimiento::find($id)->delete();

        return Redirect::route('movimientos.index')
            ->with('success', 'Se ha eliminado el movimiento satisfactoriamente');
    }

    public function asignar($id): JsonResponse
    {
        // Obtener el movimiento con sus relaciones de ítems
        $movimiento = Movimiento::with('items')->find($id);

        // Verificar que el movimiento existe
        if (!$movimiento) {
            return response()->json(['error' => 'Movimiento no encontrado'], 404);
        }

        // Verificar que todos los campos del movimiento estén completos
        if (!$movimiento->fecha_movimiento || !$movimiento->descripcion || !$movimiento->tipo_movimiento || !$movimiento->usuario_id) {
            return response()->json(['error' => 'Todos los campos del movimiento deben estar completos'], 422);
        }

        // Verificar que el movimiento tenga al menos un ítem
        if ($movimiento->items->isEmpty()) {
            return response()->json(['error' => 'El movimiento debe tener al menos un ítem relacionado'], 422);
        }


        // Actualizar el stock de cada reactivo relacionado con los ítems del movimiento
        foreach ($movimiento->items as $item) {
            $stockReactivo = StockReactivo::firstOrCreate(
                [
                    'reactivo_id' => $item->reactivo_id,
                    'laboratorio_id' => $item->laboratorio_id,
                    'unidad_id' => $item->unidad_id
                ],
                ['cantidad_existencia' => 0, 'fecha_stock' => now()]
            );

            if ($movimiento->tipo_movimiento == EnumsTipoMovimiento::COMPRA->getId()) {
                $stockReactivo->increment('cantidad_existencia', $item->cantidad);
            } elseif ($movimiento->tipo_movimiento == EnumsTipoMovimiento::PRESTAMO->getId()) {
                if ($stockReactivo->cantidad_existencia >= $item->cantidad) {
                    $stockReactivo->decrement('cantidad_existencia', $item->cantidad);
                } else {
                    return response()->json(['error' => 'Cantidad insuficiente en stock para realizar el préstamo'], 422);
                }
            }
        }
        // Actualizar el estado a "asignado"
        $movimiento->update(['estado' => 'asignado']);

        return response()->json(['success' => 'Movimiento asignado y stock actualizado'], 200);
    }

    public function asignarTodosSinAsignar(): JsonResponse
    {
        $movimientos = Movimiento::where('estado', 'sin asignar')->with('items')->get();

        foreach ($movimientos as $movimiento) {
            // Verificar campos del movimiento
            if (!$movimiento->fecha_movimiento || !$movimiento->descripcion || !$movimiento->tipo_movimiento || !$movimiento->usuario_id) {
                continue; // Ignorar movimientos incompletos
            }

            // Verificar que el movimiento tenga al menos un ítem
            if ($movimiento->items->isEmpty()) {
                continue; // Ignorar movimientos sin ítems
            }

            // Actualizar el stock para cada ítem en el movimiento
            foreach ($movimiento->items as $item) {
                $stockReactivo = StockReactivo::firstOrCreate(
                    [
                        'reactivo_id' => $item->reactivo_id,
                        'laboratorio_id' => $item->laboratorio_id,
                        'unidad_id' => $item->unidad_id
                    ],
                    ['cantidad_existencia' => 0, 'fecha_stock' => now()]
                );

                if ($movimiento->tipo_movimiento == EnumsTipoMovimiento::COMPRA->getId()) {
                    $stockReactivo->increment('cantidad_existencia', $item->cantidad);
                } elseif ($movimiento->tipo_movimiento == EnumsTipoMovimiento::PRESTAMO->getId()) {
                    if ($stockReactivo->cantidad_existencia >= $item->cantidad) {
                        $stockReactivo->decrement('cantidad_existencia', $item->cantidad);
                    } else {
                        return response()->json(['error' => 'Cantidad insuficiente en stock para el préstamo de un movimiento'], 422);
                    }
                }
            }

            // Actualizar el estado a "asignado" para el movimiento
            $movimiento->update(['estado' => 'asignado']);
        }

        return response()->json(['success' => 'Movimientos asignados y stock actualizado'], 200);
    }
}
