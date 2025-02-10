<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'fecha' => $this->faker->date(),
            'hora_inicio' => $this->faker->time(),
            'hora_fin' => $this->faker->time(),
            'notificar' => $this->faker->boolean,
            'minutos_previos_notificacion' => $this->faker->randomElement([5, 10, 15, 30, 60]),
            'usuario_id' => $this->faker->numberBetween(2, 11),
        ];
    }
}
