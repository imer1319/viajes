<table class="table table-bordered">
    <thead>
        <tr>
            <th>Int</th>
            <th>Fecha</th>
            <th>Chofer</th>
            <th>Importe</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anticipos as $anticipo)
            <tr>
                <td>{{ $anticipo->numero_interno }}</td>
                <td>{{ $anticipo->fecha }}</td>
                <td>
                    <a
                        href="{{ route('admin.anticipos.chofer.index', $anticipo->chofer->id) }}">{{ $anticipo->chofer->nombre }}</a>
                </td>
                <td>{{ number_format($anticipo->importe, 2, ',', '.') }}</td>
                <td>{{ number_format($anticipo->saldo, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.anticipos.edit', $anticipo) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.anticipos.destroy', $anticipo) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al anticipo?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Totales</th>
            <th>{{ number_format($totales['importe'], 2, ',', '.') }}</th>
            <th>{{ number_format($totales['saldo'], 2, ',', '.') }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $anticipos->links() }}
</div>
