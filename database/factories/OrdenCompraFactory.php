<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrdenCompra>
 */
class OrdenCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'proveedor_id' => rand(1, 6),
            'condiciones_pagos_id' => rand(1, 8),
            'descripcion' => $this->faker->sentence(3),
            'neto' => $this->faker->randomNumber(3),
            'iva' => rand(3, 30),
            'total' => $this->faker->randomNumber(5),
            'estado' => 'pendiente'
        ];
    }
}
