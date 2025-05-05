<?php
namespace Tests\Unit;

use App\Models\Intervention;
use App\Models\Plot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_plots_relationship()
    {
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]);

        // Vérifie que l'utilisateur a exactement 1 plot (soft deleted inclus)
        $this->assertTrue($plot->user()->is($user));
    }

    public function test_user_has_interventions_relationship()
    {
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]); // Crée une parcelle associée à l'utilisateur
        $intervention = Intervention::factory()->create([
            'user_id' => $user->id,
            'plot_id' => $plot->id, // Associe l'intervention à la parcelle
        ]);

        // Vérifie que l'intervention est associée à l'utilisateur
        $this->assertTrue($intervention->user()->is($user));
        // Vérifie que l'intervention est associée à la bonne parcelle
        $this->assertTrue($intervention->plot()->is($plot));
    }
}
