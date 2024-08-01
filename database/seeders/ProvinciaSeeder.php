<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Database\Seeders\CsvSeeder as Seeder;

class ProvinciaSeeder extends Seeder
{
    protected $filePath = '/database/data/provincias.csv';
    protected $model = Provincia::class;
}
