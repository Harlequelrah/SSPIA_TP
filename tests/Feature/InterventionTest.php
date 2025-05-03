<?php
namespace Tests\Feature;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use App\Models\Intervention;
use App\Models\Plot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    use RefreshDatabase;

    public function test_intervention_creation()
    {
        $user = User::factory()->create();
        $plot = Plot::factory()->create();

        $intervention = Intervention::create([
            'description'           => 'Test intervention',
            'product_used_name'     => 'Fertilizer',
            'product_used_quantity' => 10,
            'intervention_type'     => InterventionTypeEnum::SM,
            'intervention_date'     => now(),
            'user_id'               => $user->id,
            'plot_id'               => $plot->id,
            'unit'                  => UnitEnum::KG,
        ]);

        $this->assertDatabaseHas('interventions', [
            'description'       => 'Test intervention',
            'product_used_name' => 'Fertilizer',
        ]);
    }

    public function test_intervention_user_relationship()
    {
        $user         = User::factory()->create();
        $intervention = Intervention::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($intervention->user->is($user));
    }

    public function test_intervention_plot_relationship()
    {
        $plot         = Plot::factory()->create();
        $intervention = Intervention::factory()->create(['plot_id' => $plot->id]);

        $this->assertTrue($intervention->plot->is($plot));
    }
}
