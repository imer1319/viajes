<?php

namespace Database\Seeders;

use App\Models\Banco;
use Database\Seeders\CsvSeeder as Seeder;

class BancoSeedeer extends Seeder
{
    protected $filePath = '/database/data/bancos.csv';
    protected $model = Banco::class;
}
