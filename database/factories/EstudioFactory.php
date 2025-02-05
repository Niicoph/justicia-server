<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudio>
 */
class EstudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'limite_docs' => $this->faker->numberBetween(1000, 1000),
            'plan' => $this->faker->randomElement(['basico', 'premium', 'avanzado']),
            'api_token' => $this->faker->sha256(),
        ];
    }
}
