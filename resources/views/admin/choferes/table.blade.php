<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>CUIL</th>
            <th>Telefono</th>
            <th>Saldo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($choferes as $chofer)
            <tr>
                <td>{{ $chofer->id }}</td>
                <td>{{ $chofer->nombre }}</td>
                <td>{{ $chofer->dni }}</td>
                <td>{{ $chofer->cuil }}</td>
                <td>{{ $chofer->telefono }}</td>
                <td>{{ $chofer->saldo }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Agregar anticipo">
                        <a href="{{ route('admin.anticipos.chofer.index', $chofer) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fas fa-money-check-alt"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver chofer">
                        <a href="{{ route('admin.choferes.show', $chofer) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar chofer">
                        <a href="{{ route('admin.choferes.edit', $chofer) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <form action="{{ route('admin.choferes.destroy', $chofer) }}" style="display:inline" method="post">
                        @csrf
                        @method('DELETE')
                        <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar chofer">
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al chofer?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </span>
                    </form>
                </td>
            </tr>
        @empty
        <tr>
            <td>No hay datos</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $choferes->links() }}
</div>
