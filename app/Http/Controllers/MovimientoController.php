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

        if ($request->filled('tipo_movimiento')) {
            $query->Where('tipo_movimiento', 'like', '%', $request->input('tipo_movimiento') . '%');
        }

        if ($request->filled('fecha_movimiento')) {
            $query->Where('fecha_movimiento', 'like', '%', $request->input('fecha_movimiento') . '%');
        }

        if ($request->filled('usuario_id')) {
            $query->Where('usuario_id', 'like', '%', $request->input('usuario_id') . '%');
        }

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
        $tipoMovimientos = TipoMovimiento::all();
        $users = User::all();

        return view('movimiento.create', compact('movimiento', 'tipoMovimientos', 'users'));
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
    public function show($id)
    {
        $movimiento = Movimiento::with(['tipoMovimiento'])->find($id);

        if (!$movimiento) {
            return response()->json(['error' => 'Movimiento no encontrado'], 404);
        }

        return response()->json($movimiento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $movimiento = Movimiento::find($id);
        $tipoMovimientos = TipoMovimiento::all();
        $users = User::all();

        return view('movimiento.edit', compact('movimiento', 'tipoMovimientos', 'users'));
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
