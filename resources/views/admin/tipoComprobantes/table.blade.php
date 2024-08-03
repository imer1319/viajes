<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Liquidacion iva</th>
            <th>Emite</th>
            <th>Recibe</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipoComprobantes as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->codigo }}</td>
                <td>{{ $tipo->descripcion }}</td>
                <td>{{ $tipo->liquidacion }}</td>
                <td>{{ $tipo->emicion }}</td>
                <td>{{ $tipo->recepcion }}</td>
                <td>
                    <a href="{{ route('admin.tipo-comprobantes.edit', $tipo) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.tipo-comprobantes.destroy', $tipo) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar el tipo de comprobante?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $tipoComprobantes->links() }}
</div>
