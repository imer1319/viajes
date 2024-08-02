<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movimiento\StoreRequest;
use App\Http\Requests\Movimiento\UpdateRequest;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\CondicionIva;
use App\Models\Departamento;
use App\Models\Flota;
use App\Models\Localidad;
use App\Models\Movimiento;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\TipoDocumento;
use App\Models\TipoViaje;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('admin.retencionGanancias.index', [
            'movimientos' => Movimiento::latest()->paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.movimientos.create', [
            'movimiento' => new Movimiento(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Movimiento::create($request->validated());
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias creada corretamente');
    }

    public function edit(Movimiento $movimiento)
    {
        return view('admin.retencionGanancias.edit', [
            'ganancia' => $movimiento
        ]);
    }

    public function update(Movimiento $movimiento, UpdateRequest $request)
    {
        $movimiento->update($request->validated());
        return redirect()->route('admin.movimientos.index')->with('flash','Retencion de ganancias bruto actualizada corretamente');
    }

    public function destroy(Movimiento $movimiento)
    {
        $movimiento->delete();
        return redirect()->route('admin.retencion-ganancias.index')->with('flash', 'Retencion de ganancias bruto eliminado corretamente');
    }

    public function provincias()
    {
        return Provincia::all();
    }

    public function departamentosProvincia($provincia_id)
    {
        return Departamento::where('provincia_id', $provincia_id)->get();
    }

    public function localidadesDepartamento($departamento_id)
    {
        return Localidad::where('departamento_id', $departamento_id)->get();
    }

    public function retencionGanancias()
    {
        return RetencionGanancia::all();
    }

    public function retencionIngresoBrutos()
    {
        return RetencionIngresosBruto::all();
    }

    public function condicionesIva()
    {
        return CondicionIva::all();
    }

    public function tipoDocumentos()
    {
        return TipoDocumento::all();
    }
}
