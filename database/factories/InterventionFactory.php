<?php

namespace Database\Factories;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use App\Models\Plot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
            'product_used_name' => $this->faker->word(),
            'product_used_quantity' => $this->faker->randomFloat(2, 1, 100), // Quantité entre 1 et 100
            'intervention_type' => $this->faker->randomElement(InterventionTypeEnum::values()),
            'intervention_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'unit' => $this->faker->randomElement(UnitEnum::values()),
            'user_id' => User::factory(), // Associe un utilisateur via une factory
            'plot_id' => Plot::factory(), // Associe une parcelle via une factory
        ];
    }
}
