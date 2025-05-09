<?php
namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Plot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlotTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_own_plots()
    {

        /** @var User **/
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]);

$response = $this->actingAs($user)->get(route('plots.show', $plot->id));


        $response->assertStatus(200);
        $response->assertSee($plot->name);
    }

    public function test_admin_can_view_all_plots()
    {
        /** @var User **/
        $admin = User::factory()->create(['role' => RoleEnum::ADMIN]);
        $plot  = Plot::factory()->create();

        $response = $this->actingAs($admin)->get(route('plots.index'));

        $response->assertStatus(200);
        $response->assertSee($plot->name);
    }

    public function test_user_cannot_view_other_users_plots()
    {
/** @var User **/

        $user = User::factory()->create();
        /** @var User **/

        $otherUser = User::factory()->create();
        $plot      = Plot::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->get(route('plots.show', $plot->id));

        $response->assertStatus(403);
        $response->assertDontSee($plot->name);
    }

    public function test_user_can_create_a_plot()
    {
        /** @var User **/

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('plots.store'), [
            'name'            => 'New Plot',
            'area'            => 10.5,
            'crop_type'       => 'Blé',
            'plantation_date' => now()->format('Y-m-d'),
            'status'          => StatusEnum::EN_C->value,
        ]);

        $response->assertRedirect(route('plots.index'));
        $this->assertDatabaseHas('plots', ['name' => 'New Plot']);
    }

    public function test_user_can_update_their_plot()
    {
        /** @var User **/
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('plots.update', $plot), [
            'name'            => 'Updated Plot',
            'area'            => $plot->area,
            'crop_type'       => $plot->crop_type,
            'plantation_date' => $plot->plantation_date->format('Y-m-d'),
            'status'          => $plot->status->value,
        ]);

        $response->assertRedirect(route('plots.index'));
        $this->assertDatabaseHas('plots', ['name' => 'Updated Plot']);
    }

    public function test_user_cannot_update_other_users_plot()
    {
        /** @var User **/
        $user = User::factory()->create();

        /** @var User **/
        $otherUser = User::factory()->create();

        $plot = Plot::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->put(route('plots.update', $plot), [
            'name'            => 'Updated Plot',
            'area'            => 85.77,
            'crop_type'       => 'Maïs',
            'plantation_date' => now()->format('Y-m-d'),
            'status'          => 'En culture',
        ]);

        $response->assertStatus(403);
    }

    public function test_user_can_delete_their_plot()
    {
        /** @var User **/
        $user = User::factory()->create();
        $plot = Plot::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('plots.destroy', $plot));


        $response->assertRedirect(route('plots.index'));
        $this->assertSoftDeleted('plots', ['id' => $plot->id]);


    }
}
