<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        // Asignar rol de "general" al usuario con ID 2
        $generalUser = User::find(2);
        if ($generalUser) {
            $generalUser->assignRole('general');
        }
    }
}
