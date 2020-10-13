@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>

        @forelse ($users as $user)
            <li>{{ $user->name }}, ({{ $user->email }})</li>
        @empty
             <p>No hay usuarios registrados.</p>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    {{-- @parent --}}
    <h2>Barra lateral personalizada</h2>
@endsection