<?php

namespace App\Http\Controllers;

use App\Models\ResiduoLaboratorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResiduoLaboratorioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResiduoLaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $residuoLaboratorios = ResiduoLaboratorio::paginate();

        return view('residuo-laboratorio.index', compact('residuoLaboratorios'))
            ->with('i', ($request->input('page', 1) - 1) * $residuoLaboratorios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $residuoLaboratorio = new ResiduoLaboratorio();

        return view('residuo-laboratorio.create', compact('residuoLaboratorio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResiduoLaboratorioRequest $request): RedirectResponse
    {
        ResiduoLaboratorio::create($request->validated());

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'ResiduoLaboratorio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $residuoLaboratorio = ResiduoLaboratorio::find($id);

        return view('residuo-laboratorio.show', compact('residuoLaboratorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $residuoLaboratorio = ResiduoLaboratorio::find($id);

        return view('residuo-laboratorio.edit', compact('residuoLaboratorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResiduoLaboratorioRequest $request, ResiduoLaboratorio $residuoLaboratorio): RedirectResponse
    {
        $residuoLaboratorio->update($request->validated());

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'ResiduoLaboratorio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ResiduoLaboratorio::find($id)->delete();

        return Redirect::route('residuo-laboratorios.index')
            ->with('success', 'ResiduoLaboratorio deleted successfully');
    }
}
