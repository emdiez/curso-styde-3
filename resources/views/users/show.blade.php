@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ "Detalle de usuario {$user->id}" }}</h1>

    <p>Nombre: {{ $user->name }}</p>
    <p>Correo: {{ $user->email }}</p>
    {{-- <a href="{{ url()->previous() }}">Regresar a listado de usuarios</a> --}}
    {{-- <a href="{{ url()->current() }}">{{ url()->current() }} - Current</a> --}}
    {{-- <a href="{{ url()->full() }}">{{ url()->full() }} - Full</a> --}}
    {{-- <a href="{{ URL::full() }}">{{ url()->full() }} - Full</a> --}}

    {{-- <a href="{{ url('/usuarios') }}">Regresar a listado de usuarios</a> --}}
    {{-- <a href="{{ action('UserController@index') }}">Regresar a listado de usuarios</a> --}}
    <a href="{{ route('users') }}">Regresar a listado de usuarios</a>

@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection