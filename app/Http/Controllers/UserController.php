<?php

namespace App\Http\Controllers;

use App\Profession;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Listado de usuarios';

        // $users = DB::select('SELECT * FROM users');
        // $users = DB::table('users')->get();
        $users = User::all();

        return view('users.index')->with([
            'users' => $users ,
            'title' => $title
        ]);
    }

    public function show(User $user)
    {
        $title = "Listado de usuarios";

        // $user = User::find($id);
        // if ($user == null) {
        //     return response()->view('errors.404', ['title' => $title], 404);
        // }

        // $user = User::findOrFail($id);
        // $user = User::where('id', '>=', $id)->firstOrFail();

        return view('users.show')
            ->with('title', $title)
            ->with('user', $user);
    }

    public function create()
    {
        return view('users.create')
            ->with('title', 'Registrar nuevo usuario')
            ->with('professions', Profession::all());
    }

    public function store()
    {
        // $data = request()->all();
        // $data = request()->only(['name', 'email', 'password', 'profession_id']);

        // if ($data['name'] == null) {
        //     return redirect()->route('users.create')
        //         ->withErrors(['name' => 'El campo nombres es obligatorio']);
        // }

        $data = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'profession_id' => 'exists:professions,id',
        ], [
            'name.required' => 'El campo nombres es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser valido',
            'email.unique' => 'El campo email debe ser unico',
            'password.required' => 'El campo password es obligatorio',
            'password.min' => 'El campo password debe contener minimo 6 caracteres',
            'profession_id.exists' => 'Debe seleccionar una profesion existente'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profession_id' => $data['profession_id'],
        ]);

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $title = 'Editar usuarios';

        return view('users.edit', [
            'user' => $user,
            'title' => $title,
        ]);
    }
}
