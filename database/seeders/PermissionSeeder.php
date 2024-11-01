<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar permisos y roles previos
        // Permission::truncate();
        // Role::truncate();
        // Crear permisos específicos
        Permission::create(['name' => 'gestionar_usuarios', 'description' => 'Gestionar usuarios']);
        Permission::create(['name' => 'gestionar_roles', 'description' => 'Gestionar roles']);
        Permission::create(['name' => 'gestionar_reactivos', 'description' => 'Gestionar reactivos']);
        Permission::create(['name' => 'gestionar_clases_residuo', 'description' => 'Gestionar clases de residuos']);
        Permission::create(['name' => 'gestionar_familias', 'description' => 'Gestionar familias']);
        Permission::create(['name' => 'gestionar_movimientos', 'description' => 'Gestionar movimientos']);
        Permission::create(['name' => 'gestionar_items_movimiento', 'description' => 'Gestionar ítems de movimientos']);
        Permission::create(['name' => 'gestionar_laboratorios', 'description' => 'Gestionar laboratorios']);
        Permission::create(['name' => 'gestionar_marcas', 'description' => 'Gestionar marcas']);
        Permission::create(['name' => 'gestionar_residuos', 'description' => 'Gestionar residuos']);
        Permission::create(['name' => 'gestionar_stock_residuos', 'description' => 'Gestionar stock de residuos']);
        Permission::create(['name' => 'gestionar_stock_reactivos', 'description' => 'Gestionar stock de reactivos']);
        Permission::create(['name' => 'gestionar_tipos_movimiento', 'description' => 'Gestionar tipos de movimiento']);
        Permission::create(['name' => 'gestionar_unidades', 'description' => 'Gestionar unidades']);
        Permission::create(['name' => 'registrar_prestamo', 'description' => 'Registrar préstamos']);
        Permission::create(['name' => 'ver_prestamo', 'description' => 'Ver préstamos']);
        Permission::create(['name' => 'editar_prestamo', 'description' => 'Editar préstamos']);
        Permission::create(['name' => 'eliminar_prestamo', 'description' => 'Eliminar préstamos']);

        $adminRole = Role::create(['name' => 'admin']);
        $generalRole = Role::create(['name' => 'general']);

        // Asignar permisos al rol "admin"
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos específicos al rol "general"
        $generalRole->givePermissionTo(['registrar_prestamo']);
    }
}
