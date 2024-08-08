<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Razon social</th>
            <th>Email</th>
            <th>CUIT</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->razon_social }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->cuit }}</td>
                <td>
                    <a href="{{ route('admin.proveedores.show', $proveedor) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.proveedores.edit', $proveedor) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.proveedores.destroy', $proveedor) }}" style="display:inline"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar al proveedor?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $proveedores->links() }}
</div>
