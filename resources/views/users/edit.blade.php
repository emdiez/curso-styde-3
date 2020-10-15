@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los siguientes errores:</h6>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        {!! csrf_field() !!}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="email@email.com" value="{{ old('email', $user->email) }}">
        <br>

        <label for="password">Contrasenia:</label>
        <input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
        <br>

        @if ($professions->isEmpty())
            <p>Debe agregar profesiones para los usuarios</p>
        @else
            <select name="profession_id">
                @foreach ($professions as $profession)
                        <option value="{{ $profession->id }}">{{ $profession->id . ' - ' . $profession->title}}</option>
                @endforeach
            </select>

            <br>

            <button type="submit">Registrar</button>
        @endif
    </form>

    <a href="{{ route('users') }}">Regresar a listado de usuarios</a>
@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection