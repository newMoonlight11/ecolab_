<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('Mcvv22042003!'), // Cambia la contraseña según tus necesidades
        ]);

        // Crear el usuario General
        $generalUser = User::create([
            'name' => 'Usuario general',
            'email' => 'user@example.com',
            'password' => Hash::make('Cfes28042004$'), // Cambia la contraseña según tus necesidades
        ]);
    }
}
