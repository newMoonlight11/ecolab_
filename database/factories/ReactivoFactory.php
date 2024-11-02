<?php

namespace Database\Factories;

use App\Models\Reactivo;
use App\Models\Familia;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactivoFactory extends Factory
{
    protected $model = Reactivo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->words(2, true), // Genera un nombre de reactivo aleatorio
            'img_reactivo' => null, // Dejar en `null` si no se requiere una imagen en esta prueba
            'numero_cas' => $this->faker->regexify('[0-9]{3}-[0-9]{2}-[0-9]'), // Genera un número CAS simulado
            'referencia_fabricante' => $this->faker->bothify('REF-###-??'), // Ejemplo de referencia del fabricante
            'lote' => $this->faker->bothify('L-####'), // Genera un número de lote simulado
            'num_registro_invima' => $this->faker->numerify('INV-######'), // Genera un número INVIMA simulado
            'familia_id' => Familia::inRandomOrder()->first()->id, // Selecciona un ID de familia al azar
            'marca_id' => Marca::inRandomOrder()->first()->id, // Selecciona un ID de marca al azar
        ];
    }
}
