@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Nueva propiedad</h1>
        <form action="{{route('properties.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            Nombre
            <br/>
            <input type="text" name="name" value="" class="form form-control" required>
            Descripción
            <br/>
            <input type="text" name="description" value="" class="form form-control" required>
            Tipo
            <br/>
            <input class="list-group " list="type" name="type" required>
            <datalist id="type">
                @foreach($types as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </datalist>
            Propietario
            <br/>
            @if(Auth::user()->hasRole('admin'))
                <input class="list-group " list="email" name="email" value="" required>
                <datalist id="email">
                    @foreach($users as $user)
                        <option value="{{$user->email}}">{{$user->name}} ({{$user->email}})</option>
                    @endforeach
                </datalist>
            @else
               <input type="text" name="email" value="{{$email->email}}" class="form form-control" readonly>
            @endif
            Ciudad
            <br/>
            <input type="text" name="city" value="" class="form form-control" required>
            Dirección
            <br/>
            <input type="text" name="address" value="" class="form form-control" required>
            m2
            <br/>
            <input type="number" step="0.01" name="m2" value="" class="form form-control" required>
            <br/>
            <input type="file" name="photo">
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Crear">
            <a class="btn btn-danger" href="{{route('properties.index')}}">Cancelar</a>
            <br/>
            <br/>
        </form>
        <br/>
    </div>
@endsection