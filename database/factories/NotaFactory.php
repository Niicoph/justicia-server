<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nota>
 */
class NotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(['pendiente', 'completada']),
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'usuario_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
