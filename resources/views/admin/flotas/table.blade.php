<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Año</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($flotas as $flota)
            <tr>
                <td>{{ $flota->id }}</td>
                <td>{{ $flota->nombre }}</td>
                <td>{{ $flota->placa }}</td>
                <td>{{ $flota->marca }}</td>
                <td>{{ $flota->anio }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Ver flota">
                        <a href="{{ route('admin.flotas.show', $flota) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-eye"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar flota">
                        <a href="{{ route('admin.flotas.edit', $flota) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar flota">
                        <form action="{{ route('admin.flotas.destroy', $flota) }}" style="display:inline"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al flota?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </form>
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $flotas->links() }}
</div>
