<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PrestamoRequest;
use App\Models\Laboratorio;
use App\Models\Reactivo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Prestamo::with(['laboratorio', 'reactivo', 'unidad']);
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

        if ($request->filled('fecha')) {
            $query->where('fecha', 'like', '%' . $request->input('fecha') . '%');
        }

        if ($request->filled('cantidad')) {
            $query->where('cantidad', 'like', '%' . $request->input('cantidad') . '%');
        }
        
        $prestamos = $query->paginate(10);
        return view('prestamo.index', compact('prestamos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $prestamo = new Prestamo();
        $laboratorios = Laboratorio::all();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();

        return view('prestamo.create', compact('prestamo', 'laboratorios', 'reactivos', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestamoRequest $request): RedirectResponse
    {
        Prestamo::create($request->validated());

        return redirect()->back()->with('success', 'Préstamo solicitado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::with(['laboratorio', 'reactivo', 'unidad'])->find($id);
        if(!$prestamo){
            return response()->json(['error' => 'Préstamo no encontrado'], 404);
        }
        return response()->json($prestamo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $prestamo = Prestamo::find($id);
        $laboratorios = Laboratorio::all();
        $reactivos = Reactivo::all();
        $unidads = Unidad::all();

        return view('prestamo.edit', compact('prestamo', 'laboratorios', 'reactivos', 'unidads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestamoRequest $request, Prestamo $prestamo): RedirectResponse
    {
        $prestamo->update($request->validated());

        return Redirect::route('prestamos.index')
            ->with('success', 'Se ha actualizado préstamos satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Prestamo::find($id)->delete();

        return Redirect::route('prestamos.index')
            ->with('success', 'Se ha eliminado el préstamo satisfactoriamente');
    }
}
