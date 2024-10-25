<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FamiliaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Familia::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        $familias = $query->paginate(10);

        return view('familia.index', compact('familias'))
            ->with('i', ($request->input('page', 1) - 1) * $familias->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $familia = new Familia();

        return view('familia.create', compact('familia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FamiliaRequest $request): RedirectResponse
    {
        Familia::create($request->validated());

        return Redirect::route('familias.index')
            ->with('success', 'Se ha registrado la familia satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $familia = Familia::find($id);

        return view('familia.show', compact('familia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $familia = Familia::find($id);

        return view('familia.edit', compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FamiliaRequest $request, Familia $familia): RedirectResponse
    {
        $familia->update($request->validated());

        return Redirect::route('familias.index')
            ->with('success', 'Se ha actualizado la familia satisfactoriamente');
    }

    public function destroy($id): RedirectResponse
    {
        Familia::find($id)->delete();

        return Redirect::route('familias.index')
            ->with('success', 'Se ha eliminado la familia satisfactoriamente');
    }
}
