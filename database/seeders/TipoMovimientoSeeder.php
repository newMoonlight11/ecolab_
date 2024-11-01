<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoMovimiento;

class TipoMovimientoSeeder extends Seeder
{
    public function run()
    {
        $tiposMovimiento = [
            'Compra',
            'Préstamo',
            'Devolución',
        ];

        foreach ($tiposMovimiento as $nombre) {
            TipoMovimiento::create(['nombre' => $nombre]);
        }
    }
}
