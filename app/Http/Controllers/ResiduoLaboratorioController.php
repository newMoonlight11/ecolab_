<?php

namespace App\Http\Controllers;

use App\Models\ResiduoLaboratorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResiduoLaboratorioRequest;
use App\Models\Laboratorio;
use App\Models\Residuo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResiduoLaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = ResiduoLaboratorio::with(['laboratorio', 'unidad']);
        
        if ($request->filled('fecha_stock')) {
            $query->where('fecha_stock', 'like', '%' . $request->input('fecha_stock') . '%');
        }

        if ($request->filled('cantidad_existencia')) {
            $query->where('cantidad_existencia', 'like', '%' . $request->input('cantidad_existencia') . '%');
        }

        if ($request->filled('residuo_id')) {
            $query->where('residuo_id', 'like', '%' . $request->input('residuo_id') . '%');
        }

        if ($request->filled('laboratorio_id')) {
            $query->where('laboratorio_id', 'like', '%' . $request->input('laboratorio_id') . '%');
        }

        $residuoLaboratorios = $query->paginate(10);

        return view('residuo-laboratorio.index', compact('residuoLaboratorios'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $residuoLaboratorio = new ResiduoLaboratorio();
        $residuos = Residuo::all();
        $laboratorios = Laboratorio::all();
        $unidads = Unidad::all();

        return view('residuo-laboratorio.create', compact('residuoLaboratorio', 'residuos', 'laboratorios', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResiduoLaboratorioRequest $request): RedirectResponse
    {
        ResiduoLaboratorio::create($request->validated());

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'Stock de residuo creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $residuoLaboratorio = ResiduoLaboratorio::with(['residuo', 'laboratorio', 'unidad'])->find($id);
        //$reactivo = Reactivo::find($id);

        if (!$residuoLaboratorio) {
            return response()->json(['error' => 'Stock de residuo no encontrado'], 404);
        }

        // Devolver el reactivo con las relaciones al front-end (JSON)
        return response()->json($residuoLaboratorio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $residuoLaboratorio = ResiduoLaboratorio::find($id);
        $residuos = Residuo::all();
        $laboratorios = Laboratorio::all();
        $unidads = Unidad::all();

        return view('residuo-laboratorio.edit', compact('residuoLaboratorio', 'residuos', 'laboratorios', 'unidads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResiduoLaboratorioRequest $request, ResiduoLaboratorio $residuoLaboratorio): RedirectResponse
    {
        $residuoLaboratorio->update($request->validated());

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'Stock de residuo actualizado satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        ResiduoLaboratorio::find($id)->delete();

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'Stock de residuo eliminado satisfactoriamente');
    }
}
