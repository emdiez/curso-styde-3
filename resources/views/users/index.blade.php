@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <p>
        <a href="{{ route('users.create') }}">Registrar nuevo usuario</a>
    </p>

    <ul>
        @forelse ($users as $user)
            <li>{{ $user->name }}, ({{ $user->email }},) {{$user->profession_id . ' - ' . $user->profession->title}}
                {{-- <a href="{{ url("usuarios/{$user->id}") }}"> Ver detalles</a> --}}
                {{-- <a href="{{ action('UserController@show', ['id' => $user->id]) }}"> Ver detalles</a> --}}
                {{-- <a href="{{ route('users.show', ['id' => $user->id]) }}"> Ver detalles</a> --}}
                {{-- <a href="{{ route('users.show', ['id' => $user]) }}"> Ver detalles</a> --}}
                <a href="{{ route('users.show', [$user]) }}"> Ver detalles</a> |
                <a href="{{ route('users.edit', $user) }}"> Editar usuario</a> |
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit">Eliminar usuario</button>
                </form>
            </li>
        @empty
             <p>No hay usuarios registrados.</p>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    {{-- @parent --}}
    <h2>Barra lateral personalizada</h2>
@endsection