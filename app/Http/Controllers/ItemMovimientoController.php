<?php

namespace App\Http\Controllers;

use App\Models\ItemMovimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ItemMovimientoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ItemMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $itemMovimientos = ItemMovimiento::paginate();

        return view('item-movimiento.index', compact('itemMovimientos'))
            ->with('i', ($request->input('page', 1) - 1) * $itemMovimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $itemMovimiento = new ItemMovimiento();

        return view('item-movimiento.create', compact('itemMovimiento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemMovimientoRequest $request): RedirectResponse
    {
        ItemMovimiento::create($request->validated());

        return Redirect::route('item_movimiento.index')
            ->with('success', 'ItemMovimiento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $itemMovimiento = ItemMovimiento::find($id);

        return view('item-movimiento.show', compact('itemMovimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $itemMovimiento = ItemMovimiento::find($id);

        return view('item-movimiento.edit', compact('itemMovimiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemMovimientoRequest $request, ItemMovimiento $itemMovimiento): RedirectResponse
    {
        $itemMovimiento->update($request->validated());

        return Redirect::route('item_movimiento.index')
            ->with('success', 'ItemMovimiento updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ItemMovimiento::find($id)->delete();

        return Redirect::route('item_movimiento.index')
            ->with('success', 'ItemMovimiento deleted successfully');
    }
}
