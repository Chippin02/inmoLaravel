@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Editar publicación</h1>
        <form action="{{route('publications.update',$publication->id)}}" method="POST">
            @csrf
            @method('PUT')
            Título oferta
            <br/>
            <input type="text" name="pubTitle" value="{{$publication->pubTitle}}" class="form form-control" required>
            Propiedad asociada
            <br/>
            <input class="list-group " list="property_id" name="property_id" value="{{\App\Http\Controllers\PublicationController::getProperty($publication->property_id)}}" required>
            <datalist id="property_id">
                @foreach($properties as $property)
                    <option value="{{$property->name}}">{{$property->name}}
                        @if(Auth::user()->hasRole('admin'))
                             ({{\App\Http\Controllers\PublicationController::getUserMail($property->user_id)}})
                        @endif
                    </option>
                @endforeach
            </datalist>
            Tipo
            <br/>
            <input class="list-group " list="type" name="type" value="{{\App\Http\Controllers\PublicationController::getType($publication->type)}}" required>
            <datalist id="type">
                @foreach($types as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </datalist>
            Precio
            <br/>
            <input type="number" step="0.01" name="price" value="{{$publication->price}}" class="form form-control" required>
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Guardar">
            <a class="btn btn-danger" href="{{route('publications.index')}}">Cancelar</a>
        </form>
        <br/>
    </div>

@endsection