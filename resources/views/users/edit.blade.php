@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ "Editar usuario {$user->id}" }}</h1>

    <p>Nombre: {{ $user->name }}</p>
    <p>Correo: {{ $user->email }}</p>
    <a href="{{ route('users') }}">Regresar a listado de usuarios</a>

@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection