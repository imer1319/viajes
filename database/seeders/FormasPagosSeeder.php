<?php

namespace Database\Seeders;

use App\Models\FormasPagos;
use Database\Seeders\CsvSeeder as Seeder;

class FormasPagosSeeder extends Seeder
{
    protected $filePath = '/database/data/formas_pagos.csv';
    protected $model = FormasPagos::class;
}
