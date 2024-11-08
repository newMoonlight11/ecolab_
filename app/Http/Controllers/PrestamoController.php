<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PrestamoRequest;
use App\Models\ItemMovimiento;
use App\Models\Laboratorio;
use App\Models\Movimiento;
use App\Models\Reactivo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Enums\TipoMovimiento as EnumsTipoMovimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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

        // $stocks = Reactivo::whereHas('stocks', function ($query) {
        //     $query->where('cantidad_existencia', '>', 0);
        // })->get();

        return view('prestamo.create', compact('prestamo', 'laboratorios', 'reactivos', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(PrestamoRequest $request): RedirectResponse
    // {
    //     Prestamo::create($request->validated());

    //     return redirect()->back()->with('success', 'Préstamo solicitado exitosamente.');
    // }
    public function store(PrestamoRequest $request): RedirectResponse
    {
        $reactivoId = $request->input('reactivo_id');
        $unidadId = $request->input('unidad_id');
        $laboratorioId = $request->input('laboratorio_id');
        $cantidadSolicitada = $request->input('cantidad');
        $fechaPrestamo = $request->input('fecha');
        $userId = Auth::id();

        $item = ItemMovimiento::where('reactivo_id', $reactivoId)
            ->where('unidad_id', $unidadId)
            ->where('laboratorio_id', $laboratorioId)
            ->first();

        // Verifica si el reactivo tiene suficiente cantidad en stock
        if (!$item || $item->cantidad < $cantidadSolicitada) {
            return redirect()->back()->withErrors(['cantidad' => 'Cantidad insuficiente en stock o reactivo no disponible.']);
        }

        // Registra el préstamo
        Prestamo::create($request->validated());

        $movimiento = Movimiento::create([
            'fecha_movimiento' => $fechaPrestamo,
            'descripcion' => 'Préstamo solicitado por usuario general',
            'tipo_movimiento' => EnumsTipoMovimiento::PRESTAMO->getId(),
            'usuario_id' => $userId, // Asume que el usuario general tiene el ID 1, o usa el ID autenticado
            'estado' => 'sin asignar', // Puedes ajustar el estado según sea necesario
        ]);

        ItemMovimiento::create([
            'cantidad' => $cantidadSolicitada,
            'ubicacion' => $item->ubicacion, // Asume que se usa la misma ubicación del stock actual
            'codigoUNAB' => $item->codigoUNAB, // O asigna algún valor si es necesario
            'fechaVencimiento' => $item->fechaVencimiento, // Asume que usa la misma fecha
            'reactivo_id' => $reactivoId,
            'movimiento_id' => $movimiento->id, // Relaciona con el movimiento creado
            'laboratorio_id' => $laboratorioId,
            'unidad_id' => $unidadId,
        ]);

        // Redirige con un mensaje de éxito
        return redirect()->back()->with('success', 'Préstamo solicitado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::with(['laboratorio', 'reactivo', 'unidad'])->find($id);
        if (!$prestamo) {
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
        //dd($prestamo);

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
