<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banco\StoreRequest;
use App\Http\Requests\Banco\UpdateRequest;
use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        return view('admin.bancos.index', [
            'bancos' => Banco::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.bancos.create', [
            'banco' => new Banco()
        ]);
    }

    public function store(StoreRequest $request)
    {
        Banco::create($request->validated());
        return redirect()->route('admin.bancos.index')->with('flash', 'Banco creado corretamente');
    }

    public function edit(Banco $banco)
    {
        return view('admin.bancos.edit', [
            'banco' => $banco
        ]);
    }

    public function update(UpdateRequest $request, Banco $banco)
    {
        $banco->update($request->validated());
        return redirect()->route('admin.bancos.index')->with('flash', 'Banco actualizado corretamente');
    }

    public function destroy(Banco $banco)
    {
        $banco->delete();
        return redirect()->route('admin.bancos.index')->with('flash', 'Banco eliminado corretamente');
    }
}
