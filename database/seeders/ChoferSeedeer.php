<?php

namespace Database\Seeders;

use App\Models\Chofer;
use Database\Seeders\CsvSeeder as Seeder;

class ChoferSeedeer extends Seeder
{
    protected $filePath = '/database/data/choferes.csv';
    protected $model = Chofer::class;
}
