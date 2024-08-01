<?php

namespace Database\Seeders;

use App\Models\CondicionIva;
use Database\Seeders\CsvSeeder as Seeder;

class CondicionIvaSeeder extends Seeder
{
    protected $filePath = '/database/data/condicion_ivas.csv';
    protected $model = CondicionIva::class;
}
