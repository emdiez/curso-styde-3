@extends('layout')

@section('title', $title)

@section('content')

    <div class="card">
        <h3 class="card-header">{{ "Detalle de usuario {$user->id}" }}</h3>
        <div class="card-body">
            <p>Nombre: {{ $user->name }}</p>
            <p>Correo: {{ $user->email }}</p>
            <p>Profession: {{ $user->profession_id . ' - ' . $user->profession->title }}</p>
            {{-- <a href="{{ url()->previous() }}">Regresar a listado de usuarios</a> --}}
            {{-- <a href="{{ url()->current() }}">{{ url()->current() }} - Current</a> --}}
            {{-- <a href="{{ url()->full() }}">{{ url()->full() }} - Full</a> --}}
            {{-- <a href="{{ URL::full() }}">{{ url()->full() }} - Full</a> --}}

            {{-- <a href="{{ url('/usuarios') }}">Regresar a listado de usuarios</a> --}}
            {{-- <a href="{{ action('UserController@index') }}">Regresar a listado de usuarios</a> --}}
            <a href="{{ route('users') }}" class="btn btn-link">Regresar a listado de usuarios</a>

        </div>
    </div>


@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection