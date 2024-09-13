<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\AnticipoChoferExport;
use App\Http\Controllers\Controller;
use App\Models\AnticipoChofer;
use App\Models\Chofer;
use Maatwebsite\Excel\Facades\Excel;

class AnticipoChoferController extends Controller
{
    public function index(Chofer $chofer)
    {
        return view('admin.anticipoChofer.index', [
            'chofer' => $chofer,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8)
        ]);
    }

    public function create(Chofer $chofer)
    {
        $ultimoAnticipoChofer = AnticipoChofer::latest()->first();
        return view('admin.anticipoChofer.create', [
            'chofer' => $chofer,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
            'numero_interno' => $ultimoAnticipoChofer ? $ultimoAnticipoChofer->numero_interno + 1 : 1,
        ]);
    }

    public function edit(Chofer $chofer, AnticipoChofer $anticipo)
    {
        return view('admin.anticipoChofer.edit', [
            'chofer' => $chofer,
            'anticipo' => $anticipo,
            'anticipos' => $chofer->anticipos()->with('chofer')->paginate(8),
        ]);
    }
    
    public function downloadExcel(Chofer $chofer)
    {
        return Excel::download(new AnticipoChoferExport($chofer), 'anticipo_chofer.xlsx');
    }
}
