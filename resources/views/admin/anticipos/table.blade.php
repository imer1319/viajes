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
        @foreach ($anticipos as $anticipo)
            <tr>
                <td>{{ $anticipo->id }}</td>
                <td>{{ $anticipo->numero_interno }}</td>
                <td>{{ $anticipo->fecha }}</td>
                <td>{{ $anticipo->chofer->nombre }}</td>
                <td>{{ $anticipo->importe }}</td>
                <td>{{ $anticipo->saldo }}</td>
                <td>
                    <a href="{{ route('admin.anticipos.show', $anticipo) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
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
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $anticipos->links() }}
</div>