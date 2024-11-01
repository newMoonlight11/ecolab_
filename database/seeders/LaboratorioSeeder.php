<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratorio;

class LaboratorioSeeder extends Seeder
{
    public function run()
    {
        $laboratorios = [
            'Laboratorio E-BIO',
            'Laboratorio Biomateriales',
            'Laboratorio Química Ingenierías',
            'Laboratorio Instituto Caldas',
            'Laboratorio de genética y biología Molecular',
            'Almacén',
            'Laboratorio de histopatología',
            'Laboratorio de Farmacología',
            'Laboratorio Microbiología',
        ];

        foreach ($laboratorios as $nombre) {
            Laboratorio::create(['nombre' => $nombre]);
        }
    }
}
