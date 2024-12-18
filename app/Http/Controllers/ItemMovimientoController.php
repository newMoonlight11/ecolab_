<?php

namespace App\Http\Controllers;

use App\Models\ItemMovimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ItemMovimientoRequest;
use App\Models\Laboratorio;
use App\Models\Movimiento;
use App\Models\Reactivo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ItemMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = ItemMovimiento::with(['movimiento', 'reactivo', 'laboratorio', 'unidad']);

        // Filtro para cantidad
        if ($request->filled('cantidad')) {
            $query->where('cantidad', $request->input('cantidad'));
        }

        if ($request->filled('reactivo_id')) {
            $query->whereHas('reactivo', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('reactivo_id') . '%');
            });
        }

        // Filtro por nombre del movimiento con búsqueda parcial (LIKE)
        if ($request->filled('movimiento_id')) {
            $query->whereHas('movimiento', function ($q) use ($request) {
                $q->where('descripcion', 'like', '%' . $request->input('movimiento_id') . '%');
            });
        }

        // Filtro por nombre del reactivo con búsqueda parcial (LIKE)
        if ($request->filled('laboratorio_id')) {
            $query->whereHas('laboratorio', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('laboratorio_id') . '%');
            });
        }

        if ($request->filled('unidad_id')) {
            $query->whereHas('unidad', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('unidad_id') . '%');
            });
        }

        // Paginación de resultados
        $itemMovimientos = $query->paginate(10);

        return view('item-movimiento.index', compact('itemMovimientos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $itemMovimiento = new ItemMovimiento();
        $movimientos = Movimiento::where('estado', 'sin asignar')->get();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();
        $laboratorios = Laboratorio::all();

        return view('item-movimiento.create', compact('itemMovimiento', 'movimientos', 'reactivos', 'laboratorios', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemMovimientoRequest $request): RedirectResponse
    {
        // $item = ItemMovimiento::create($request->validated());

        // Cargar relaciones necesarias para devolver datos completos
        // $item->load('reactivo', 'laboratorio', 'unidad');

        

        // Si la solicitud es AJAX, devolver JSON para el modal
        // if ($request->ajax()) {
        //     return response()->json([
        //         'success' => true,
        //         'item' => [
        //             'id' => $item->id,
        //             'cantidad' => $item->cantidad,
        //             'ubicacion'=> $item->ubicacion ?? '',
        //             'codigoUNAB'=> $item->codigoUNAB ?? '',
        //             'fechaVencimiento'=> $item->fechaVencimiento ?? '',
        //             'reactivo' => [
        //                 'nombre' => $item->reactivo->nombre,
        //             ],
        //             'laboratorio' => [
        //                 'nombre' => $item->laboratorio->nombre,
        //             ],
        //             'unidad' => [
        //                 'nombre' => $item->unidad->nombre,
        //             ]
        //         ]
        //     ]);
        // }

        // // Si no es AJAX, redirigir como en una solicitud normal
        // return Redirect::route('item_movimiento.index')
        //     ->with('success', 'Item de movimiento creado satisfactoriamente');

        try {
            $item = ItemMovimiento::create($request->validated());
    
            // Cargar relaciones necesarias para devolver datos completos
            $item->load('reactivo', 'laboratorio', 'unidad');
    
            // Si la solicitud es AJAX, devolver JSON para el modal
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'item' => [
                        'id' => $item->id,
                        'cantidad' => $item->cantidad,
                        'ubicacion' => $item->ubicacion ?? '',
                        'codigoUNAB' => $item->codigoUNAB ?? '',
                        'fechaVencimiento' => $item->fechaVencimiento ?? '',
                        'reactivo' => [
                            'nombre' => $item->reactivo->nombre,
                        ],
                        'laboratorio' => [
                            'nombre' => $item->laboratorio->nombre,
                        ],
                        'unidad' => [
                            'nombre' => $item->unidad->nombre,
                        ]
                    ]
                ]);
            }
    
            // Si no es AJAX, redirigir como en una solicitud normal
            return Redirect::route('item_movimiento.index')
                ->with('success', 'Item de movimiento creado satisfactoriamente');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el ítem',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $itemMovimiento = ItemMovimiento::with(['reactivo', 'movimiento', 'laboratorio', 'unidad'])->find($id);
        //$reactivo = Reactivo::find($id);

        if (!$itemMovimiento) {
            return response()->json(['error' => 'Item de movimiento no encontrado'], 404);
        }

        // Devolver el reactivo con las relaciones al front-end (JSON)
        return response()->json($itemMovimiento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $itemMovimiento = ItemMovimiento::find($id);
        $movimientos = Movimiento::where('estado', 'sin asignar')->get();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();
        $laboratorios = Laboratorio::all();


        return view('item-movimiento.edit', compact('itemMovimiento', 'movimientos', 'reactivos', 'laboratorios', 'unidads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemMovimientoRequest $request, ItemMovimiento $itemMovimiento): RedirectResponse
    {
        $itemMovimiento->update($request->validated());

        return Redirect::route('item_movimiento.index')
            ->with('success', 'Item de movimiento actualizado satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        $item = ItemMovimiento::find($id);
        $idmovimiento = $item->movimiento->id;
        $item->delete();
        return Redirect::route('movimientos.show', $idmovimiento)
            ->with('success', 'Item de movimiento eliminado satisfactoriamente');
    }
}
