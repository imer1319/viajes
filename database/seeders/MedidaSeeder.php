<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medida::create([
            'descripcion' => 'HS',
        ]);
        Medida::create([
            'descripcion' => 'KG',
        ]);
        Medida::create([
            'descripcion' => 'M2',
        ]);
        Medida::create([
            'descripcion' => 'M3',
        ]);
        Medida::create([
            'descripcion' => 'ML',
        ]);
        Medida::create([
            'descripcion' => 'UN',
        ]);
    }
}
