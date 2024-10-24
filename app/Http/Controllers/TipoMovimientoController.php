<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoMovimientoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = TipoMovimiento::query();

        // Aplica los filtros si están presentes en la solicitud
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        // Paginación de los resultados de la consulta filtrada
        $tipoMovimientos = $query->paginate(10);

        return view('tipo-movimiento.index', compact('tipoMovimientos'))
            ->with('i', ($request->input('page', 1) - 1) * $tipoMovimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoMovimiento = new TipoMovimiento();

        return view('tipo-movimiento.create', compact('tipoMovimiento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoMovimientoRequest $request): RedirectResponse
    {
        TipoMovimiento::create($request->validated());

        return Redirect::route('tipo_movimiento.index')
            ->with('success', 'Se ha registrado el tipo de movimiento satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoMovimiento = TipoMovimiento::find($id);

        return view('tipo-movimiento.show', compact('tipoMovimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoMovimiento = TipoMovimiento::find($id);

        return view('tipo-movimiento.edit', compact('tipoMovimiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoMovimientoRequest $request, TipoMovimiento $tipoMovimiento): RedirectResponse
    {
        $tipoMovimiento->update($request->validated());

        return Redirect::route('tipo_movimiento.index')
            ->with('success', 'Se ha actualizado el tipo de movimiento satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        TipoMovimiento::find($id)->delete();

        return Redirect::route('tipo_movimiento.index')
            ->with('success', 'Se ha eliminado el tipo de movimiento satisfactoriamente');
    }
}
