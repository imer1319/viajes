<?php

namespace Database\Seeders;

use App\Models\PlanCuenta;
use Database\Seeders\CsvSeeder as Seeder;

class PlanCuentaSeeder extends Seeder
{
    protected $filePath = '/database/data/plan_cuentas.csv';
    protected $model = PlanCuenta::class;
}
