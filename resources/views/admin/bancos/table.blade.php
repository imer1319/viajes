<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Descripcion</th>
            <th>Alias</th>
            <th>CBU</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bancos as $banco)
            <tr>
                <td>{{ $banco->id }}</td>
                <td>{{ $banco->descripcion }}</td>
                <td>{{ $banco->alias }}</td>
                <td>{{ $banco->cbu }}</td>
                <td>
                    <a href="{{ route('admin.bancos.edit', $banco) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.bancos.destroy', $banco) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar la banco?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $bancos->links() }}
</div>
