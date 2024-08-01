<?php

namespace Database\Seeders;

use App\Models\Localidad;
use Database\Seeders\CsvSeeder as Seeder;

class LocalidadSeeder extends Seeder
{
    protected $filePath = '/database/data/localidades.csv';
    protected $model = Localidad::class;
}
