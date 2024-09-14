<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th># interno</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Tipo de viaje</th>
                <th># de remito</th>
                <th>Total</th>
                <th>Saldo total</th>
                <th>Flota</th>
                <th>Chofer</th>
                <th>Comision chofer</th>
                <th>Saldo comision chofer</th>
                <th>Facturado</th>
                <th># de factura</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $movimiento)
                <tr>
                    <td>{{ $movimiento->numero_interno }}</td>
                    <td>{{ $movimiento->fecha }}</td>
                    <td>{{ $movimiento->cliente->razon_social }}</td>
                    <td>{{ $movimiento->tipoViaje->descripcion }}</td>
                    <td>{{ $movimiento->numero_factura_1 }} - {{ $movimiento->numero_factura_2 }}</td>
                    <td>{{ number_format($movimiento->total, 2, ',', '.') }}</td>
                    <td>{{ number_format($movimiento->saldo_total, 2, ',', '.') }}</td>
                    <td>{{ $movimiento->flota->nombre }}</td>
                    <td>{{ $movimiento->chofer->nombre }}</td>
                    <td>{{ number_format($movimiento->comision_chofer, 2, ',', '.') }}</td>
                    <td>{{ number_format($movimiento->saldo_comision_chofer, 2, ',', '.') }}</td>
                    <td>{{ $movimiento->facturado == 1 ? 'Si' : 'No' }}</td>
                    <td>
                        @if ($movimiento->facturas->isNotEmpty())
                            @foreach ($movimiento->facturas as $factura)
                                {{ $factura->numero_factura_1 }}-{{ $factura->numero_factura_2 }}
                            @endforeach
                        @else
                            No Facturado
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.movimiento.download.pdf', $movimiento) }}" target="_blank"
                                class="btn btn-primary btn-sm rounded-pill mr-1">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <a href="{{ route('admin.movimientos.show', $movimiento) }}"
                                class="btn btn-primary btn-sm rounded-pill mr-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.movimientos.edit', $movimiento) }}"
                                class="btn btn-primary btn-sm rounded-pill mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.movimientos.destroy', $movimiento) }}" style="display:flex"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill mr-1"
                                    onclick="return confirm('¿Realmente desea eliminar el movimientos?')"><i
                                        class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3 d-flex justify-content-end">
    {{ $movimientos->links() }}
</div>
