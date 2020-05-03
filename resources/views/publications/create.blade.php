@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">Nueva publicación</h1>
        <form action="{{route('publications.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            Título oferta
            <br/>
            <input type="text" name="pubTitle" value="" class="form form-control" required>
            Propiedad asociada
            <br/>
            <input class="list-group " list="property_id" name="property_id" value="" required>
            <datalist id="property_id">
                @foreach($properties as $property)
                    <option value="{{$property->name}}">{{$property->name}}</option>
                @endforeach
            </datalist>
            Tipo
            <br/>
            <input class="list-group " list="type" name="type" value="" required>
            <datalist id="type">
                @foreach($types as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </datalist>
            Precio
            <br/>
            <input type="number" step="0.01" name="price" value="" class="form form-control" required>
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Crear">
            <a class="btn btn-danger" href="{{route('publications.index')}}">Cancelar</a>
            <br/>
            <br/>
        </form>
        <br/>
    </div>
@endsection