<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Numero interno</th>
            <th>Fecha</th>
            <th>Chofer</th>
            <th>Importe</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $gasto)
            <tr>
                <td>{{ $gasto->id }}</td>
                <td>{{ $gasto->numero_interno }}</td>
                <td>{{ $gasto->fecha }}</td>
                <td>
                    <a href="{{ route('admin.gastos.chofer.index', $gasto->chofer->id) }}">{{ $gasto->chofer->nombre }}</a>
                </td>
                <td>{{ $gasto->importe }}</td>
                <td>{{ $gasto->saldo }}</td>
                <td>
                    <a href="{{ route('admin.gastos.show', $gasto) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.gastos.edit', $gasto) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.gastos.destroy', $gasto) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al gasto?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $gastos->links() }}
</div>