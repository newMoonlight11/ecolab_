<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadSeeder extends Seeder
{
    public function run()
    {
        $unidades = [
            'Miligramos',
            'Gramos',
            'Kilogramos',
            'Mililitros',
            'Litros',
        ];

        foreach ($unidades as $nombre) {
            Unidad::create(['nombre' => $nombre]);
        }
    }
}
