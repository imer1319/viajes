<table class="table table-bordered">
    <thead>
        <tr>
            <th>Numero interno</th>
            <th>Fecha</th>
            <th>Importe</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($anticipos as $anticipo)
            <tr>
                <td>{{ $anticipo->numero_interno }}</td>
                <td>{{ $anticipo->fecha }}</td>
                <td>{{ number_format($anticipo->importe, 2, ',', '.') }}</td>
                <td>{{ number_format($anticipo->saldo, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.anticipos.chofer.edit', [$chofer, $anticipo]) }}"
                        class="btn btn-primary btn-sm rounded-pill">
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
        @empty
            <tr>
                <td colspan="7" align="center">No hay datos</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $anticipos->links() }}
</div>
