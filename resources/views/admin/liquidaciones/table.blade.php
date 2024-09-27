<table class="table table-bordered">
    <thead>
        <tr>
            <th>Int</th>
            <th>Fecha</th>
            <th>Chofer</th>
            <th>Formas de pago</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($liquidaciones as $liquidacion)
            <tr>
                <td>{{ $liquidacion->numero_interno }}</td>
                <td>{{ $liquidacion->fecha }}</td>
                <td>{{ $liquidacion->chofer->nombre }}</td>
                <td>
                    @foreach ($liquidacion->pagos as $pago)
                        <span class="badge badge-primary">{{ $pago->forma->descripcion }}</span> <br>
                    @endforeach
                </td>
                <td>{{ number_format($liquidacion->total_liquidacion, 2, ',', '.') }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver pdf">
                        <a href="{{ route('admin.liquidacion.download.pdf', $liquidacion) }}" target="_blank"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-file-pdf"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver liquidacion">
                        <a href="{{ route('admin.liquidaciones.show', $liquidacion) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar liquidacion">
                        <a href="{{ route('admin.liquidaciones.edit', $liquidacion) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar liquidacion">
                        <form action="{{ route('admin.liquidaciones.destroy', $liquidacion) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al liquidacion?')"><i
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
            <th>{{ number_format($totales['total_liquidacion'], 2, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $liquidaciones->links() }}
</div>
