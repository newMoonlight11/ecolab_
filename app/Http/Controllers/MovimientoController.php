<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovimientoRequest;
use App\Models\TipoMovimiento;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Movimiento::with(['tipoMovimiento', 'user']);

        $movimientos = $query->paginate(10);
        return view('movimiento.index', compact('movimientos'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $movimiento = new Movimiento();
        $tipoMovimiento = TipoMovimiento::all();
        $user = User::all();

        return view('movimiento.create', compact('movimiento', 'tipoMovimiento', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovimientoRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        Log::info('Validated Data:', $validatedData);
        // Asignar el ID del usuario autenticado de manera segura
        $validatedData['usuario_id'] = Auth::id();

        // Crear el movimiento con los datos validados
        Movimiento::create($validatedData);
        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $movimiento = Movimiento::find($id);

        return view('movimiento.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $movimiento = Movimiento::find($id);
        $tipoMovimiento = TipoMovimiento::all();
        $user = User::all();

        return view('movimiento.edit', compact('movimiento', 'tipoMovimiento', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovimientoRequest $request, Movimiento $movimiento): RedirectResponse
    {
        $movimiento->update($request->validated());

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Movimiento::find($id)->delete();

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento deleted successfully');
    }
}
