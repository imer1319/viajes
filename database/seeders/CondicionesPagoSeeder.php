<?php

namespace Database\Seeders;

use App\Models\CondicionesPago;
use Database\Seeders\CsvSeeder as Seeder;

class CondicionesPagoSeeder extends Seeder
{
    protected $filePath = '/database/data/condicion_pago.csv';
    protected $model = CondicionesPago::class;
}
