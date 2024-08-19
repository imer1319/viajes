<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CsvSeeder as Seeder;

class ClienteSeeder extends Seeder
{
    protected $filePath = '/database/data/clientes.csv';
    protected $model = Cliente::class;
}
