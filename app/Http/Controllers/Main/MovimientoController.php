<?php

namespace App\Http\Controllers\Main;

use App\Events\MovimientoActualizado;
use App\Events\MovimientoCreado;
use App\Events\MovimientoEliminado;
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
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('admin.movimientos.index', [
            'movimientos' => Movimiento::latest()->paginate(8)
        ]);
    }

    public function create()
    {
        $ultimoMovimiento = Movimiento::latest()->first();
        $numeroInterno = $ultimoMovimiento ? $ultimoMovimiento->id + 1 : 1;
        return view('admin.movimientos.create', [
            'movimiento' => new Movimiento(),
            'numero_interno' => $numeroInterno
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $movimiento = Movimiento::create($request->validated());
            event(new MovimientoCreado($movimiento));
            DB::commit();
            return response()->json([
                'message' => 'Movimiento creado exitosamente.',
                'movimiento' => $movimiento,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el movimiento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Movimiento $movimiento)
    {
        return view('admin.movimientos.show', [
            'movimiento' => $movimiento
        ]);
    }

    public function edit(Movimiento $movimiento)
    {
        return view('admin.movimientos.edit', [
            'movimiento' => $movimiento
        ]);
    }

    public function update(Movimiento $movimiento, UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            event(new MovimientoEliminado($movimiento));
            $movimiento->update($request->validated());
            event(new MovimientoCreado($movimiento));
            event(new MovimientoActualizado($movimiento));
            DB::commit();
            return response()->json([
                'message' => 'Movimiento creado exitosamente.',
                'movimiento' => $movimiento,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el movimiento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Movimiento $movimiento)
    {
        event(new MovimientoEliminado($movimiento));
        $movimiento->delete();
        return redirect()->route('admin.movimientos.index')->with('flash', 'Movimiento eliminado corretamente');
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

    public function movimientosChofer(Chofer $chofer)
    {
        $choferData = Chofer::with([
            'movimientos' => function ($query) {
                $query->where('saldo_total', '!=', 0)
                    ->with('tipoViaje', 'flota', 'cliente');
            },
            'anticipos' => function ($query) {
                $query->where('saldo', '!=', 0)
                    ->with('chofer');
            },
            'gastos' => function ($query) {
                $query->where('saldo', '!=', 0)
                    ->with('flota', 'proveedor', 'chofer');
            }
        ])->find($chofer->id);
    
        return response()->json([
            'chofer' => [
                'id' => $choferData->id,
                'nombre' => $choferData->nombre, 
                'dni' => $choferData->dni,
                'cuil' => $choferData->cuil,
            ],
            'movimientos' => $choferData->movimientos,
            'anticipos' => $choferData->anticipos,
            'gastos' => $choferData->gastos,
        ]);
    }
}
