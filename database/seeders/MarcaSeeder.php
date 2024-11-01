<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        $marcas = [
            'ChemPure',
            'LabMaster',
            'ReactaLab',
            'SilverTech',
            'PureChem',
            'OxiLab',
            'PureLab',
            'VineChem',
            'ReactoChem',
            'LabSolutions',
        ];

        foreach ($marcas as $nombre) {
            Marca::create(['nombre' => $nombre]);
        }
    }
}
