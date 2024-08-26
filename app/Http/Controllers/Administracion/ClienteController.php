<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\ClienteExport;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function index()
    {
        return view('admin.clientes.index', [
            'clientes' => Cliente::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.clientes.create', [
            'cliente' => new Cliente(),
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
}
