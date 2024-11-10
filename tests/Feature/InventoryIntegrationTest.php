<?php

namespace Tests\Feature;

use App\Models\Familia;
use App\Models\Marca;
use App\Models\Reactivo;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InventoryIntegrationTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Crear instancias de Familia y Marca
        Familia::factory()->create();
        Marca::factory()->create();

        $this->withoutMiddleware(PermissionMiddleware::class);
        $this->withoutMiddleware(RoleMiddleware::class);
    }
    /** @test */
    public function test_adding_reactive_to_inventory()
    {
        // Crear un usuario y asignarle un rol con permisos necesarios
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'gestionar_reactivos', 'description' => 'Gestionar reactivos']); // Cambia según el nombre de tu permiso
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $this->actingAs($user);

        // Datos del reactivo de prueba
        $reactivoData = [
            'nombre' => 'Ácido Clorhídrico',
            'numero_cas' => '7647-01-0',
            'referencia_fabricante' => 'HCl-123',
            'lote' => 'L-2023',
            'num_registro_invima' => 'INV-2023-001',
            'familia_id' => 1,
            'marca_id' => 1,
        ];

        // Solicitud POST a la ruta de creación de reactivo
        $response = $this->post('/reactivos', $reactivoData);

        // Verifica si la respuesta fue exitosa y si el reactivo fue agregado en la base de datos de prueba
        $response->assertStatus(302); // Redirección después de guardar
        $this->assertDatabaseHas('reactivos', [
            'nombre' => 'Ácido Clorhídrico'
        ]);
    }

    /** @test */
    public function test_inventory_query_from_frontend_displays_correctly()
    {
        // Crear un usuario con permisos para ver reactivos
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'gestionar_reactivos', 'description' => 'Gestionar reactivos']); // Cambia según el nombre de tu permiso
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        $this->actingAs($user);

        // Crear reactivos en la base de datos de prueba
        $reactivos = Reactivo::factory()->count(3)->create();

        // Realiza la solicitud GET a la página del inventario
        $response = $this->get('/reactivos');

        // Verifica que la página cargue correctamente
        $response->assertStatus(200);

        // Verifica que los ids de los reactivos estén en el HTML
        foreach ($reactivos as $reactivo) {
            $response->assertSee((string) $reactivo->id);
        }
    }

    /** @test */
    public function test_login_authentication_and_access_control()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'general']); // Rol para visualizar
        $permission = Permission::create(['name' => 'gestionar_reactivos', 'description' => 'Gestionar reactivos']); // Permiso específico
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        // Autenticar usuario y realizar solicitud
        $this->actingAs($user);
        $response = $this->get('/reactivos');

        $response->assertStatus(200); // Página cargada correctamente
    }
}
