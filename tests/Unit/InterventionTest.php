<?php

namespace Tests\Unit;

use App\Models\Intervention;
use App\Models\Plot;
use App\Models\User;
use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    use RefreshDatabase;

    public function test_intervention_belongs_to_user()
    {
        $user = User::factory()->create();
        $intervention = Intervention::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($intervention->user()->is($user));
    }

    public function test_intervention_belongs_to_plot()
    {
        $plot = Plot::factory()->create();
        $intervention = Intervention::factory()->create(['plot_id' => $plot->id]);

        $this->assertTrue($intervention->plot()->is($plot));
    }

    public function test_intervention_casts_attributes()
    {
        $intervention = Intervention::factory()->create([
            'intervention_type' => InterventionTypeEnum::FT,
            'unit' => UnitEnum::KG,
        ]);

        $this->assertEquals(InterventionTypeEnum::FT, $intervention->intervention_type);
        $this->assertEquals(UnitEnum::KG, $intervention->unit);
    }
}
