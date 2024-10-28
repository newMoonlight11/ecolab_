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

class StockReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Consulta base con los filtros de búsqueda
        $query = Reactivo::with(['familia', 'marca', 'stockReactivos.laboratorio', 'stockReactivos.unidad']);

        if ($request->filled('reactivo_id')) {
            $query->where('id', $request->input('reactivo_id'));
        }

        if ($request->filled('laboratorio_id')) {
            $query->whereHas('stockReactivos.laboratorio', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('laboratorio_id') . '%');
            });
        }

        if ($request->filled('fecha_stock')) {
            $query->whereHas('stockReactivos', function ($q) use ($request) {
                $q->where('fecha_stock', 'like', '%' . $request->input('fecha_stock') . '%');
            });
        }

        if ($request->filled('cantidad_existencia')) {
            $query->whereHas('stockReactivos', function ($q) use ($request) {
                $q->where('cantidad_existencia', 'like', '%' . $request->input('cantidad_existencia') . '%');
            });
        }

        // Obtén los reactivos con los filtros aplicados
        $reactivos = $query->get()->map(function ($reactivo) {
            $movimientos = DB::table('movimientos')
                ->join('item_movimiento', 'movimientos.id', '=', 'item_movimiento.movimiento_id')
                ->select('movimientos.tipo_movimiento', 'item_movimiento.cantidad', 'movimientos.created_at as fecha')
                ->where('item_movimiento.reactivo_id', $reactivo->id)
                ->get();

            $cantidadExistente = 0;
            $ultimaFecha = null;

            foreach ($movimientos as $item) {
                switch ($item->tipo_movimiento) {
                    case 'préstamo':
                        $cantidadExistente -= $item->cantidad;
                        break;
                    case 'compra':
                    case 'devolución':
                        $cantidadExistente += $item->cantidad;
                        break;
                }
                $ultimaFecha = $item->fecha;
            }

            $reactivo->cantidad_existente = $cantidadExistente;
            $reactivo->ultima_fecha = $ultimaFecha;

            return $reactivo;
        });

        // Paginación manual
        $page = $request->input('page', 1);
        $perPage = 10;
        $reactivosPaginated = new LengthAwarePaginator(
            $reactivos->forPage($page, $perPage),
            $reactivos->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('stock-reactivo.index', compact('reactivosPaginated'))
            ->with('i', ($page - 1) * $perPage);
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
