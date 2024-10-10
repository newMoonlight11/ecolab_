<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $roles = Role::paginate();

        return view('role.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $role = new Role();
        $permissions = Permission::all();

        return view('role.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {


        $role =  Role::create($request->validated());

        // Asignar los permisos al rol, si se seleccionaron
        if (!empty($request->get('permissions'))) {
            $role->syncPermissions($request->permissions); // Asigna los permisos seleccionados
        }

        return Redirect::route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $role = Role::find($id);

        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validated());
        // Asignar los permisos al rol, si se seleccionaron
        if (!empty($request->get('permissions'))) {
            $role->syncPermissions($request->permissions); // Asigna los permisos seleccionados
        }

        return Redirect::route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Role::find($id)->delete();

        return Redirect::route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
