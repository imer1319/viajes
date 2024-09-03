<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use App\Models\ClienteFactura;
use App\Http\Controllers\Controller;
use App\Http\Requests\Factura\HeadRequest;
use App\Http\Requests\Factura\MovimientoRequest;
use App\Http\Requests\Factura\StoreRequest;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;

class FacturacionController extends Controller
{
    public function head(HeadRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function movimientos(MovimientoRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $factura = ClienteFactura::create($request->validated());
            $movimientos = $request->movimientos;

            foreach ($movimientos as $movimiento) {
                Movimiento::where('id', $movimiento['id'])->update(['facturado' => true]);
                $factura->detalles()->create([
                    'movimiento_id' => $movimiento['id'],
                ]);
            }
    
            DB::commit();
            return response()->json([
                'message' => 'Factura creada exitosamente.',
                'factura' => $factura,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el liquidacion.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function movimientosCliente(Cliente $cliente)
    {
        $edit = request()->query('edit', false);
        $cliente_id_anterior = request()->query('cliente_id_anterior', null);
        $factura = request()->query('factura', null);

        $clienteData = $this->loadClienteData($cliente);

        if ($edit && $cliente_id_anterior && $cliente_id_anterior == $cliente->id && $factura) {
            return $this->handleEditWithSameCliente($clienteData, $factura);
        }

        return $this->handleNewOrDifferentCliente($clienteData);
    }

    private function loadClienteData(Cliente $cliente)
    {
        return Cliente::with([
            'movimientos' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
        ])->find($cliente->id);
    }

    private function handleEditWithSameCliente($clienteData, $liquidacion)
    {
        $liquidacionData = $this->loadLiquidacionData($liquidacion);

        $movimientosGuardados = $liquidacionData->movimientos->map->movimiento;

        $movimientosCero = $this->filterUnfacturedMovements($clienteData->movimientos);

        return $this->createResponse($clienteData, $movimientosGuardados, $movimientosCero);
    }

    private function handleNewOrDifferentCliente($clienteData)
    {
        $movimientosGuardados = $this->filterUnfacturedMovements($clienteData->movimientos);

        return $this->createResponse($clienteData, $movimientosGuardados);
    }

    private function loadLiquidacionData($factura)
    {
        return ClienteFactura::with([
            'movimientos.movimiento' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
        ])->find($factura);
    }

    private function filterUnfacturedMovements($collection)
    {
        return $collection->filter(function ($item) {
            return !$item->facturado; // Filtrar movimientos donde 'facturado' es false
        });
    }

    private function createResponse($clienteData, $movimientos, $movimientosCero = null)
    {
        return response()->json([
            'cliente' => [
                'id' => $clienteData->id,
                'razon_social' => $clienteData->razon_social,
                'cuit' => $clienteData->cuit,
            ],
            'movimientos' => $movimientos->values(),
            'movimientosCero' => $movimientosCero ? $movimientosCero->values() : collect()->values(),
        ]);
    }
}
