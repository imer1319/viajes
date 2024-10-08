<table class="table table-bordered">
    <thead>
        <tr>
            <th>Int</th>
            <th>Fecha</th>
            <th>Chofer</th>
            <th>Flota</th>
            <th>Tipos gasto</th>
            <th>Importe</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $gasto)
            <tr>
                <td>{{ $gasto->numero_interno }}</td>
                <td>{{ $gasto->fecha }}</td>
                <td>
                    {{ $gasto->chofer->nombre }}
                </td>
                <td>{{ $gasto->flota->nombre }}</td>
                <td>
                    @foreach ($gasto->tipoGastos as $tipo)
                        <span class="badge badge-primary">{{ $tipo->descripcion }} </span><br>
                    @endforeach
                </td>
                <td>{{ number_format($gasto->importe, 2, ',', '.') }}</td>
                <td>{{ number_format($gasto->saldo, 2, ',', '.') }}</td>

                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar gasto">
                        <a href="{{ route('admin.gastos.show', $gasto) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar gasto">
                        <a href="{{ route('admin.gastos.edit', $gasto) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar gasto">
                        <form action="{{ route('admin.gastos.destroy', $gasto) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al gasto?')"><i
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
            <th>{{ number_format($totales['importe'], 2, ',', '.') }}</th>
            <th>{{ number_format($totales['saldo'], 2, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $gastos->links() }}
</div>
