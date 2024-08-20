<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($condicionesIva as $condicion)
            <tr>
                <td>{{ $condicion->id }}</td>
                <td>{{ $condicion->codigo }}</td>
                <td>{{ $condicion->descripcion }}</td>
                <td>
                    <a href="{{ route('admin.condiciones-iva.edit', $condicion) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.condiciones-iva.destroy', $condicion) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar el condicion iva?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $condicionesIva->links() }}
</div>
