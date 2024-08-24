<?php

namespace App\Exports;

use App\Models\AnticipoChofer;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnticiposExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AnticipoChofer::all();
    }
}
