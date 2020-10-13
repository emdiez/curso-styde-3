@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>

        @forelse ($users as $user)
            <li>{{ $user->name }}, ({{ $user->email }})
                {{-- <a href="{{ url("usuarios/{$user->id}") }}"> Ver detalles</a> --}}
                {{-- <a href="{{ action('UserController@show', ['id' => $user->id]) }}"> Ver detalles</a> --}}
                {{-- <a href="{{ route('users.show', ['id' => $user->id]) }}"> Ver detalles</a> --}}
                {{-- <a href="{{ route('users.show', ['id' => $user]) }}"> Ver detalles</a> --}}
                <a href="{{ route('users.show', [$user]) }}"> Ver detalles</a>
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