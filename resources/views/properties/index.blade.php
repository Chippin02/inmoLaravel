@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Propiedades</h1>
        <a class="btn btn-primary" href="{{route('properties.create')}}">Añadir nueva propiedad</a>
        <br/>
        <br/>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Tipo</th>
                    <th>m2</th>
                    @if(Auth::user()->hasRole('admin'))
                        <th>Propietario</th>
                    @endif
                    <th></th>
                </tr>
            @foreach($properties as $properties)
                <tr>
                    <td><a href="{{route('properties.show', $properties->id)}}">{{$properties->name}}</a></td>
                    <td>{{$properties->city}}</td>
                    <td>{{\App\Http\Controllers\PropertyController::getType($properties->type)}}</td>
                    <td>{{$properties->m2}}</td>
                    @if(Auth::user()->hasRole('admin'))
                        <td>{{\App\Http\Controllers\PropertyController::getUserName($properties->user_id)}}</td>
                    @endif
                    <td style="display: flex; flex-direction: row;">
                        <a class="btn btn-primary" href="{{route('properties.edit', $properties->id)}}">Editar</a>
                        <form method="POST" action="{{url("properties/{$properties->id}")}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 2px;" type="submit" onclick="if(!confirm('Una vez elimine la propiedad no podrá recuperarla\n¿Seguro que desea eliminarla?')){return false;};">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>
@endsection