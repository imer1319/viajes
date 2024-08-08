<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Fecha nacimiento</th>
            <th>DNI</th>
            <th>CUIL</th>
            <th>Telefono</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($choferes as $chofer)
            <tr>
                <td>{{ $chofer->id }}</td>
                <td>{{ $chofer->nombre }}</td>
                <td>{{ $chofer->fecha_nacimiento }}</td>
                <td>{{ $chofer->dni }}</td>
                <td>{{ $chofer->cuil }}</td>
                <td>{{ $chofer->telefono }}</td>
                <td>
                    <a href="{{ route('admin.choferes.show', $chofer) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.choferes.edit', $chofer) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.choferes.destroy', $chofer) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al chofer?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $choferes->links() }}
</div>
