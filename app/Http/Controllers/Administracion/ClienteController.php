<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ClienteExport;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use App\Models\CondicionIva;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes =  Cliente::latest()->paginate(8);

        $totales = [
            'saldo' => $clientes->sum('saldo'),
        ];
        return view('admin.clientes.index', [
            'clientes' => $clientes,
            'totales' => $totales,
        ]);
    }

    public function search(Request $request)
    {
        $clientes = Cliente::query()
            ->bySaldo($request->input('saldo'))
            ->latest()
            ->paginate(8);

        $clientes->appends($request->except('page'));

        $totales = [
            'saldo' => $clientes->sum('saldo'),
        ];
        return view('admin.clientes.index', [
            'clientes' => $clientes,
            'totales' => $totales,
        ]);
    }

    public function create()
    {
        return view('admin.clientes.create', [
            'cliente' => new Cliente(),
            'provincias' => Provincia::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
            'condicionesIva' => CondicionIva::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Cliente::create($request->validated());
        return redirect()->route('admin.clientes.index')->with('flash', 'Cliente creado corretamente');
    }

    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', [
            'cliente' => $cliente
        ]);
    }

    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', [
            'cliente' => $cliente
        ]);
    }

    public function update(UpdateRequest $request, Cliente $cliente)
    {
        $res = $cliente->update($request->validated());

        if ($res) {
            return response()->json(['message' => 'Cliente actualizado correctamente'], 201);
        }
        return response()->json(['message' => 'Error al actualizar el nuevo chofer'], 500);
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.clientes.index')->with('flash', 'Cliente eliminado corretamente');
    }

    public function downloadExcel()
    {
        return Excel::download(new ClienteExport, 'clientes.xlsx');
    }

    public function print(Request $request)
    {
        $clientes = Cliente::query()
            ->bySaldo($request->input('saldo'))
            ->get();

        $totales = [
            'saldo' => $clientes->sum('saldo'),
        ];

        $pdf = Pdf::loadView('reportes.clientes', compact('clientes', 'totales'));

        $pdf->setPaper('A4', 'landscape');

        $pdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->stream();
    }
}
