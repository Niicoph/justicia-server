<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermisoDoc>
 */
class PermisoDocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_doc' => $this->faker->randomAscii(),
            'usuario_id' => $this->faker->randomNumber(1, 10),
            'permiso' => $this->faker->boolean(),
            'tipo_permiso' => $this->faker->randomElement(['read', 'write']),
        ];
    }
}
