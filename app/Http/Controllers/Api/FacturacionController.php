<?php

namespace App\Http\Controllers\Api;

use App\Events\FacturaCreada;
use App\Events\FacturaEliminada;
use App\Models\Cliente;
use App\Models\ClienteFactura;
use App\Http\Controllers\Controller;
use App\Http\Requests\Factura\HeadRequest;
use App\Http\Requests\Factura\MovimientoRequest;
use App\Http\Requests\Factura\StoreRequest;
use App\Http\Requests\Factura\UpdateRequest;
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

            event(new FacturaCreada($factura, $movimientos));

            DB::commit();
            return response()->json([
                'message' => 'Factura creada exitosamente.',
                'factura' => $factura,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el factura.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateRequest $request, ClienteFactura $facturacion)
    {
        try {
            DB::beginTransaction();
            
            $movimientos = $facturacion->detalles->map(function ($detalle) {
                return $detalle->movimiento;
            })->all();
            event(new FacturaEliminada($facturacion, $movimientos));
            $facturacion->update($request->validated());
            $movimientos = $request->movimientos;

            event(new FacturaCreada($facturacion, $movimientos));
            DB::commit();
            return response()->json([
                'message' => 'Factura creada exitosamente.',
                'factura' => $facturacion,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Hubo un error al crear el factura.',
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

    private function handleEditWithSameCliente($clienteData, $factura)
    {
        $facturaData = $this->loadFacturaData($factura);

        $movimientosGuardados = $facturaData->detalles->map->movimiento;
        $movimientosCero = $this->filterUnfacturedMovements($clienteData->movimientos);

        return $this->createResponse($clienteData, $movimientosGuardados, $movimientosCero);
    }

    private function handleNewOrDifferentCliente($clienteData)
    {
        $movimientosGuardados = $this->filterUnfacturedMovements($clienteData->movimientos);
        return $this->createResponse($clienteData, $movimientosGuardados);
    }

    private function loadFacturaData($factura)
    {
        return ClienteFactura::with([
            'detalles.movimiento' => function ($query) {
                $query->with('tipoViaje');
            },
        ])->find($factura);
    }

    private function filterUnfacturedMovements($collection)
    {
        return $collection->filter(function ($item) {
            return !$item->facturado;
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
