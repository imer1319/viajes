<?php

namespace App\Http\Controllers\Main;

use App\Events\MovimientoActualizado;
use App\Events\MovimientoCreado;
use App\Events\MovimientoEliminado;
use App\Exports\MovimientosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimiento\StoreRequest;
use App\Http\Requests\Movimiento\UpdateRequest;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\CondicionIva;
use App\Models\Departamento;
use App\Models\Flota;
use App\Models\Liquidacion;
use App\Models\Localidad;
use App\Models\Movimiento;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\TipoDocumento;
use App\Models\TipoViaje;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('admin.movimientos.index', [
            'movimientos' => Movimiento::latest()->paginate(8),
            'choferes' => Chofer::all(),
            'tipoViajes' => TipoViaje::all(),
            'flotas' => Flota::all(),
            'clientes' => Cliente::all()
        ]);
    }

    public function search(Request $request)
    {
        $movimientos = Movimiento::query()
            ->byChoferId($request->input('chofer_id'))
            ->byTipoViajeId($request->input('tipo_viaje_id'))
            ->byClienteId($request->input('cliente_id'))
            ->byFlotaId($request->input('flota_id'))
            ->byFacturado($request->input('facturado'))
            ->latest()
            ->paginate(8);

        $movimientos->appends($request->except('page'));
        return view('admin.movimientos.index', [
            'movimientos' => $movimientos,
            'choferes' => Chofer::all(),
            'tipoViajes' => TipoViaje::all(),
            'flotas' => Flota::all(),
            'clientes' => Cliente::all()
        ]);
    }

    public function create()
    {
        $ultimoMovimiento = Movimiento::latest()->first();
        $numeroInterno = $ultimoMovimiento ? $ultimoMovimiento->numero_interno + 1 : 1;
        return view('admin.movimientos.create', [
            'movimiento' => new Movimiento(),
            'numero_interno' => $numeroInterno,
            'choferes' => Chofer::all(),
            'tipoViajes' => TipoViaje::all(),
            'flotas' => Flota::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'retencionIngresosBruto' => RetencionIngresosBruto::all(),
            'tipoDocumentos' => TipoDocumento::all(),
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'clientes' => Cliente::all()
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
        $edit = request()->query('edit', false);
        $chofer_id_anterior = request()->query('chofer_id_anterior', null);
        $liquidacion = request()->query('liquidacion', null);
        $choferData = $this->loadChoferData($chofer);

        if ($edit && $chofer_id_anterior && $chofer_id_anterior == $chofer->id && $liquidacion) {
            return $this->handleEditWithSameChofer($choferData, $liquidacion);
        }

        return $this->handleNewOrDifferentChofer($choferData);
    }

    private function loadChoferData(Chofer $chofer)
    {
        return Chofer::with([
            'movimientos' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
            'anticipos' => function ($query) {
                $query->with('chofer');
            },
            'gastos' => function ($query) {
                $query->with('flota', 'proveedor', 'chofer');
            }
        ])->find($chofer->id);
    }

    private function handleEditWithSameChofer($choferData, $liquidacion)
    {
        $liquidacionData = $this->loadLiquidacionData($liquidacion);

        $movimientosGuardados = $liquidacionData->movimientos->map->movimiento;
        $anticiposGuardados = $liquidacionData->anticipos->map->anticipo;
        $gastosGuardados = $liquidacionData->gastos->map->gasto;

        $movimientosCero = $this->filterNonZeroSaldo($choferData->movimientos);
        $anticiposCero = $this->filterNonZeroSaldo($choferData->anticipos);
        $gastosCero = $this->filterNonZeroSaldo($choferData->gastos);

        return $this->createResponse($choferData, $movimientosGuardados, $anticiposGuardados, $gastosGuardados, $movimientosCero, $anticiposCero, $gastosCero);
    }

    private function handleNewOrDifferentChofer($choferData)
    {
        $movimientosGuardados = $this->filterNonZeroSaldo($choferData->movimientos);
        $anticiposGuardados = $this->filterNonZeroSaldo($choferData->anticipos);
        $gastosGuardados = $this->filterNonZeroSaldo($choferData->gastos);

        return $this->createResponse($choferData, $movimientosGuardados, $anticiposGuardados, $gastosGuardados);
    }

    private function loadLiquidacionData($liquidacion)
    {
        return Liquidacion::with([
            'movimientos.movimiento' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
            'gastos.gasto' => function ($query) {
                $query->with('proveedor', 'chofer', 'flota');
            },
            'anticipos.anticipo'
        ])->find($liquidacion);
    }

    private function filterNonZeroSaldo($collection)
    {
        return $collection->filter(function ($item) {
            return $item->saldo_total != 0 || $item->saldo != 0;
        });
    }

    private function createResponse($choferData, $movimientos, $anticipos, $gastos, $movimientosCero = null, $anticiposCero = null, $gastosCero = null)
    {
        return response()->json([
            'chofer' => [
                'id' => $choferData->id,
                'nombre' => $choferData->nombre,
                'dni' => $choferData->dni,
                'cuil' => $choferData->cuil,
            ],
            'movimientos' => $movimientos->values(),
            'anticipos' => $anticipos->values(),
            'gastos' => $gastos->values(),
            'movimientosCero' => $movimientosCero ? $movimientosCero->values() : collect()->values(),
            'anticiposCero' => $anticiposCero ? $anticiposCero->values() : collect()->values(),
            'gastosCero' => $gastosCero ? $gastosCero->values() : collect()->values(),
        ]);
    }

    public function downloadPdf(Movimiento $movimiento)
    {
        $movimiento->load('chofer', 'cliente', 'flota', 'tipoViaje');
        $pdf = Pdf::loadView('reportes.movimiento', compact('movimiento'));
        return $pdf->stream();
    }

    public function downloadExcel()
    {
        return Excel::download(new MovimientosExport, 'movimientos.xlsx');
    }
}
