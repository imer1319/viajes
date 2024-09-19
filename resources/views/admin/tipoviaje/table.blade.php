<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Descripcion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipoViajes as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->descripcion }}</td>
                <td>
                    <a href="{{ route('admin.tipo-viajes.edit', $tipo) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.tipo-viajes.destroy', $tipo) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar el tipo de viaje?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $tipoViajes->links() }}
</div>
