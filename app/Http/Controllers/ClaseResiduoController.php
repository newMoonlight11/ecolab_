<?php

namespace App\Http\Controllers;

use App\Models\ClaseResiduo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClaseResiduoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClaseResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = ClaseResiduo::query();

        // Aplica los filtros si están presentes en la solicitud
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        // Paginación de los resultados de la consulta filtrada
        $claseResiduos = $query->paginate(10);

        return view('clase-residuo.index', compact('claseResiduos'))
            ->with('i', ($request->input('page', 1) - 1) * $claseResiduos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $claseResiduo = new ClaseResiduo();

        return view('clase-residuo.create', compact('claseResiduo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClaseResiduoRequest $request): RedirectResponse
    {
        ClaseResiduo::create($request->validated());

        return Redirect::route('clase-residuos.index')
            ->with('success', 'Se ha creado exitosamente la clase de residuos.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $claseResiduo = ClaseResiduo::find($id);

        return view('clase-residuo.show', compact('claseResiduo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $claseResiduo = ClaseResiduo::find($id);

        return view('clase-residuo.edit', compact('claseResiduo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaseResiduoRequest $request, ClaseResiduo $claseResiduo): RedirectResponse
    {
        $claseResiduo->update($request->validated());

        return Redirect::route('clase-residuos.index')
            ->with('success', 'Se ha actualizado exitosamente la clase de residuos');
    }

    public function destroy($id): RedirectResponse
    {
        ClaseResiduo::find($id)->delete();

        return Redirect::route('clase-residuos.index')
            ->with('success', 'Se ha eliminado exitosamente la clase de residuos');
    }
}
