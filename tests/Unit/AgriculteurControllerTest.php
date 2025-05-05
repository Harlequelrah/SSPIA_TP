<?php
namespace Tests\Unit;

use App\Enums\RoleEnum;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgriculteurControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_agriculteur_can_be_registered()
    {
        $response = $this->post(route('agriculteurs.store'), [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'userName' => 'johndoe',
            'email' => 'johndoe@example.com',
            'phone' => '12345678', // 8 chiffres
            'address' => '123 Main St',
        ]);

        $response->assertRedirect(route('agriculteurs.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'role' => RoleEnum::AGRICULTEUR,
        ]);
    }

    public function test_agriculteur_create_page_is_accessible()
    {
        $response = $this->get(route('agriculteurs.create'));

        $response->assertStatus(200); // Vérifie que la page est accessible
    }
}
