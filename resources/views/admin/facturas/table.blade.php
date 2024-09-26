<table class="table table-bordered">
    <thead>
        <tr>
            <th>Int</th>
            <th># factura</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>Neto</th>
            <th>Iva</th>
            <th>Total</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facturas as $factura)
            <tr>
                <td>{{ $factura->numero_interno }}</td>
                <td>{{ $factura->numero_factura_1 }}-{{ $factura->numero_factura_2 }}</td>
                <td>{{ $factura->fecha }}</td>
                <td>{{ $factura->cliente->razon_social }}</td>
                <td>{{ $factura->cliente->email }}</td>
                <td>{{ number_format($factura->neto, 2, ',', '.') }}</td>
                <td>{{ number_format($factura->iva, 2, ',', '.') }}</td>
                <td>{{ number_format($factura->total, 2, ',', '.') }}</td>
                <td>{{ number_format($factura->saldo_total, 2, ',', '.') }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver pdf">
                        <a href="{{ route('admin.factura.download.pdf', $factura) }}" target="_blank"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-file-pdf"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver factura">
                        <a href="{{ route('admin.facturaciones.show', $factura) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar factura">
                        <a href="{{ route('admin.facturaciones.edit', $factura) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar factura">
                        <form action="{{ route('admin.facturaciones.destroy', $factura) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al factura?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </form>
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Totales</th>
            <th>{{ number_format($totales['neto'], 2, ',', '.') }}</th>
            <th>{{ number_format($totales['iva'], 2, ',', '.') }}</th>
            <th>{{ number_format($totales['total'], 2, ',', '.') }}</th>
            <th>{{ number_format($totales['saldo_total'], 2, ',', '.') }}</th>
            <th colspan="3"></th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $facturas->links() }}
</div>
