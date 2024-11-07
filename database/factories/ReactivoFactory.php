<?php

namespace Database\Factories;

use App\Models\Reactivo;
use App\Models\Familia;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactivoFactory extends Factory
{
    protected $model = Reactivo::class;

    private static $nombres = [
        'Hidróxido de Sodio (NaOH)',
        'Ácido Clorhídrico (HCl)',
        'Sulfato de Cobre (CuSO₄)',
        'Nitrato de Plata (AgNO₃)',
        'Ácido Nítrico (HNO₃)',
        'Peróxido de Hidrógeno (H₂O₂)',
        'Carbonato de Sodio (Na₂CO₃)',
        'Ácido Acético (CH₃COOH)',
        'Cloruro de Calcio (CaCl₂)',
        'Fosfato de Potasio (K₃PO₄)',
    ];

    private static $index = 0;

    public function definition()
    {
        // Obtener el nombre actual de la lista y avanzar el índice
        $nombre = self::$nombres[self::$index];
        self::$index = (self::$index + 1) % count(self::$nombres);

        return [
            'nombre' => $nombre,
            'img_reactivo' => null,
            'numero_cas' => $this->faker->regexify('[0-9]{3}-[0-9]{2}-[0-9]'),
            'referencia_fabricante' => $this->faker->bothify('REF-###-??'),
            'lote' => $this->faker->bothify('L-####'),
            'num_registro_invima' => $this->faker->numerify('INV-######'),
            'familia_id' => Familia::inRandomOrder()->first()->id,
            'marca_id' => Marca::inRandomOrder()->first()->id,
        ];
    }
}
