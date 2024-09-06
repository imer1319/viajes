<table class="table table-bordered">
    <thead>
        <tr>
            <th>Razon social</th>
            <th>Email</th>
            <th># Documento</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->razon_social }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->numero_documento }}</td>
                <td>{{ number_format($cliente->saldo, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.clientes.show', $cliente) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.clientes.edit', $cliente) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.clientes.destroy', $cliente) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al cliente?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $clientes->links() }}
</div>
