<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(),
            'rol_id' => $this->faker->numberBetween(2, 3),
            'estudio_id' => $this->faker->numberBetween(1, 10),
            'avatar' => $this->faker->imageUrl(640, 480, 'people', true),
        ];
    }
}
