<?php

namespace App\Http\Controllers;

use App\Models\ItemMovimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ItemMovimientoRequest;
use App\Models\Movimiento;
use App\Models\Reactivo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ItemMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = ItemMovimiento::with(['reactivo', 'movimiento']);
        
        if ($request->filled('cantidad')) {
            $query->where('cantidad', 'like', '%' . $request->input('cantidad') . '%');
        }

        if ($request->filled('reactivo_id')) {
            $query->where('reactivo_id', 'like', '%' . $request->input('reactivo_id') . '%');
        }

        if ($request->filled('movimiento_id')) {
            $query->where('movimiento_id', 'like', '%' . $request->input('movimiento_id') . '%');
        }

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
        $reactivos = Reactivo::all();
        $movimientos = Movimiento::all();

        return view('item-movimiento.create', compact('itemMovimiento', 'reactivos', 'movimientos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemMovimientoRequest $request): RedirectResponse
    {
        ItemMovimiento::create($request->validated());

        return Redirect::route('item_movimiento.index')
            ->with('success', 'Item de movimiento creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $itemMovimiento = ItemMovimiento::with(['reactivo', 'movimiento'])->find($id);
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
        $reactivos = Reactivo::all();
        $movimientos = Movimiento::all();

        return view('item-movimiento.edit', compact('itemMovimiento', 'reactivos', 'movimientos'));
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
        ItemMovimiento::find($id)->delete();

        return Redirect::route('item_movimiento.index')
            ->with('success', 'Item de movimiento eliminado satisfactoriamente');
    }
}
