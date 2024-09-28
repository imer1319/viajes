<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cliente->razon_social }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->numero_documento }}</td>
                <td>{{ number_format($cliente->saldo, 2, ',', '.') }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver cliente">
                        <a href="{{ route('admin.clientes.show', $cliente) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar cliente">
                        <a href="{{ route('admin.clientes.edit', $cliente) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar cliente">
                        <form action="{{ route('admin.clientes.destroy', $cliente) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al cliente?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </form>
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Totales</th>
            <th>{{ number_format($totales['saldo'], 2, ',', '.') }}</th>
            <th></th>  
        </tr>
    </tfoot>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $clientes->links() }}
</div>
