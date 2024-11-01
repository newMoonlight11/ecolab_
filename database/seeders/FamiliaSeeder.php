<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Familia;

class FamiliaSeeder extends Seeder
{
    public function run()
    {
        $familias = [
            'Ácidos',
            'Alcoholes',
            'Bases',
            'Colorantes e indicadores',
            'Detergentes',
            'Sales inorgánicas y orgánicas',
            'Solventes',
        ];

        foreach ($familias as $nombre) {
            Familia::create(['nombre' => $nombre]);
        }
    }
}
