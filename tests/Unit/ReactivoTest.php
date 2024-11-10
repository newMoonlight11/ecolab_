<?php

namespace Tests\Unit;

use App\Models\Familia;
use App\Models\Marca;
use Tests\TestCase;
use App\Models\Reactivo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReactivoTest extends TestCase
{
    use RefreshDatabase; // Borra la base de datos después de cada prueba

    /** @test */
    public function it_can_add_a_reactivo_to_inventory()
    {
        $familia = Familia::factory()->create();
        $marca = Marca::factory()->create();

        $reactivoData = [
            'nombre' => 'Reactivo pruebas',
            'numero_cas' => '1',
            'referencia_fabricante' => '1',
            'lote' => '1',
            'num_registro_invima' => '1',
            'marca_id' => $marca->id,
            'familia_id' => $familia->id,
        ];

        $reactivo = Reactivo::create($reactivoData);

        $this->assertDatabaseHas('reactivos', $reactivoData);
    }

    public function it_can_delete_a_reactivo_from_inventory()
    {
        $reactivo = Reactivo::factory()->create();

        $reactivo->delete();

        $this->assertDatabaseMissing('reactivos', ['id' => $reactivo->id]);
    }

    public function it_can_update_reactivo_lote()
    {
        $familia = Familia::factory()->create();
        $marca = Marca::factory()->create();
        
        $reactivo = Reactivo::factory()->create([
            'nombre' => 'Reactivo pruebas 2',
            'numero_cas' => '2',
            'referencia_fabricante' => '2',
            'lote' => '3',
            'num_registro_invima' => '2',
            'marca_id' => $marca->id,
            'familia_id' => $familia->id,
        ]);

        $reactivo->update(['lote' => 2]);

        $this->assertDatabaseHas('reactivos', ['id' => $reactivo->id, 'lote' => 2]);
    }

}
