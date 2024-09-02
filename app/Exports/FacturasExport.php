<?php

namespace App\Exports;

use App\Models\ClienteFactura;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ClienteFactura::all();
    }
}
