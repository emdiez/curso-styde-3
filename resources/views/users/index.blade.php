@extends('layout')

@section('title', $title)

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-2">
        <h1 class="pb-1">{{ $title }}</h1>

        <p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Registrar nuevo usuario</a>
        </p>
    </div>


    @if ($users->isNotEmpty())
        <table class="table">
          <thead class="thead-dark" >
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Correo</th>
              <th scope="col">Profesion</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
                <tr>
                  <th scope="row">{{ $user->id }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->profession_id . '-' . $user->profession->title}}</td>
                  <td>
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        <a href="{{ route('users.show', [$user]) }}" class="btn btn-link"> <i class="far fa-eye"></i></a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-link"> <i class="far fa-edit"></i></a>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-link"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    @endif

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