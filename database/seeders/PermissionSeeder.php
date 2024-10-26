<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos específicos
        Permission::create(['name' => 'registrar_usuario', 'description' => 'Registrar usuario']);
        Permission::create(['name' => 'ver_usuarios', 'description' => 'Ver usuarios']);
        Permission::create(['name' => 'editar_usuario', 'description' => 'Editar usuarios']);
        Permission::create(['name' => 'eliminar_usuario', 'description' => 'Eliminar usuarios']);
        Permission::create(['name' => 'asignar_roles', 'description' => 'Asignar roles']);
        Permission::create(['name' => 'ver_roles', 'description' => 'Ver roles']);
        Permission::create(['name' => 'editar_roles', 'description' => 'Editar roles']);
        Permission::create(['name' => 'eliminar_roles', 'description' => 'Eliminar roles']);
        Permission::create(['name' => 'registrar_reactivo', 'description' => 'Registrar reactivos']);
        Permission::create(['name' => 'ver_reactivos', 'description' => 'Ver reactivos']);
        Permission::create(['name' => 'editar_reactivo', 'description' => 'Editar reactivo']);
        Permission::create(['name' => 'eliminar_reactivo', 'description' => 'Eliminar reactivos']);
        Permission::create(['name' => 'registrar_clase_residuo', 'description' => 'Registrar clases de residuos']);
        Permission::create(['name' => 'ver_clases_residuo', 'description' => 'Ver clases de residuos']);
        Permission::create(['name' => 'editar_clase_residuo', 'description' => 'Editar clases de residuos']);
        Permission::create(['name' => 'eliminar_clase_residuo', 'description' => 'Eliminar clases de residuos']);
        Permission::create(['name' => 'registrar_familia', 'description' => 'Registrar familias']);
        Permission::create(['name' => 'ver_familias', 'description' => 'Ver familias']);
        Permission::create(['name' => 'editar_familia', 'description' => 'Editar familias']);
        Permission::create(['name' => 'eliminar_familia', 'description' => 'Eliminar familias']);
        Permission::create(['name' => 'registrar_movimiento', 'description' => 'Registrar movimientos']);
        Permission::create(['name' => 'ver_movimientos', 'description' => 'Ver movimientos']);
        Permission::create(['name' => 'editar_movimiento', 'description' => 'Editar movimientos']);
        Permission::create(['name' => 'eliminar_movimiento', 'description' => 'Eliminar movimientos']);
        Permission::create(['name' => 'registrar_item_movimiento', 'description' => 'Registrar ítems de movimientos']);
        Permission::create(['name' => 'ver_items_movimiento', 'description' => 'Ver ítems de movimientos']);
        Permission::create(['name' => 'editar_item_movimiento', 'description' => 'Editar ítems de movimientos']);
        Permission::create(['name' => 'eliminar_item_movimiento', 'description' => 'Eliminar ítems de movimientos']);
        Permission::create(['name' => 'registrar_laboratorio', 'description' => 'Registrar laboratorios']);
        Permission::create(['name' => 'ver_laboratorios', 'description' => 'Ver laboratorios']);
        Permission::create(['name' => 'editar_laboratorio', 'description' => 'Editar laboratorios']);
        Permission::create(['name' => 'eliminar_laboratorio', 'description' => 'Eliminar laboratorios']);
        Permission::create(['name' => 'registrar_marca', 'description' => 'Registrar marcas']);
        Permission::create(['name' => 'ver_marcas', 'description' => 'Ver marcas']);
        Permission::create(['name' => 'editar_marca', 'description' => 'Editar marcas']);
        Permission::create(['name' => 'eliminar_marca', 'description' => 'Eliminar marcas']);
        Permission::create(['name' => 'registrar_residuo', 'description' => 'Registrar residuos']);
        Permission::create(['name' => 'ver_residuos', 'description' => 'Ver residuos']);
        Permission::create(['name' => 'editar_residuo', 'description' => 'Editar residuos']);
        Permission::create(['name' => 'eliminar_residuo', 'description' => 'Eliminar residuos']);
    }
}
