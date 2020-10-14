@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('users.store') }}">
        {!! csrf_field() !!}

        <button type="submit">Registrar</button>
    </form>

    <a href="{{ route('users') }}">Regresar a listado de usuarios</a>
@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection