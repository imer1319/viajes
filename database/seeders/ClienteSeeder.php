<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Provincia;
use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max = 12;
        foreach (range(0, $max) as $iter) {
            $provincia = Provincia::inRandomOrder()->first();
            $departamento = $provincia->departamentos()->inRandomOrder()->first();
            Cliente::factory()->create([
                'tipo_documento_id' => TipoDocumento::first(),
                'provincia_id' => $provincia,
                'departamento_id' => $departamento,
                'localidad_id' => $departamento->localidades()->inRandomOrder()->first()
            ]);
        }
    }
}
