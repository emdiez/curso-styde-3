@extends('layout')

@section('title', $title)

@section('content')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por favor corrige los siguientes errores:</h6>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <h4>Por favor corrige los siguientes errores:</h4>
        <ul>
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<div class="card">
    <h3 class="card-header">{{ $title }}</h3>
    <div class="card-body">
       <form method="POST" action="{{ route('users.store') }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Pedro Perez" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@email.com" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Contrasenia:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Mayor a 6 caracteres">

                @if ($errors->has('password'))
                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            @if ($professions->isEmpty())
                <p>Debe agregar profesiones para los usuarios</p>
            @else
                <div class="form-group">
                    <label for="profession_id">Profesión</label>
                    <select name="profession_id" id="profession_id" class="form-control">
                        @foreach ($professions as $profession)
                                <option value="{{ $profession->id }}">{{ $profession->id . ' - ' . $profession->title}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('profession_id'))
                        <small class="form-text text-danger">{{ $errors->first('profession_id') }}</small>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
            @endif

            <a href="{{ route('users') }}" class="btn btn-link">Regresar a listado de usuarios</a>
        </form>
    </div>
</div>

@endsection

@section('sidebar')
    <h2>Barra lateral personalizada</h2>
@endsection