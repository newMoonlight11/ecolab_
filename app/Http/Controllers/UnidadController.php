<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UnidadRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Unidad::query();

        // Aplica los filtros si están presentes en la solicitud
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        // Paginación de los resultados de la consulta filtrada
        $unidads = $query->paginate(10);

        return view('unidad.index', compact('unidads'))
            ->with('i', ($request->input('page', 1) - 1) * $unidads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $unidad = new Unidad();

        return view('unidad.create', compact('unidad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnidadRequest $request): RedirectResponse
    {
        Unidad::create($request->validated());

        return Redirect::route('unidads.index')
            ->with('success', 'Se ha registrado la unidad satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $unidad = Unidad::find($id);

        return view('unidad.show', compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $unidad = Unidad::find($id);

        return view('unidad.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnidadRequest $request, Unidad $unidad): RedirectResponse
    {
        $unidad->update($request->validated());

        return Redirect::route('unidads.index')
            ->with('success', 'Se ha actualizado la unidad satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Unidad::find($id)->delete();

        return Redirect::route('unidads.index')
            ->with('success', 'Se ha eliminado la unidad satisfactoriamente');
    }
}
