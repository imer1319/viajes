<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Database\Seeders\CsvSeeder as Seeder;

class DepartamentoSeeder extends Seeder
{
    protected $filePath = '/database/data/departamentos.csv';
    protected $model = Departamento::class;
}
