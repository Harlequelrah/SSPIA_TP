<?php

namespace Tests\Unit;

use App\Models\Plot;
use App\Models\User;
use App\Models\Intervention;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlotTest extends TestCase
{
    use RefreshDatabase;

    public function test_plot_belongs_to_user()
    {
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($plot->user()->is($user));
    }

    public function test_plot_has_interventions_relationship()
    {
        $plot = Plot::factory()->create();
        $intervention = Intervention::factory()->create(['plot_id' => $plot->id]);

        // Vérifie que la parcelle a exactement 1 intervention
        $this->assertCount(1, $plot->interventions);

        // Vérifie que l'intervention associée est correcte
        $this->assertEquals($intervention->id, $plot->interventions->first()->id);
    }
}
