<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LaboratorioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $laboratorios = Laboratorio::paginate();

        return view('laboratorio.index', compact('laboratorios'))
            ->with('i', ($request->input('page', 1) - 1) * $laboratorios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $laboratorio = new Laboratorio();

        return view('laboratorio.create', compact('laboratorio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratorioRequest $request): RedirectResponse
    {
        Laboratorio::create($request->validated());

        return Redirect::route('laboratorios.index')
            ->with('success', 'Laboratorio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $laboratorio = Laboratorio::find($id);

        return view('laboratorio.show', compact('laboratorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $laboratorio = Laboratorio::find($id);

        return view('laboratorio.edit', compact('laboratorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaboratorioRequest $request, Laboratorio $laboratorio): RedirectResponse
    {
        $laboratorio->update($request->validated());

        return Redirect::route('laboratorios.index')
            ->with('success', 'Laboratorio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Laboratorio::find($id)->delete();

        return Redirect::route('laboratorios.index')
            ->with('success', 'Laboratorio deleted successfully');
    }
}
