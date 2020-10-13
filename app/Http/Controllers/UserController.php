<?php

namespace App\Http\Controllers;

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

    public function show($id)
    {
        $title = "Listado de usuarios";

        return view('users.show')
            ->with('title', $title)
            ->with('id', $id);
    }

    public function create()
    {
        return 'Crear nuevo usuario';
    }

    public function edit($id)
    {
        return "Editar usuario {$id}";
    }
}
