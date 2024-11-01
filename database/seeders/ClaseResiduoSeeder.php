<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClaseResiduo;

class ClaseResiduoSeeder extends Seeder
{
    public function run()
    {
        $clasesResiduo = [
            'Residuo Químico puro',
            'Reactivo Químico Vencido',
            'Mezcla Colorantes liquido',
            'Mezcla Colorante sólido',
            'Mezcla ácida inorgánica',
            'Mezcla ácida orgánica',
            'Mezcla básica inorgánica',
            'Mezcla básica orgánica',
            'Mezcla alcoholes',
            'Mezcla residuo compuesta',
        ];

        foreach ($clasesResiduo as $nombre) {
            ClaseResiduo::create(['nombre' => $nombre]);
        }
    }
}
