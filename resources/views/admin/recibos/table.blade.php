<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Formas de pago</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recibos as $recibo)
            <tr>
                <td>{{ $recibo->numero_interno }}</td>
                <td>{{ $recibo->fecha }}</td>
                <td>{{ $recibo->cliente->razon_social }}</td>
                <td>
                    @foreach ($recibo->pagos as $pago)
                        {{ $pago->forma->descripcion }} <br>
                    @endforeach
                </td>
                <td>{{ number_format($recibo->total_recibo, 2, ',', '.') }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver pdf">
                        <a href="{{ route('admin.recibo.download.pdf', $recibo) }}" target="_blank"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-file-pdf"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver recibo">
                        <a href="{{ route('admin.recibos.show', $recibo) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar recibo">
                        <form action="{{ route('admin.recibos.destroy', $recibo) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al recibo?')"><i
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
            <th colspan="4">Totales</th>
            <th>{{ number_format($totales['total_recibo'], 2, ',', '.') }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $recibos->links() }}
</div>
