@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">{{$publication->pubTitle}}</h1>
        <h6 class="my-7">Fecha publicación: {{$publication->created_at}}</h6>
        @if(Auth::user()->hasRole('admin'))
            <h4 class="my-7">Propietario: {{$user->name}} ({{$user->email}})</h4>
        @endif
        <h4 class="my-7">Tipo oferta: {{$publication_type->name}}</h4>
        <h4 class="my-7">Precio: {{$publication->price}} €</h4>
        <p>
            <h5 class="my-7">{{$property->name}}</h5>
            <h6 class="my-7">Descripción:</h6>
            {{$property->description}}
            <ul>
                <li>Tipo vivienda: {{$property_type->name}}</li>
                <li>Ciudad: {{$property->city}}</li>
                <li>Dirección: {{$property->address}}</li>
                <li>m2: {{$property->m2}}</li>
            </ul>
        </p>
        <br/>
        <br/>
        </br>
        <a class="btn btn-info" href="{{route('publications.index')}}">Volver</a>
        <br/>
        <br/>
    </div>
@endsection