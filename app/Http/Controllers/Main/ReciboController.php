<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Recibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReciboController extends Controller
{
    public function movimientosCliente(Cliente $cliente)
    {
        $edit = request()->query('edit', false);
        $chofer_id_anterior = request()->query('chofer_id_anterior', null);
        $liquidacion = request()->query('liquidacion', null);

        // Log the request parameters for debugging
        Log::info(['edit' => $edit, 'chofer_id_anterior' => $chofer_id_anterior, 'liquidacion' => $liquidacion]);

        // Cargar datos del cliente junto con sus relaciones
        $choferData = $this->loadChoferData($cliente);

        if ($edit && $chofer_id_anterior && $chofer_id_anterior == $cliente->id && $liquidacion) {
            return $this->handleEditWithSameChofer($choferData, $liquidacion);
        }

        return $this->handleNewOrDifferentChofer($choferData);
    }

    private function loadChoferData(Cliente $cliente)
    {
        return Cliente::with([
            'movimientos' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
        ])->find($cliente->id);
    }

    private function handleEditWithSameChofer($choferData, $recibo)
    {
        $reciboData = $this->loadLiquidacionData($recibo);

        $movimientosGuardados = $reciboData->movimientos->map->movimiento;

        $movimientosCero = $this->filterNonZeroSaldo($choferData->movimientos);

        return $this->createResponse($choferData, $movimientosGuardados, $movimientosCero);
    }

    private function handleNewOrDifferentChofer($choferData)
    {
        $movimientosGuardados = $this->filterNonZeroSaldo($choferData->movimientos);

        return $this->createResponse($choferData, $movimientosGuardados);
    }

    private function loadLiquidacionData($recibo)
    {
        return Recibo::with([
            'movimientos.movimiento' => function ($query) {
                $query->with('tipoViaje', 'flota', 'cliente');
            },
            'gastos.gasto' => function ($query) {
                $query->with('proveedor', 'cliente', 'flota');
            },
            'anticipos.anticipo'
        ])->find($recibo);
    }

    private function filterNonZeroSaldo($collection)
    {
        return $collection->filter(function ($item) {
            return $item->saldo_total != 0 || $item->saldo != 0;
        });
    }

    private function createResponse($choferData, $movimientos, $movimientosCero = null)
    {
        return response()->json([
            'cliente' => [
                'id' => $choferData->id,
                'nombre' => $choferData->nombre,
                'dni' => $choferData->dni,
                'cuil' => $choferData->cuil,
            ],
            'movimientos' => $movimientos->values(),
            'movimientosCero' => $movimientosCero ? $movimientosCero->values() : collect()->values(),
        ]);
    }
}
