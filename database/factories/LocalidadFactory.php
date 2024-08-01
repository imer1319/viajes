<?php

namespace Database\Factories;

use App\Models\Departamento;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Localidad>
 */
class LocalidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Localidad::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => 'Salta',
            'departamento_id' => Departamento::factory()
        ];
    }
}
