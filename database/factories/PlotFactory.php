<?php
namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plot>
 */
class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'            => $this->faker->unique()->word(),
            'area'            => $this->faker->randomFloat(2, 0.5, 100), // Superficie entre 0.5 et 100 hectares
            'crop_type'       => $this->faker->randomElement(['Blé', 'Maïs', 'Riz', 'Soja']),
            'plantation_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'status'          => $this->faker->randomElement(StatusEnum::values()),
            'user_id'         => User::factory(), // Associe un utilisateur via une factory
        ];
    }
}
