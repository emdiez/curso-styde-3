@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('users.store') }}">
        {!! csrf_field() !!}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez">
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="email@email.com">
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