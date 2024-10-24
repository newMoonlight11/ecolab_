<?php

namespace App\Http\Controllers;

use App\Models\StockReactivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StockReactivoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StockReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $stockReactivos = StockReactivo::paginate();

        return view('stock-reactivo.index', compact('stockReactivos'))
            ->with('i', ($request->input('page', 1) - 1) * $stockReactivos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $stockReactivo = new StockReactivo();

        return view('stock-reactivo.create', compact('stockReactivo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockReactivoRequest $request): RedirectResponse
    {
        StockReactivo::create($request->validated());

        return Redirect::route('stock_reactivos.index')
            ->with('success', 'Se ha registrado el stock de reactivo satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $stockReactivo = StockReactivo::find($id);

        return view('stock-reactivo.show', compact('stockReactivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $stockReactivo = StockReactivo::find($id);

        return view('stock-reactivo.edit', compact('stockReactivo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockReactivoRequest $request, StockReactivo $stockReactivo): RedirectResponse
    {
        $stockReactivo->update($request->validated());

        return Redirect::route('stock_reactivos.index')
            ->with('success', 'Se ha actualizado el stock de reactivo satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        StockReactivo::find($id)->delete();

        return Redirect::route('stock_reactivos.index')
            ->with('success', 'Se ha eliminado el stock de reactivo satisfactoriamente');
    }
}
