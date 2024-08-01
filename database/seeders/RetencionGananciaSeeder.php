<?php

namespace Database\Seeders;

use App\Models\RetencionGanancia;
use Database\Seeders\CsvSeeder as Seeder;

class RetencionGananciaSeeder extends Seeder
{
    protected $filePath = '/database/data/retencion_ganancias.csv';
    protected $model = RetencionGanancia::class;
}
