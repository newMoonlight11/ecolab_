<?php

namespace App\Http\Controllers;

use App\Models\Reactivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReactivoRequest;
use App\Models\Familia;
use App\Models\Marca;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Reactivo::with(['familia', 'marca']);

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->filled('numero_cas')) {
            $query->where('numero_cas', 'like', '%' . $request->input('numero_cas') . '%');
        }

        if ($request->filled('referencia_fabricante')) {
            $query->where('referencia_fabricante', 'like', '%' . $request->input('referencia_fabricante') . '%');
        }

        if ($request->filled('lote')) {
            $query->where('lote', 'like', '%' . $request->input('lote') . '%');
        }

        if ($request->filled('num_registro_invima')) {
            $query->where('num_registro_invima', 'like', '%' . $request->input('num_registro_invima') . '%');
        }

        $reactivos = $query->paginate(10);

        return view('reactivo.index', compact('reactivos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reactivo = new Reactivo();
        $familias = Familia::all();
        $marcas = Marca::all();

        return view('reactivo.create', compact('reactivo', 'familias', 'marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReactivoRequest $request): RedirectResponse
    {
        Reactivo::create($request->validated());

        return Redirect::route('reactivos.index')
            ->with('success', 'Se ha registrado el reactivo satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reactivo = Reactivo::with(['familia', 'marca'])->find($id);
        //$reactivo = Reactivo::find($id);

        if (!$reactivo) {
            return response()->json(['error' => 'Reactivo no encontrado'], 404);
        }

        // Devolver el reactivo con las relaciones al front-end (JSON)
        return response()->json($reactivo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reactivo = Reactivo::find($id);
        $familias = Familia::all();
        $marcas = Marca::all();

        return view('reactivo.edit', compact('reactivo', 'familias', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReactivoRequest $request, Reactivo $reactivo): RedirectResponse
    {
        $reactivo->update($request->validated());

        return Redirect::route('reactivos.index')
            ->with('success', 'Se ha actualizado el reactivo satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Reactivo::find($id)->delete();

        return Redirect::route('reactivos.index')
            ->with('success', 'Se ha eliminado el reactivo satisfactoriamente');
    }
}
