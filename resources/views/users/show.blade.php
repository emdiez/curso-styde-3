@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ "Detalle de usuario {$user->id}" }}</h1>

    <p>Nombre: {{ $user->name }}</p>
    <p>Correo: {{ $user->email }}</p>

@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection