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
        Permission::create(['name' => 'view reports', 'description'=>'Ver informes']);    // Ver informes
        Permission::create(['name' => 'edit products','description'=>'Editar productos']);   // Editar productos
        Permission::create(['name' => 'create invoices', 'description'=>'Crear facturas']); // Crear facturas
        Permission::create(['name' => 'delete comments', 'description'=>'Eliminar comentarios']); // Eliminar comentarios
        Permission::create(['name' => 'manage users', 'description'=>'Gestionar usuarios']);    // Gestionar usuarios
    }
}
