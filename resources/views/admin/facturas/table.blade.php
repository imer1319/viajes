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
                    <a href="{{ route('admin.factura.download.pdf', $factura) }}" target="_blank"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-file-pdf"></i>
                    </a>
                    <a href="{{ route('admin.facturaciones.show', $factura) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.facturaciones.edit', $factura) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.facturaciones.destroy', $factura) }}" style="display:inline"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al factura?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $facturas->links() }}
</div>
