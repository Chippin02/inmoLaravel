@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Usuarios</h1>
        <br/>
        <br/>
        <table class="table">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo cuenta</th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{\App\Http\Controllers\UserController::getRole($user->id)->name}}</td>
                    <td style="display: flex; flex-direction: row;">
                        <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Editar</a>
                        <form method="POST" action="{{url("users/{$user->id}")}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 2px;" type="submit" onclick="if(!confirm('Una vez elimine el usuario no podrá recuperarlo\n¿Seguro que desea eliminarlo?')){return false;};">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>
@endsection