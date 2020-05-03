@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Editar usuario</h1>
        <form action="{{route('users.update',$user->id)}}" method="POST">
            @csrf
            @method('PUT')
            Nombre usuario
            <br/>
            <input type="text" name="name" value="{{$user->name}}" class="form form-control" required>
            Correo contacto
            <br/>
            <input type="text" name="email" value="{{$user->email}}" class="form form-control" required>
            Contraseña
            <br/>
            <input type="text" name="password" value="" class="form form-control" required>
            <br/>
            <input class="list-group " list="role" name="role" value="{{\App\Http\Controllers\UserController::getRole($user->id)->description}}" required>
            <datalist id="role">
                @foreach($roles as $role)
                    <option value="{{$role->description}}">{{$role->description}}</option>
                @endforeach
            </datalist>
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Guardar">
            <a class="btn btn-danger" href="{{route('users.index')}}">Cancelar</a>
        </form>
        <br/>
    </div>

@endsection