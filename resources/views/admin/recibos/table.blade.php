<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recibos as $recibo)
            <tr>
                <td>{{ $recibo->id }}</td>
                <td>{{ $recibo->fecha }}</td>
                <td>{{ $recibo->chofer->nombre }}</td>
                <td>{{ $recibo->total_recibo }}</td>
                <td>
                    <a href="{{ route('admin.recibo.download.pdf', $recibo) }}" target="_blank" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-file-pdf"></i>
                    </a>
                    <a href="{{ route('admin.recibos.show', $recibo) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.recibos.edit', $recibo) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.recibos.destroy', $recibo) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al recibo?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $recibos->links() }}
</div>
