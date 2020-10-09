<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Listado de usuarios';

        $users = [];
        if (! request()->has('empty')) {
            $users = [
                'Salo',
                'Viry',
                'Daniel',
                'Joe',
                'Michael'
            ];
        }

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
