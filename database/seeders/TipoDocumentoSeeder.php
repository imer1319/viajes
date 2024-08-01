<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Database\Seeders\CsvSeeder as Seeder;

class TipoDocumentoSeeder extends Seeder
{
    protected $filePath = '/database/data/tipo_documentos.csv';
    protected $model = TipoDocumento::class;
}
