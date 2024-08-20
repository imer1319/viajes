<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Condicion</th>
            <th>Dias</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($condicionesPago as $condicion)
            <tr>
                <td>{{ $condicion->id }}</td>
                <td>{{ $condicion->condicion }}</td>
                <td>{{ $condicion->dias }}</td>
                <td>
                    <a href="{{ route('admin.condicion-pagos.edit', $condicion) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.condicion-pagos.destroy', $condicion) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar condicion de pago?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $condicionesPago->links() }}
</div>
