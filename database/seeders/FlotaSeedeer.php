<?php

namespace Database\Seeders;

use App\Models\Flota;
use Database\Seeders\CsvSeeder as Seeder;

class FlotaSeedeer extends Seeder
{
    protected $filePath = '/database/data/flotas.csv';
    protected $model = Flota::class;
}
