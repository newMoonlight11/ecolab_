<?php

namespace App\Http\Controllers;

use App\Models\Reactivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReactivoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Reactivo::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->filled('fecha_vencimiento')) {
            $query->whereDate('fecha_vencimiento', $request->input('fecha_vencimiento'));
        }

        if ($request->filled('cantidad')) {
            $query->where('cantidad', $request->input('cantidad'));
        }

        if ($request->filled('laboratorio')) {
            $query->where('laboratorio', 'like', '%' . $request->input('laboratorio') . '%');
        }

        if ($request->filled('familia')) {
            $query->where('familia', 'like', '%' . $request->input('familia') . '%');
        }
        
        $reactivos = Reactivo::paginate(10);

        return view('reactivo.index', compact('reactivos'))
            ->with('i', ($request->input('page', 1) - 1) * $reactivos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reactivo = new Reactivo();

        return view('reactivo.create', compact('reactivo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReactivoRequest $request): RedirectResponse
    {
        Reactivo::create($request->validated());

        return Redirect::route('reactivos.index')
            ->with('success', 'Reactivo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reactivo = Reactivo::find($id);

        return view('reactivo.show', compact('reactivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reactivo = Reactivo::find($id);

        return view('reactivo.edit', compact('reactivo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReactivoRequest $request, Reactivo $reactivo): RedirectResponse
    {
        $reactivo->update($request->validated());

        return Redirect::route('reactivos.index')
            ->with('success', 'Reactivo updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Reactivo::find($id)->delete();

        return Redirect::route('reactivos.index')
            ->with('success', 'Reactivo deleted successfully');
    }
}
