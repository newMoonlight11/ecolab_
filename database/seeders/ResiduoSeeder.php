<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Residuo;
use App\Models\ClaseResiduo;

class ResiduoSeeder extends Seeder
{
    public function run()
    {
        // Datos de residuos que queremos insertar
        $residuosData = [
            ['nombre' => 'Ácido Clorhídrico Vencido', 'clase' => 'Reactivo Químico Vencido'],
            ['nombre' => 'Hidróxido de Potasio Contaminado', 'clase' => 'Residuo Químico puro'],
            ['nombre' => 'Mezcla de Colorantes Orgánicos', 'clase' => 'Mezcla Colorantes liquido'],
            ['nombre' => 'Polvo de Colorante de Anilina', 'clase' => 'Mezcla Colorante sólido'],
            ['nombre' => 'Solución Ácida de Sulfato de Aluminio', 'clase' => 'Mezcla ácida inorgánica'],
            ['nombre' => 'Residuos de Ácido Acético y Benceno', 'clase' => 'Mezcla ácida orgánica'],
            ['nombre' => 'Solución de Hidróxido de Sodio Dañada', 'clase' => 'Mezcla básica inorgánica'],
            ['nombre' => 'Residuos de Aminas y Base Orgánica', 'clase' => 'Mezcla básica orgánica'],
            ['nombre' => 'Mezcla de Metanol y Etanol Residual', 'clase' => 'Mezcla alcoholes'],
            ['nombre' => 'Residuos Compuestos de Solventes y Polímeros', 'clase' => 'Mezcla residuo compuesta'],
        ];

        // Insertar los residuos
        foreach ($residuosData as $data) {
            // Buscar la clase de residuo por nombre
            $claseResiduo = ClaseResiduo::where('nombre', $data['clase'])->first();

            // Crear el residuo solo si la clase existe
            if ($claseResiduo) {
                Residuo::create([
                    'nombre' => $data['nombre'],
                    'clase_residuo_id' => $claseResiduo->id,
                ]);
            } else {
                echo "Clase de residuo '{$data['clase']}' no encontrada.\n";
            }
        }
    }
}
