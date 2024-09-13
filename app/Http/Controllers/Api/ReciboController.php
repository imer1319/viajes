<?php

namespace App\Http\Controllers\Api;

use App\Events\ReciboCreado;
use App\Http\Controllers\Controller;
use App\Http\Requests\Recibo\FacturaRequest;
use App\Http\Requests\Recibo\FormaPagoRequest;
use App\Http\Requests\Recibo\FormaPagosRequest;
use App\Http\Requests\Recibo\HeadRequest;
use App\Http\Requests\Recibo\StoreRequest;
use App\Http\Requests\Recibo\UpdateRequest;
use App\Models\Cliente;
use App\Models\ClienteFactura;
use App\Models\FacturaRecibo;
use App\Models\PagoRecibo;
use App\Models\Recibo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReciboController extends Controller
{
    public function head(HeadRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function facturas(FacturaRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function formaPago(FormaPagoRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function formaPagos(FormaPagosRequest $request)
    {
        $datos = $request->validated();
        return response($datos);
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $recibo = Recibo::create($request->validated());
            event(new ReciboCreado($recibo));

            DB::commit();
            return response()->json(['message' => 'Recibo creado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear el recibo:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Error al crear el recibo. Intente nuevamente.'], 500);
        }
    }

    public function update(UpdateRequest $request) {
        
    }

    public function facturasCliente(Cliente $cliente)
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
            'facturas' => function ($query) {
                $query->where('saldo_total', '!=', 0);
            },
        ])->find($cliente->id);
    }

    private function handleEditWithSameCliente($clienteData, $factura)
    {
        $facturaData = $this->loadFacturaData($factura);

        $facturas = $facturaData->detalles->map->factura;
        $facturasCero = $this->filterFacturasConSaldoCero($clienteData->facturasConSaldoCero);

        return $this->createResponse($clienteData, $facturas, $facturasCero);
    }

    private function handleNewOrDifferentCliente($clienteData)
    {
        $facturas = $this->filterFacturasConSaldoCero($clienteData->facturas);
        return $this->createResponse($clienteData, $facturas);
    }

    private function loadFacturaData($factura)
    {
        return ClienteFactura::with([
            'detalles.factura' => function ($query) {
                $query->with('tipoViaje');
            },
        ])->find($factura);
    }

    private function filterFacturasConSaldoCero($collection)
    {
        return $collection->filter(function ($item) {
            return $item->saldo == 0;
        });
    }

    private function createResponse($clienteData, $facturas, $facturasCero = null)
    {
        return response()->json([
            'cliente' => [
                'id' => $clienteData->id,
                'razon_social' => $clienteData->razon_social,
                'cuit' => $clienteData->cuit,
            ],
            'facturas' => $facturas->values(),
            'facturasCero' => $facturasCero ? $facturasCero->values() : collect()->values(),
        ]);
    }
}
