<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Descripcion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($medidas as $medida)
            <tr>
                <td>{{ $medida->id }}</td>
                <td>{{ $medida->descripcion }}</td>
                <td>
                    <a href="{{ route('admin.medidas.edit', $medida) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.medidas.destroy', $medida) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar la medida?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $medidas->links() }}
</div>
