<?php

namespace Database\Factories;

use App\Models\Deposito;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deposito>
 */
class DepositoFactory extends Factory
{
    protected $model = Deposito::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word()
        ];
    }
}
