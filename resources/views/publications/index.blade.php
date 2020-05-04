@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Publicaciones</h1>
        <a class="btn btn-primary" href="{{route('publications.create')}}">Añadir nueva publicación</a>
        <br/>
        <br/>
        <table class="table">
            <thead>
            <tr>
                <th>Título oferta</th>
                <th>Propiedad asociada</th>
                <th>Tipo</th>
                <th>Precio</th>
                @if(Auth::user()->hasRole('admin'))
                    <th>Propietario</th>
                @endif
                <th></th>
            </tr>
            @foreach($publications as $publication)
                <tr>
                    <td><a href="{{route('publications.show', $publication->id)}}">{{$publication->pubTitle}}</a></td>
                    <td>
                        <a href="{{route('properties.show', $publication->property_id)}}">
                            {{\App\Http\Controllers\PublicationsController::getProperty($publication->property_id)}}
                        </a>
                    </td>
                    <td>{{\App\Http\Controllers\PublicationsController::getType($publication->type)}}</td>
                    <td>{{$publication->price}} €</td>
                    @if(Auth::user()->hasRole('admin'))
                        <td>
                            {{\App\Http\Controllers\PublicationsController::getUserName($publication->publisher_id)}}
                             ({{\App\Http\Controllers\PublicationsController::getUserMail($publication->publisher_id)}})
                        </td>
                    @endif
                    <td style="display: flex; flex-direction: row;">
                        <a class="btn btn-primary" href="{{route('publications.edit', $publication->id)}}">Editar</a>
                        <form method="POST" action="{{url("publications/{$publication->id}")}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 2px;" type="submit" onclick="if(!confirm('Una vez elimine la publicación no podrá recuperarla\n¿Seguro que desea eliminarla?')){return false;};">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>
@endsection