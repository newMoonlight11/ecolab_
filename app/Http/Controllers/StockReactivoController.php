<?php

namespace App\Http\Controllers;

use App\Models\StockReactivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StockReactivoRequest;
use App\Models\Laboratorio;
use App\Models\Reactivo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\TipoMovimiento as EnumsTipoMovimiento;

class StockReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = StockReactivo::with(['reactivo', 'laboratorio', 'unidad']);

        if ($request->filled('reactivo_id')) {
            $query->whereHas('reactivo', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('reactivo_id') . '%');
            });
        }

        if ($request->filled('laboratorio_id')) {
            $query->whereHas('laboratorio', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('laboratorio_id') . '%');
            });
        }

        if ($request->filled('fecha_stock')) {
            $query->where('fecha_stock', 'like', '%' . $request->input('fecha_stock') . '%');
        }

        if ($request->filled('cantidad_existencia')) {
            $query->where('cantidad_existencia', 'like', '%' . $request->input('cantidad_existencia') . '%');
        }

        $reactivosPaginated = $query->paginate(10);

        return view('stock-reactivo.index', compact('reactivosPaginated'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $stockReactivo = new StockReactivo();
        $laboratorios = Laboratorio::all();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();

        return view('stock-reactivo.create', compact('stockReactivo', 'laboratorios', 'reactivos', 'unidads'));
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
    public function show($id)
    {
        $stockReactivo = StockReactivo::with(['laboratorio', 'reactivo', 'unidad'])->find($id);

        if (!$stockReactivo) {
            return response()->json(['error' => 'Stock de reactivo no encontrado'], 404);
        }
        return response()->json($stockReactivo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $stockReactivo = StockReactivo::find($id);
        $laboratorios = Laboratorio::all();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();

        return view('stock-reactivo.edit', compact('stockReactivo', 'laboratorios', 'reactivos', 'unidads'));
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
