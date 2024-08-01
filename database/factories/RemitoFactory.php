<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remito>
 */
class RemitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fechaUnaSemanaAtras = Carbon::now()->subWeek();
        return [
            'user_id' => 1,
            'numero' => $this->faker->randomNumber(3),
            'proveedor_id' => rand(1,6),
            'localidad_id' => rand(1,20),
            'fecha_ingreso' => $this->faker->dateTimeBetween($fechaUnaSemanaAtras, 'now'),
        ];
    }
}
