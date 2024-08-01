<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tipo_documento_id' => TipoDocumento::factory(),
            'numero_documento' => $this->faker->numerify("########"),
            'apellido_nombre' => $this->faker->word(),
            'domicilio' => $this->faker->address(),
            'provincia_id' => Provincia::factory(),
            'departamento_id' => Departamento::factory(),
            'localidad_id' => Localidad::factory(),
            'telefono' => $this->faker->numerify("387#######"),
            'celular' => $this->faker->numerify("387#######"),
            'email' => $this->faker->unique()->email()
        ];
    }
}
