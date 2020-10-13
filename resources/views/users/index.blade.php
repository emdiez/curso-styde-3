@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>

        @if(! empty($users))
            @foreach($users as $user)
                <li>{{ $user->name }}, ({{ $user->email }})</li>
            @endforeach
        @else
            <p>No hay usuarios registrados.</p>
        @endif

    </ul>
@endsection

@section('sidebar')
    {{-- @parent --}}
    <h2>Barra lateral personalizada</h2>
@endsection