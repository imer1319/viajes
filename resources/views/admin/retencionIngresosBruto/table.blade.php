<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Descripcion</th>
            <th>Porcentaje</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingresos as $ingreso)
            <tr>
                <td>{{ $ingreso->id }}</td>
                <td>{{ $ingreso->descripcion }}</td>
                <td>{{ $ingreso->porcentaje }}</td>
                <td>
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Editar ingreso bruto">
                        <a href="{{ route('admin.retencion-ingresos-bruto.edit', $ingreso) }}"
                            class="btn btn-primary btn-sm rounded-pill">
                            <i class="fa fa-edit"></i>
                        </a>
                    </span>
                    <form action="{{ route('admin.retencion-ingresos-bruto.destroy', $ingreso) }}" style="display:inline"
                        method="post">
                        @csrf
                        @method('DELETE')
                    <span class="tts:left tts-slideIn tts-custom" aria-label="Eliminar ingreso bruto">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                            onclick="return confirm('¿Realmente desea eliminar la retencion de ganancias bruta?')"><i
                                class="fa fa-trash"></i>
                        </button>
                    </span>
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $ingresos->links() }}
</div>
