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
        @foreach ($liquidaciones as $liquidacion)
            <tr>
                <td>{{ $liquidacion->id }}</td>
                <td>{{ $liquidacion->numero_interno }}</td>
                <td>{{ $liquidacion->fecha }}</td>
                <td>{{ $liquidacion->chofer->nombre }}</td>
                <td>{{ $liquidacion->importe }}</td>
                <td>{{ $liquidacion->saldo }}</td>
                <td>
                    <a href="{{ route('admin.liquidaciones.show', $liquidacion) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.liquidaciones.edit', $liquidacion) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.liquidaciones.destroy', $liquidacion) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al liquidacion?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $liquidaciones->links() }}
</div>