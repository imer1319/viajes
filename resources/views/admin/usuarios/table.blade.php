<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre y apellido</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if ($user->id !== 1)
                        <form action="{{ route('admin.users.destroy', $user) }}" style="display:inline" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-sm btn-primary rounded-pill"
                                onclick="return confirm('¿Realmente desea eliminar al usuario?')"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-end">
    {{ $users->links() }}
</div>
