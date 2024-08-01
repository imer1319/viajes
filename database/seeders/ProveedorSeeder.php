<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Database\Seeders\CsvSeeder as Seeder;

class ProveedorSeeder extends Seeder
{
    protected $filePath = '/database/data/proveedores.csv';
    protected $model = Proveedor::class;
}
