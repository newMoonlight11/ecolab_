<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovimientoRequest;
use App\Models\TipoMovimiento;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Movimiento::with(['tipoMovimientos']);

        if($request->filled('tipo_movimiento')) {
            $query->Where('tipo_movimiento', 'like', '%', $request->input('tipo_movimiento') . '%');
        }

        if($request->filled('fecha_movimiento')) {
            $query->Where('fecha_movimiento', 'like', '%', $request->input('fecha_movimiento') . '%');
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
        $tipoMovimientos = TipoMovimiento::all();

        return view('movimiento.create', compact('movimiento', 'tipoMovimientos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovimientoRequest $request): RedirectResponse
    {
        Movimiento::create($request->validated());

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $movimiento = Movimiento::with(['tipoMovimientos'])->find($id);

        if ($movimiento){
            return response()->json(['error' => 'Movimiento no encontrado'], 404);
        }

        return response()->json($movimiento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $movimiento = Movimiento::find($id);
        $tipoMovimientos = TipoMovimiento::all();

        return view('movimiento.edit', compact('movimiento', 'tipoMovimientos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovimientoRequest $request, Movimiento $movimiento): RedirectResponse
    {
        $movimiento->update($request->validated());

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento actualizado satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Movimiento::find($id)->delete();

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento eliminado satisfactoriamente');
    }
}
