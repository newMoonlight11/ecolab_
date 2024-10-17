<?php

namespace App\Http\Controllers;

use App\Models\Residuo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResiduoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $residuos = Residuo::paginate();

        return view('residuo.index', compact('residuos'))
            ->with('i', ($request->input('page', 1) - 1) * $residuos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $residuo = new Residuo();

        return view('residuo.create', compact('residuo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResiduoRequest $request): RedirectResponse
    {
        Residuo::create($request->validated());

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $residuo = Residuo::find($id);

        return view('residuo.show', compact('residuo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $residuo = Residuo::find($id);

        return view('residuo.edit', compact('residuo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResiduoRequest $request, Residuo $residuo): RedirectResponse
    {
        $residuo->update($request->validated());

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Residuo::find($id)->delete();

        return Redirect::route('residuos.index')
            ->with('success', 'Residuo deleted successfully');
    }
}
