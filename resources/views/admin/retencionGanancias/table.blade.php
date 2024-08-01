<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Tipo</th>
            <th>Minimo</th>
            <th>Alicuota</th>
            <th>Codigo retencion</th>
            <th>Codigo afip</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ganancias as $ganancia)
            <tr>
                <td>{{ $ganancia->id }}</td>
                <td>{{ $ganancia->codigo }}</td>
                <td>{{ $ganancia->tipo }}</td>
                <td>{{ $ganancia->minimo }}</td>
                <td>{{ $ganancia->alicuota }}</td>
                <td>{{ $ganancia->codigo_retencion }}</td>
                <td>{{ $ganancia->codigo_afip }}</td>
                <td>
                    <a href="{{ route('admin.retencion-ganancias.edit', $ganancia) }}"
                        class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.retencion-ganancias.destroy', $ganancia) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar la retencion de ganancias bruta?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $ganancias->links() }}
</div>
