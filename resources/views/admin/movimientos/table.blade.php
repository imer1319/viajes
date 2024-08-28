<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Tipo de viaje</th>
            <th>Precio real</th>
            <th>Total</th>
            <th>Chofer</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movimientos as $movimiento)
            <tr>
                <td>{{ $movimiento->id }}</td>
                <td>{{ $movimiento->fecha }}</td>
                <td>{{ $movimiento->cliente->razon_social }}</td>
                <td>{{ $movimiento->tipoViaje->descripcion }}</td>
                <td>{{ number_format($movimiento->precio_real, 2, ',', '.') }}</td>
                <td>{{ number_format($movimiento->total, 2, ',', '.') }}</td>
                <td>{{ $movimiento->chofer->nombre }}</td>
                <td>
                    <a href="{{ route('admin.movimiento.download.pdf', $movimiento) }}" target="_blank" class="btn btn-primary rounded-pill float-end">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                    <a href="{{ route('admin.movimientos.show', $movimiento) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.movimientos.edit', $movimiento) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.movimientos.destroy', $movimiento) }}" style="display:inline"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar el movimientos?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $movimientos->links() }}
</div>
