<?php

namespace App\Http\Controllers;

use App\Models\Residuo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResiduoRequest;
use App\Models\ClaseResiduo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Residuo::with(['claseResiduo']);

        // Aplica los filtros si están presentes en la solicitud
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        $residuos = $query->paginate(10);
        return view('residuo.index', compact('residuos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $residuo = new Residuo();
        $claseResiduos = ClaseResiduo::all();

        return view('residuo.create', compact('residuo', 'claseResiduos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResiduoRequest $request): RedirectResponse
    {
        Residuo::create($request->validated());

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $residuo = Residuo::with(['claseResiduo'])->find($id);

        if (!$residuo) {
            return response()->json(['error' => 'Residuo no encontrado'], 404);
        }

        // Devolver el reactivo con las relaciones al front-end (JSON)
        return response()->json($residuo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $residuo = Residuo::find($id);
        $claseResiduos = ClaseResiduo::all();

        return view('residuo.edit', compact('residuo', 'claseResiduos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResiduoRequest $request, Residuo $residuo): RedirectResponse
    {
        $residuo->update($request->validated());

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo actualizado satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Residuo::find($id)->delete();

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo eliminado satisfactoriamente');
    }
}
