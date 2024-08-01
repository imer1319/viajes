<?php

namespace Database\Seeders;

use App\Models\RetencionIngresosBruto;
use Database\Seeders\CsvSeeder as Seeder;

class RetencionIngresosBrutoSeeder extends Seeder
{
    protected $filePath = '/database/data/retencion_ingresos_bruto.csv';
    protected $model = RetencionIngresosBruto::class;
}
