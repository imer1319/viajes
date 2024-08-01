<?php

namespace Database\Seeders;

use App\Models\TipoComprobante;
use Database\Seeders\CsvSeeder as Seeder;

class TipoComprobanteSeeder extends Seeder
{
    protected $filePath = '/database/data/tipo_comprobantes.csv';
    protected $model = TipoComprobante::class;
}
