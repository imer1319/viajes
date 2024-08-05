<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\StoreRequest;
use App\Http\Requests\Usuario\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index', [
            'users' => User::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.usuarios.create', [
            'user' => new User(),
            'roles' => Role::all()
        ]);
    }

    public function store(StoreRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('admin.users.index')->with('flash', 'Usuario creado corretamente');
    }

    public function edit(User $user)
    {
        return view('admin.usuarios.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('admin.users.index')->with('flash', 'Usuario actualizado corretamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('flash', 'Usuario eliminado corretamente');
    }
}
