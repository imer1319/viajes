<?php

namespace Database\Factories;

use App\Models\Rubro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rubro>
 */
class RubroFactory extends Factory
{
    protected $model = Rubro::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word()
        ];
    }
}
