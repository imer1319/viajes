<?php

namespace App\Exports;

use App\Models\GastoChofer;
use Maatwebsite\Excel\Concerns\FromCollection;

class GastosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GastoChofer::all();
    }
}
