@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Editar propiedad</h1>
        <form action="{{route('properties.update',$property->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            Nombre
            <br/>
            <input type="text" name="name" value="{{$property->name}}" class="form form-control" required>
            Descripción
            <br/>
            <input type="text" name="description" value="{{$property->description}}" class="form form-control" required>
            Tipo
            <br/>
            <input class="list-group " list="type" name="type" value="{{\App\Http\Controllers\PropertyController::getType($property->type)}}" required>
            <datalist id="type">
                @foreach($types as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </datalist>
            Propietario
            <br/>
            @if(Auth::user()->hasRole('admin'))
                <input class="list-group " list="email" name="email" value="{{\App\Http\Controllers\PropertyController::getMail($property->user_id)}}">
                <datalist id="email">
                    @foreach($users as $user)
                        <option value="{{$user->email}}">{{$user->email}}</option>
                    @endforeach
                </datalist>
            @else
                <input type="text" name="email" value="{{\App\Http\Controllers\PropertyController::getMail($property->user_id)}}" class="form form-control" readonly>
            @endif
            Ciudad
            <br/>
            <input type="text" name="city" value="{{$property->city}}" class="form form-control" required>
            Dirección
            <br/>
            <input type="text" name="address" value="{{$property->address}}" class="form form-control" required>
            m2
            <br/>
            <input type="number" step="0.01" name="m2" value="{{$property->m2}}" class="form form-control" required>
            <br/>
            <input type="file" name="photo">
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Guardar">
            <a class="btn btn-danger" href="{{route('properties.index')}}">Cancelar</a>
        </form>
        <br/>
    </div>

 @endsection